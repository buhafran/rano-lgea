<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\Auditable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Notifiable, HasRoles, Auditable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     protected $fillable = [
        'name',
        'email',
        'password',
        'school_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole([
            'Super Admin',
            'LGEA Admin',
            'Head Teacher',
            'Result Officer',
            'EMIS Officer',
            'Data Entry Clerk',
        ]);
    }
}
