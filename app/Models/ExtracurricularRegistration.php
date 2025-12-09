<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Extracurricular;
use App\Models\RegistrationPeriod;

/**
 * Class ExtracurricularRegistration
 *
 * Model ini mewakili pendaftaran seorang siswa pada suatu ekstrakurikuler
 * dalam periode registrasi tertentu.
 *
 * @property int $id
 * @property int $user_id                  ID siswa yang mendaftar
 * @property int $extracurricular_id      ID ekstrakurikuler
 * @property int $registration_period_id  ID periode pendaftaran
 * @property string $status               Status pendaftaran (misal: 'pending', 'approved', 'rejected')
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read User $student
 * @property-read Extracurricular $extracurricular
 * @property-read RegistrationPeriod $registrationPeriod
 */
class ExtracurricularRegistration extends Model
{
    /**
     * Kolom yang bisa diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'extracurricular_id',
        'registration_period_id',
        'status'
    ];

    /**
     * Relasi many-to-one ke User (siswa).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi many-to-one ke Extracurricular.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function extracurricular(): BelongsTo
    {
        return $this->belongsTo(Extracurricular::class);
    }

    /**
     * Relasi many-to-one ke RegistrationPeriod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registrationPeriod(): BelongsTo
    {
        return $this->belongsTo(RegistrationPeriod::class, 'registration_period_id');
    }
}
