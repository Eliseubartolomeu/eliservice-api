<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Resources\AppointmentResource;
use App\Http\Requests\Api\AppointmentRequest as ApRequest;
use Illuminate\Support\Facades\{Auth, DB,};
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\AuthController;
use App\Models\{
    Appointment as AP,
    Service as SV
};
use Illuminate\Support\{Carbon, Str};


class AppointmentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Método para visualizar todos os agendamentos de um determinado usuário
     */
    public function index()
    {
        $AuthId = Auth::user()->id;
        $appointments = AP::where('user_id', $AuthId)->get();
        
        $cleanAppointments = AppointmentResource::collection($appointments);

        return response()->json([
            'status' => true,
            'appointments'=> $cleanAppointments            
        ], 200);
    }

    /**
     * Método para criar um agendamento
     */
    public function store(ApRequest $request)
    {
        $appointmentData = $request->validated();

        
        $existService = SV::where('id', $appointmentData['service'])->exists();
        
        if (!$existService) {
            return response()->json([
                'status' => false,
                'message '=> 'O serviço fornecido não existe!',
            ], 422);

        }else {
            $existAppointment = AP::where('user_id', Auth::user()->id)->where('service_id', $appointmentData['service'])->exists();

            if ($existAppointment) {
                return response()->json([
                    'status' => false,
                    'message '=> 'Você já tem esse serviço agendado, edite a data se aplicável!',
                ], 422);
            }
    
            $appointmentData = [
                'user_id' => Auth::user()->id, 
                'service_id' => $appointmentData['service'],
                'date' => $appointmentData['date'],
                'start_time' => $appointmentData['start_time']
            ];
    
            $createService = AP::create($appointmentData);
    
            return response()->json([
                'status' => true,
                'message' => 'Serviço agendado com sucesso!',
            ], 201);
        }
        

    }

    /**
     * Método para visualizar um agendamento
     */
    public function show(string $id)
    {
        try {
            $appointment = AP::findOrfail($id);
            $this->authorize('view', $appointment);
            
            $cleanAppointment = new AppointmentResource($appointment);

            return response()->json([
                'appointment'=> $cleanAppointment
            
            ], 200);               

        }catch (AuthorizationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Você não tem permissão para acessar este agendamento.'
            ], 403);

        }
    }

    /**
     * Método para atualizar os dados do agendamento
     */
    public function update(ApRequest $request, string $id)
    {
        try{
            $appointment = AP::findOrfail($id);

            $this->authorize('update', $appointment);
            
            $appointmentData = $request->validated();


            $appointmentData = [
                'date' => $appointmentData['date'],
                'start_time' => $appointmentData['start_time']
            ];

            $appointment->update($appointmentData);

            return response()->json([
                'status' => true,
                'message' => 'Agendamento atualizado com sucesso!',
            ], 201);

        }catch (AuthorizationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Você não tem permissão para acessar este agendamento.'
            ], 403);

        } 
    }

    /**
     * Método para eliminar agendamento
     */
    public function destroy(string $id)
    {
        try{
            $appointment = AP::findOrfail($id);

            $this->authorize('delete', $appointment);
            
            $appointment->delete();

            return response()->json([
                'status' => true,
                'message' => 'Agendamento eliminado com sucesso!',
            ], 200);

        }catch (AuthorizationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Você não tem permissão para acessar este agendamento.'
            ], 403);
        } 
    }
}
