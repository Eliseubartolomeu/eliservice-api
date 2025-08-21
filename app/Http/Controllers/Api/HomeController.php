<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use App\Models\{
    Service as SV,
};

class HomeController extends Controller
{
    /**
     * Método inicial da home
     */
    public function index()
    {
        try {
            $services = SV::all();
    
            $services = ServiceResource::collection($services);
            return response()->json([
                'services' => $services
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }
}
