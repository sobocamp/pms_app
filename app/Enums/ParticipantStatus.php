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
     * @return ToastMessage
     */
    public function successMessage(): ToastMessage
    {
        return match ($this) {
            self::APPROVED => ToastMessage::EXTRACURRICULAR_APPROVE_SUCCESS,
            self::PENDING  => ToastMessage::EXTRACURRICULAR_PENDING_SUCCESS,
            self::REJECTED => ToastMessage::EXTRACURRICULAR_REJECT_SUCCESS,
        };
    }
}
