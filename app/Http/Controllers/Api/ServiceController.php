<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\RedirectResponse;
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
        $services = SV::all();

        $cleanServices = ServiceResource::collection($services);

        return response()->json([
            'services'=> $cleanServices
        
        ], 200);

    }

    /**
     * Método para mostrar um serviço especifico
     */
    public function show(string $id)
    {
        $service = SV::find($id);

        $cleanService = new ServiceResource($service);

        return response()->json([
            'service'=> $cleanService
        
        ], 200);

    }

}
