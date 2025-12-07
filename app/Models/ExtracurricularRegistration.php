<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtracurricularRegistration extends Model
{
    protected $fillable = ['user_id', 'extracurricular_id', 'registration_period_id', 'status'];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class);
    }

    public function period()
    {
        return $this->belongsTo(RegistrationPeriod::class, 'registration_period_id');
    }
}

