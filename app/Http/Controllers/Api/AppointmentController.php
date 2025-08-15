<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Validator, Hash, Auth, DB,
};
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\AuthController;
use App\Models\{
    Appointment as AP,
};
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            ], 500);
        }


        $serviceData = [
            'user_id' => '6151cbff-ebf3-4190-b9c3-f9c090256ee4',//Auth::user()->id, 
            'service_id' => $request->service,
            'date' => $request->date,
            'start_time' => $request->start_time
        ];

        $createService = AP::create($serviceData);

        return response()->json([
            'message' => 'Serviço agendado com sucesso!',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
            ], 500);
        }

        $user = Auth::user();

        if ($service->user_id !== $user->id) {
            return response()->json([
                'message '=> 'Algo deu errado! Tente mais tarde',
            ], 404);
        }

        $serviceData = [
            'date' => $request->date,
            'start_time' => $request->start_time
        ];

        $service->update($serviceData);

        return response()->json([
            'message' => 'Agendamento atualizado com sucesso!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
