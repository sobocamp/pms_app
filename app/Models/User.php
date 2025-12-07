<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function registrations()
    {
        return $this->hasMany(ExtracurricularRegistration::class);
    }

    public function extracurriculars() // ini untuk siswa
    {
        return $this->belongsToMany(Extracurricular::class, 'extracurricular_user');
    }

    public function extracurricularsHandled() // ini untuk pembina
    {
        return $this->belongsToMany(Extracurricular::class, 'extracurricular_user');
        // return $this->belongsToMany(Extracurricular::class, 'extracurricular_user')->where('role', 'pembina');
    }

    public function extracurricularChoices()
    {
        return $this->belongsToMany(Extracurricular::class, 'extracurricular_registrations')
                    ->withPivot('registration_period_id')
                    ->withTimestamps();
    }
}
