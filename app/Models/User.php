<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;


#[Fillable([
    'name',
    'email',
    'password',
    'rol',
    'usuario_estado'
])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    protected $table = 'usuario';

    protected $primaryKey = 'usuario_id';

    public $timestamps = false;

    /**
     * Laravel usará esta columna como password
     */
    public function getAuthPassword(): string
    {
        return $this->usuario_pass;
    }

    /**
     * Laravel usará este campo como "email"
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->usuario_correo;
    }

    /**
     * Opcional: si quieres que Auth::user()->name funcione
     */
    public function getNameAttribute(): ?string
    {
        return $this->usuario_nombre;
    }

    /**
     * Opcional: si quieres que Auth::user()->email funcione
     */
    public function getEmailAttribute(): ?string
    {
        return $this->usuario_correo;
    }

    public function getRememberTokenName()
    {
        return null;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
    /**
     * Relación con las actividades asignadas para su correspondiente verificación.
     */
    public function actividadesAsignadas(): HasMany
    {
        return $this->hasMany(Actividad::class, 'usuario_id_asignado', 'usuario_id');
    }
}
