<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationPeriod extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'is_active'];

    public function registrations()
    {
        return $this->hasMany(ExtracurricularRegistration::class);
    }
}
