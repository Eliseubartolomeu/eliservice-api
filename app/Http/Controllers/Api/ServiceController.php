<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\{Validator, Hash, Auth, DB,};
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\AuthController;
use App\Models\{
    Service as SV,
};

class ServiceController extends Controller
{
    /**
     * Método para mostrar todos os serviços disponiveis
     */
    public function index()
    {        
        try {
            $services = SV::all();
    
            $cleanServices = ServiceResource::collection($services);

            return response()->json([
                'services'=> $cleanServices
            
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

    /**
     * Método para mostrar um serviço especifico
     */
    public function show(string $id)
    {
        try {
            $service = SV::find($id);

            $cleanService = new ServiceResource($service);

            return response()->json([
                'service'=> $cleanService
            
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

}
