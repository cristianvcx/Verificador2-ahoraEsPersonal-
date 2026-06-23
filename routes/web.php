<?php

use App\Enums\UserRole;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuditorDashboardController;
use App\Http\Controllers\DescargaVerificadorController;
use App\Http\Controllers\DirectorDashboardController;
use App\Http\Controllers\PasswordRenewalController;
use App\Mail\NuevasActividadesPendientes;
use App\Models\Region;
use App\Models\Unidad;
use App\Models\User;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $rol = Auth::user()->rol;
        info('(routing info): Usuario autenticado con rol: '.$rol->value);
        if ($rol === UserRole::Admin) {
            return redirect()->route('admin.dashboard');
        }
        if ($rol === UserRole::Auditor) {
            return redirect()->route('auditor.dashboard');
        }
        if ($rol === UserRole::Cargador) {
            return redirect()->route('actividades.importar');
        }
        if ($rol === UserRole::Unidad) {
            return redirect()->route('unidad.dashboard');
        }

        return redirect()->route('actividades.historial');
    }

    return redirect()->route('login');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

// Rutas de expiración de contraseña (accesibles de forma segura para usuarios deslogueados)
Route::get('/password/expired', [PasswordRenewalController::class, 'showExpired'])->name('password.expired');
Route::post('/password/request-renewal', [PasswordRenewalController::class, 'requestRenewal'])->name('password.request-renewal');

Route::middleware(['auth'])->group(function () {
    // Endpoint síncrono ligero para el Keep-Alive de sesión activa (Heartbeat)
    Route::post('/session/keep-alive', function () {
        return response()->json([
            'status' => 'active',
            'refreshed_at' => now()->toIso8601String(),
        ]);
    })->name('session.keep-alive');

    // Descarga segura de archivos verificadores (Almacenamiento Privado)
    Route::get('/archivos/{archivo}/descargar', [DescargaVerificadorController::class, 'descargar'])
        ->name('archivos.descargar');

    // Historial global: Accesible por todos los roles autenticados (Renombrado de Consulta a Historial)
    Route::get('/historial', [ActividadController::class, 'historial'])
        ->middleware('role:admin,director,auditor,cargador,unidad')
        ->name('actividades.historial');

    // Módulo de Correos Fallidos compartido para Auditor y Administrador
    Route::get('/correos-fallidos', function () {
        return view('auditor.failed-mails');
    })->middleware('role:admin,auditor')->name('auditor.correos-fallidos');

    // Rutas exclusivas del Auditor (Dashboard con estadísticas de solo lectura)
    Route::middleware(['role:auditor'])->group(function () {
        Route::get('/auditor/dashboard', AuditorDashboardController::class)->name('auditor.dashboard');
    });
    // Rutas exclusivas del Director Regional
    Route::middleware(['role:director'])->group(function () {
        Route::get('/director/dashboard', DirectorDashboardController::class)->name('director.dashboard');

        // Acción de renotificación regional asíncrona
        Route::post('/director/unidades/{unidad}/renotificar', function (Unidad $unidad) {
            $region = Region::where('user_id', Auth::id())->first();
            if (! $region || $unidad->region_id !== $region->id) {
                abort(403, 'No tiene permisos para renotificar unidades fuera de su jurisdicción.');
            }

            $sent = MailService::sendSafe(
                $unidad->user->email,
                new NuevasActividadesPendientes($unidad),
                ['unidad_id' => $unidad->id]
            );

            if ($sent) {
                return back()->with('success', "Se ha enviado una nueva renotificación de forma síncrona a la unidad '{$unidad->user->name}'.");
            }

            return back()->with('error', "El envío síncrono falló. Se ha archivado la renotificación en 'Correos Fallidos' para posterior gestión administrativa.");
        })->name('director.unidades.renotificar');
    });

    //  Rutas exclusivas de Administración
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', AdminDashboardController::class)->name('admin.dashboard');

        Route::get('/admin/actividades', [ActividadController::class, 'historial'])->name('admin.actividades');

        // Vista de Unidades en el menú lateral: Listado de usuarios del sistema
        Route::get('/admin/usuarios', function () {
            $search = request('search');
            $usuarios = User::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy('rol', 'asc')
                ->orderBy('name', 'asc')
                ->paginate(15);

            $regiones = Region::all();

            return view('admin.edicion', compact('usuarios', 'search', 'regiones'));
        })->name('admin.usuarios');

        // Creación de Región (Incluye creación automática de Director Regional)
        Route::post('/admin/crear-region', function (Request $request) {
            if (! session('modo_edicion')) {
                abort(403, 'Acción bloqueada. Debe activar el Modo Edición.');
            }

            $request->validate([
                'region_nombre' => 'required|string|max:50',
                'director_nombre' => 'required|string|max:255',
                'director_email' => 'required|email|unique:users,email',
                'region_id' => 'nullable|integer|unique:region,id',
            ]);

            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->director_nombre,
                    'email' => $request->director_email,
                    'password' => Hash::make('password'),
                    'rol' => 'director',
                    'activo' => true,
                    'password_changed_at' => null,
                ]);

                Region::create([
                    'id' => $request->region_id ?: null,
                    'region_nombre' => $request->region_nombre,
                    'user_id' => $user->id,
                ]);
            });

            return back()->with('success', "La Región '{$request->region_nombre}' y su Director Regional han sido creados con éxito.");
        })->name('admin.crear-region');

        // Creación de Unidad Operativa (Incluye creación automática de Operador de Unidad)
        Route::post('/admin/crear-unidad', function (Request $request) {
            if (! session('modo_edicion')) {
                abort(403, 'Acción bloqueada. Debe activar el Modo Edición.');
            }

            $request->validate([
                'unidad_nombre' => 'required|string|max:255',
                'unidad_email' => 'required|email|unique:users,email',
                'region_id' => 'required|exists:region,id',
                'unidad_id' => 'nullable|integer|unique:unidad,id',
            ]);

            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->unidad_nombre,
                    'email' => $request->unidad_email,
                    'password' => Hash::make('password'),
                    'rol' => 'unidad',
                    'activo' => true,
                    'password_changed_at' => null,
                ]);

                Unidad::create([
                    'id' => $request->unidad_id ?: null,
                    'region_id' => $request->region_id,
                    'user_id' => $user->id,
                ]);
            });

            return back()->with('success', "La Unidad '{$request->unidad_nombre}' y su Operador han sido creados con éxito.");
        })->name('admin.crear-unidad');

        // Creación de Usuario de Sistema (Admin, Auditor o Cargador)
        Route::post('/admin/crear-usuario', function (Request $request) {
            if (! session('modo_edicion')) {
                abort(403, 'Acción bloqueada. Debe activar el Modo Edición.');
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'rol' => 'required|in:admin,auditor,cargador',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'rol' => $request->rol,
                'activo' => true,
                'password_changed_at' => null,
            ]);

            return back()->with('success', "Usuario '{$request->name}' con rol '{$request->rol}' creado con éxito.");
        })->name('admin.crear-usuario');

        Route::get('/admin/edicion', function () {
            session([
                'modo_edicion' => true,
                'modo_edicion_last_activity' => time(),
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Modo edición activado. Las opciones de edición crítica ahora son usables.');
        })->middleware('password.confirm')->name('admin.edicion');

        // Salir del modo edición administrativa, invalidar confirmación de password de Laravel y retornar al dashboard
        Route::get('/admin/salir-edicion', function () {
            session()->forget([
                'modo_edicion',
                'modo_edicion_last_activity',
                'auth.password_confirmed_at', // Fuerza la reconfirmación de contraseña al volver a entrar
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Modo edición desactivado. Ha retornado al modo de visualización segura.');
        })->name('admin.salir-edicion');

        // Acción crítica: Alternar estado de cuentas de usuario. Requiere que el modo_edicion esté activo en sesión.
        Route::patch('/admin/usuarios/{user}/toggle', function (User $user) {
            // Defensa: Bloquear si no se encuentra en modo edición
            if (! session('modo_edicion')) {
                abort(403, 'Acción bloqueada. Debe activar el Modo Edición para realizar modificaciones en las unidades.');
            }

            if ($user->id === auth()->id()) {
                return back()->with('error', 'No puede deshabilitar su propia cuenta de administrador.');
            }

            $user->update([
                'activo' => ! $user->activo,
            ]);

            $statusText = $user->activo ? 'habilitada' : 'deshabilitada';

            return back()->with('success', "La cuenta de {$user->name} ha sido {$statusText} con éxito.");
        })->name('admin.usuarios.toggle');
    });

    // Rutas exclusivas de Carga Masiva (Excel)
    Route::middleware(['role:admin,cargador'])->group(function () {
        Route::get('/actividades/importar', function () {
            return view('actividades.import');
        })->name('actividades.importar');
    });

    // Rutas exclusivas de Unidades Operativas
    Route::middleware(['role:unidad'])->group(function () {
        Route::get('/unidad/dashboard', function () {
            return view('unidad.dashboard');
        })->name('unidad.dashboard');
    });
});
require __DIR__.'/settings.php';
