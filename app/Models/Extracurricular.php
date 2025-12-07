<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $fillable = ['name', 'description', 'quota'];

    public function registrations()
    {
        return $this->hasMany(ExtracurricularRegistration::class);
    }

    public function pembina()
    {
        return $this->belongsToMany(User::class, 'extracurricular_user')->where('role', 'pembina');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'extracurricular_registrations')
                    ->withPivot('status', 'registration_period_id')
                    ->withTimestamps();
    }
}
