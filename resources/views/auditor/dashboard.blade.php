@extends('layouts.app')

@section('title', 'Dashboard Auditoría - Intranet CAJBIOBIO')

@section('content')
<div class="panel-header-section" style="margin-bottom: 25px;">
    <h2>Dashboard de Auditoría</h2>
    <p style="margin: 5px 0 0; color: #64748b; font-size: 0.95rem;">
        Consola de monitoreo analítico de solo lectura (Filtro actual: <strong>{{ $view === 'mes' ? 'Este Mes' : 'Todo el Año' }}</strong>).
    </p>
</div>

<!-- Tarjeta Informativa de Solo Lectura -->
<div style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 20px; margin-bottom: 25px; display: flex; align-items: flex-start; gap: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.01);">
    <span style="font-size: 1.5rem; line-height: 1;">🔍</span>
    <div>
        <strong style="color: #1e40af; font-size: 1rem; display: block; margin-bottom: 4px;">Supervisión de Auditoría Global</strong>
        <p style="color: #1e3a8a; font-size: 0.85rem; margin: 0; line-height: 1.5;">
            Visualice y supervise los reportes a nivel nacional. Use las pestañas para conmutar entre el periodo de carga actual o la consolidación anual, y envíe correos de renotificación síncronos a las unidades que registren actividades atrasadas.
        </p>
    </div>
</div>

<!-- Control de Vistas Periodificadas (Pestañas/Tabs) -->
<div style="display: flex; gap: 12px; margin-bottom: 30px; border-bottom: 1px solid #cbd5e1; padding-bottom: 15px;">
    <a href="{{ route('auditor.dashboard', ['view' => 'mes']) }}" 
       style="padding: 10px 20px; font-size: 0.85rem; font-weight: 700; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;
              @if($view === 'mes') background-color: #0F69C4; color: #ffffff !important; @else background-color: #ffffff; color: #475569 !important; border: 1px solid #cbd5e1; @endif">
        📅 Visualizar Este Mes (M.E. actual)
    </a>
    <a href="{{ route('auditor.dashboard', ['view' => 'ano']) }}" 
       style="padding: 10px 20px; font-size: 0.85rem; font-weight: 700; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;
              @if($view === 'ano') background-color: #0F69C4; color: #ffffff !important; @else background-color: #ffffff; color: #475569 !important; border: 1px solid #cbd5e1; @endif">
        📆 Visualizar Todo el Año ({{ $currentYear }})
    </a>
</div>

<!-- Tarjetas de Indicadores Consolidados -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 35px;">
    
    <!-- Total Actividades -->
    <div style="background-color: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
        <span style="font-size: 0.75rem; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.5px;">Actividades Totales</span>
        <h2 style="font-size: 2.2rem; color: #0d1b2a; margin: 10px 0 0; font-weight: 800;">{{ $totalActividades }}</h2>
        <p style="margin: 5px 0 0; font-size: 0.8rem; color: #94a3b8;">{{ $view === 'mes' ? 'Mes estadístico en curso' : 'Acumulado anual' }}</p>
    </div>

    <!-- Pendientes -->
    <div style="background-color: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
        <span style="font-size: 0.75rem; text-transform: uppercase; color: #ef3340; font-weight: 700; letter-spacing: 0.5px;">Pendientes de Firma</span>
        <h2 style="font-size: 2.2rem; color: #ef3340; margin: 10px 0 0; font-weight: 800;">{{ $totalCargadas }}</h2>
        <p style="margin: 5px 0 0; font-size: 0.8rem; color: #fca5a5;">{{ $view === 'mes' ? 'Atrasadas este mes' : 'Atrasadas acumuladas' }}</p>
    </div>

    <!-- Verificadas -->
    <div style="background-color: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
        <span style="font-size: 0.75rem; text-transform: uppercase; color: #2b8a3e; font-weight: 700; letter-spacing: 0.5px;">Verificadas con Éxito</span>
        <h2 style="font-size: 2.2rem; color: #2b8a3e; margin: 10px 0 0; font-weight: 800;">{{ $totalVerificadas }}</h2>
        <p style="margin: 5px 0 0; font-size: 0.8rem; color: #86efac;">{{ $view === 'mes' ? 'Verificadas este mes' : 'Verificadas acumuladas' }}</p>
    </div>

    <!-- Tasa de Avance -->
    <div style="background-color: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
        <span style="font-size: 0.75rem; text-transform: uppercase; color: #0F69C4; font-weight: 700; letter-spacing: 0.5px;">Porcentaje de Avance</span>
        <h2 style="font-size: 2.2rem; color: #0F69C4; margin: 10px 0 0; font-weight: 800;">{{ $porcentajeVerificacion }}%</h2>
        <div style="margin-top: 8px; width: 100%; height: 6px; background-color: #e2e8f0; border-radius: 3px; overflow: hidden;">
            <div style="width: {{ $porcentajeVerificacion }}%; height: 100%; background-color: #0F69C4;"></div>
        </div>
    </div>

</div>

<!-- Sección Central: Estadísticas Territoriales por Región -->
<div style="background-color: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 8px; padding: 25px; margin-bottom: 35px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
    <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 1.15rem; color: #0d1b2a; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
        <span>🗺️ Desempeño Territorial Regional</span>
        <span style="font-size: 0.8rem; color: #64748b; font-weight: 500;">Filtro: {{ $view === 'mes' ? 'Este Mes' : 'Acumulado Anual' }}</span>
    </h3>
    
    <div style="overflow-x: auto;">
        <table class="table-custom-data" style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <thead>
                <tr>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: left; font-size: 0.8rem; font-weight: 700; color: #475569;">Región</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: left; font-size: 0.8rem; font-weight: 700; color: #475569;">Director Regional</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: center; font-size: 0.8rem; font-weight: 700; color: #475569;">Unidades</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: center; font-size: 0.8rem; font-weight: 700; color: #475569;">Cargadas</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: center; font-size: 0.8rem; font-weight: 700; color: #475569;">Verificadas</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: right; font-size: 0.8rem; font-weight: 700; color: #475569; width: 180px;">Progreso</th>
                </tr>
            </thead>
            <tbody>
                @foreach($regionesEstadisticas as $stat)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 14px 16px; font-weight: 700; color: #0F69C4; font-size: 0.9rem;">{{ $stat['nombre'] }}</td>
                    <td style="padding: 14px 16px; font-size: 0.85rem; color: #475569;">{{ $stat['director'] }}</td>
                    <td style="padding: 14px 16px; font-size: 0.85rem; color: #334155; text-align: center; font-weight: 600;">{{ $stat['unidades_count'] }}</td>
                    <td style="padding: 14px 16px; font-size: 0.85rem; color: #ef3340; text-align: center; font-weight: 600;">{{ $stat['cargadas'] }}</td>
                    <td style="padding: 14px 16px; font-size: 0.85rem; color: #2b8a3e; text-align: center; font-weight: 600;">{{ $stat['verificadas'] }}</td>
                    <td style="padding: 14px 16px; text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
                            <span style="font-size: 0.8rem; font-weight: 700; color: #0d1b2a;">{{ $stat['avance'] }}%</span>
                            <div style="width: 80px; height: 8px; background-color: #e2e8f0; border-radius: 4px; overflow: hidden; display: inline-block;">
                                <div style="width: {{ $stat['avance'] }}%; height: 100%; background-color: #2b8a3e;"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Panel: Unidades Pendientes con Reenvío de Notificación -->
<div style="background-color: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 8px; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); margin-bottom: 35px;">
    <h3 style="margin-top: 0; margin-bottom: 12px; font-size: 1.1rem; color: #0d1b2a; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
        <span>📢 Unidades Pendientes de Verificación ({{ $unidadesPendientes->count() }})</span>
        <span style="font-size: 0.8rem; color: #64748b; font-weight: 500;">Periodo: {{ $view === 'mes' ? 'Este Mes' : 'Anual' }}</span>
    </h3>
    <p style="color: #64748b; font-size: 0.85rem; line-height: 1.5; margin-bottom: 20px;">
        A continuación se listan las unidades operativas que registran actividades en estado <strong>CARGADA</strong> para el periodo seleccionado. Como auditor, puede enviarles una renotificación por correo directamente para agilizar sus firmas de verificador.
    </p>

    @if($unidadesPendientes->isEmpty())
    <div style="text-align: center; padding: 30px; color: #2b8a3e; background-color: rgba(43, 138, 62, 0.02); border: 1px dashed #2b8a3e; border-radius: 6px; font-size: 0.9rem; font-weight: 600;">
        ✅ ¡Excelente! No existen unidades con actividades pendientes de verificación para este periodo.
    </div>
    @else
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 15px; max-height: 400px; overflow-y: auto; padding-right: 5px;">
        @foreach($unidadesPendientes as $up)
        <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; padding: 15px; display: flex; justify-content: space-between; align-items: center; gap: 15px;">
            <div style="flex: 1;">
                <strong style="color: #0d1b2a; font-size: 0.9rem; display: block;">{{ $up->user->name }}</strong>
                <span style="font-size: 0.8rem; color: #64748b; display: block; margin-top: 2px;">
                    Región: <strong>{{ $up->region->region_nombre }}</strong>
                </span>
                <span style="font-size: 0.75rem; color: #94a3b8; display: block;">
                    Email: {{ $up->user->email }}
                </span>
            </div>
            <div>
                <form action="{{ route('auditor.unidades.renotificar', $up->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-acc" style="padding: 8px 14px; font-size: 0.8rem; font-weight: 700; border-color: #0F69C4; color: #0F69C4 !important; background-color: rgba(15, 105, 196, 0.02); border-radius: 4px; cursor: pointer;">
                        Renotificar ✉️
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<!-- Panel: Historial de Cargas Masivas -->
<div style="background-color: #ffffff; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 8px; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); margin-bottom: 30px;">
    <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 1.1rem; color: #0d1b2a; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
        📋 Historial Reciente de Planillas Excel Cargadas
    </h3>
    
    @if($cargasRecientes->isEmpty())
    <div style="text-align: center; padding: 30px; color: #94a3b8; font-size: 0.9rem;">
        No se registran importaciones recientes de planillas.
    </div>
    @else
    <div style="display: flex; flex-direction: column; gap: 15px;">
        @foreach($cargasRecientes as $carga)
        <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; padding: 15px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong style="color: #0d1b2a; font-size: 0.9rem; display: block;">{{ $carga->nombre_archivo }}</strong>
                <span style="font-size: 0.8rem; color: #64748b;">
                    Subido por <strong>{{ $carga->usuario->name }}</strong> el {{ $carga->created_at->format('d-m-Y H:i') }}
                </span>
            </div>
            <div style="text-align: right;">
                <span style="background-color: rgba(43, 138, 62, 0.1); color: #2b8a3e; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 4px;">
                    {{ $carga->estado }}
                </span>
                <span style="font-size: 0.8rem; color: #475569; font-weight: 600;">
                    {{ $carga->total_filas }} filas
                </span>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection