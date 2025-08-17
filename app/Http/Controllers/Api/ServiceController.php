<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\{
    Validator, Hash, Auth, DB,
};
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\AuthController;
use App\Models\{
    Service as SV,
};

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
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
        
    }

    /**
     * Display the specified resource.
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
