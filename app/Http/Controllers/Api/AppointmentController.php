<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AppointmentResource;
use Illuminate\Support\Facades\{Validator, Hash, Auth, DB,};
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\AuthController;
use App\Models\{
    Appointment as AP,
};
use Illuminate\Support\{Carbon, Str};

class AppointmentController extends Controller
{
    /**
     * Método para visualizar todos os agendamentos de um determinado usuário
     */
    public function index()
    {
        try {

            $AuthId = Auth::user()->id;
            $appointments = AP::where('user_id', $AuthId)->get();
            
            $cleanAppointments = AppointmentResource::collection($appointments);

            return response()->json([
                'appointments'=> $cleanAppointments            
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

    /**
     * Método para criar um agendamento
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'service'=>'required|string',
                'date'=> 'required|date',
                'start_time' => 'required|string',
            ],[
                'service.required'=>'É obrigatório fornecer um serviço para agendar',
                'service.string'=>'Deve fornecer um serviço válido',

                'date.required' => 'Deve fornecer uma data para a realização do serviço!',
                'date.date' => 'Deve fornecer uma data válida!',

                'start_time.required' => 'Deve fornecer um horario para o inicio do serviço',
                'start_time.string' => 'Por favor insira um horário válido',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message '=> 'Erro ao agendar serviço',
                    'erros' => $validator
                ], 422);
            }

            $serviceData = [
                'user_id' => Auth::user()->id, 
                'service_id' => $request->service,
                'date' => $request->date,
                'start_time' => $request->start_time
            ];

            $createService = AP::create($serviceData);

            return response()->json([
                'message' => 'Serviço agendado com sucesso!',
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

    /**
     * Método para visualizar um agendamento
     */
    public function show(string $id)
    {
        try {
            $appointment = AP::findOrfail($id);
                
            $cleanAppointment = new AppointmentResource($appointment);

            return response()->json([
                'appointment'=> $cleanAppointment
            
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

    /**
     * Método para atualizar os dados do agendamento
     */
    public function update(Request $request, string $id)
    {
        try{
            $service = AP::findOrfail($id);

            $validator = Validator::make($request->all(), [
                'date' => 'required|date',
                'start_time' => 'required|string',
            ],[
                'date.required' => 'Deve fornecer uma data de inicio do serviço',
                'date.date' => 'A data de inicio deve ser uma data válida',

                'start_time.required' => 'Deve fornecer um horario para o inicio do serviço',
                'start_time.string' => 'Por favor insira um horário válido',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message '=> 'Erro ao atualizar os dados do agendamento',
                    'erros' => $validator
                ], 422);
            }

            $user = Auth::user();

            if ($service->user_id !== $user->id) {
                return response()->json([
                    'message '=> 'Algo deu errado! Tente mais tarde',
                ], 400);
            }

            $serviceData = [
                'date' => $request->date,
                'start_time' => $request->start_time
            ];

            $service->update($serviceData);

            return response()->json([
                'message' => 'Agendamento atualizado com sucesso!',
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

    /**
     * Método para eliminar agendamento
     */
    public function destroy(string $id)
    {
        try{
            $appointment = AP::findOrfail($id);

            if ($appointment->user_id === Auth::user()->id) {
                
                $appointment->delete();

                return response()->json([
                    'message' => 'Agendamento eliminado com sucesso!',
                ], 200);

            }else {

                return response()->json([
                    'message' => 'Erro ao eliminar o agendamento!',
                ], 422);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }
}
