<?php

namespace App\Policies;

use App\Models\{Appointment, User};
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    /**
     * Determina se o usuário pode visualizar o agendamento.
     */
    public function view(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }

    /**
     * Determina se o usuário pode atualizar o agendamento.
     */
    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }

    /**
     * Determina se o usuário pode deletar o agendamento.
     */
    public function delete(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }
}
