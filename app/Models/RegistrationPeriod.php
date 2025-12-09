<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\ExtracurricularRegistration;
use App\Models\Extracurricular;

/**
 * Class RegistrationPeriod
 *
 * Model ini mewakili periode pendaftaran ekstrakurikuler.
 *
 * @property int $id
 * @property string $name                   Nama periode pendaftaran
 * @property string $start_date             Tanggal mulai periode pendaftaran (Y-m-d)
 * @property string $end_date               Tanggal akhir periode pendaftaran (Y-m-d)
 * @property bool $is_active                Status apakah periode ini aktif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|ExtracurricularRegistration[] $registrations
 * @property-read \Illuminate\Database\Eloquent\Collection|Extracurricular[] $extracurriculars
 */
class RegistrationPeriod extends Model
{
    /**
     * Kolom yang bisa diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active'
    ];

    /**
     * Relasi one-to-many ke ExtracurricularRegistration.
     *
     * Setiap periode pendaftaran bisa memiliki banyak pendaftaran peserta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(ExtracurricularRegistration::class);
    }

    public function extracurriculars(): BelongsToMany
    {
        return $this->belongsToMany(Extracurricular::class, 'extracurricular_registrations')
                    ->withPivot('status');
    }
}
