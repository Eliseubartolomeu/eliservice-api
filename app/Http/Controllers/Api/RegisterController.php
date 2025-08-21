<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest as UsRequest;
use Illuminate\Support\Facades\{Hash, Auth, DB};
use Illuminate\Http\RedirectResponse;
use App\Models\{
    User as US,
    Role as RL
};
use App\Traits\Auth\UsernameTrait as UsnameT;
use Illuminate\Support\{Carbon, Str};

class RegisterController extends Controller
{
    use UsnameT;
    /**
     * Método para cadastrar usuário
     */
    public function store(UsRequest $request)
    {
        try {
            $userData = $request->validated();

            $username = UsnameT::CreateUsername($request->name);
    
            $role = RL::where('name', 'cliente')->first();
    
            $userData = [
                'name' => $userData['name'], 
                'username' => $username,
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role_id' => $role->id
            ];
    
            $createUser = US::create($userData);
    
            return response()->json([
                'message' => 'Conta criada com sucesso!',
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }

    }
}
