<?php

namespace App\Enums;

use App\Models\Extracurricular;

enum ParticipantStatus: string
{
    case APPROVED = 'approved';
    case PENDING = 'pending';
    case REJECTED = 'rejected';

    /**
     * Jalankan logic update pivot (Strategy)
     *
     * @param Extracurricular $extracurricular
     * @param string $userId
     */
    public function execute(Extracurricular $extracurricular, string $userId): void
    {
        $extracurricular->participants()
            ->updateExistingPivot($userId, ['status' => $this->value]);
    }

    /**
     * Pesan sukses berdasarkan status
     *
     * @return RedirectWithToast
     */
    public function successMessage(): RedirectWithToast
    {
        return match ($this) {
            self::APPROVED => RedirectWithToast::EXTRACURRICULAR_APPROVE_SUCCESS,
            self::PENDING  => RedirectWithToast::EXTRACURRICULAR_PENDING_SUCCESS,
            self::REJECTED => RedirectWithToast::EXTRACURRICULAR_REJECT_SUCCESS,
        };
    }
}
