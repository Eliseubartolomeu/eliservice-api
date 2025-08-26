<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use App\Models\{
    Service as SV,
    User as US
};

class HomeController extends Controller
{
    /**
     * Método inicial da home
     */
    public function index()
    {
        $services = SV::all();

        $services = ServiceResource::collection($services);

        $users = US::with(['appointments'])->orderBy('id', 'asc')->get()->map(function ($user) {
            return (object)[
                'name' => $user->name,
                'Número de agendamentos' => $user->appointments->count(),
            ];
        });

        return response()->json([
            'status' => true,
            'users' => $users,
            'services' => $services
        ], 200);

    }
}
