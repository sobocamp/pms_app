<?php

namespace App\Models;

use App\Models\ExtracurricularRegistration;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Extracurricular
 *
 * Model ini mewakili entitas ekstrakurikuler di sistem.
 *
 * @property int $id
 * @property string $name        Nama ekstrakurikuler
 * @property string $description Deskripsi ekstrakurikuler
 * @property int $quota          Kuota maksimum peserta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|ExtracurricularRegistration[] $registrations
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $pembina
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $participants
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $approvedParticipants
 */
class Extracurricular extends Model
{
    /**
     * Kolom yang bisa diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'quota'];

    /**
     * Relasi one-to-many ke tabel ekstrakurikuler_registrations.
     *
     * Setiap ekstrakurikuler bisa memiliki banyak pendaftaran peserta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(ExtracurricularRegistration::class);
    }

    /**
     * Relasi many-to-many ke User sebagai pembina.
     *
     * Mengambil semua user dengan role 'pembina' yang terkait dengan ekstrakurikuler ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pembina(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'extracurricular_user')
                    ->where('role', 'pembina');
    }

    /**
     * Relasi many-to-many ke User sebagai peserta.
     *
     * Mengambil semua peserta yang mendaftar ekstrakurikuler ini melalui pivot
     * 'extracurricular_registrations', termasuk kolom pivot status dan registration_period_id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'extracurricular_registrations')
                    ->withPivot('status', 'registration_period_id')
                    ->withTimestamps();
    }

    /**
     * Relasi many-to-many ke User sebagai peserta yang diterima.
     *
     * Mengambil semua peserta yang mendaftar ekstrakurikuler ini melalui pivot
     * 'extracurricular_registrations' dengan status 'approved'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function approvedParticipants()
    {
        return $this->belongsToMany(User::class, 'extracurricular_registrations')
            ->wherePivot('status', 'approved');
    }
}
