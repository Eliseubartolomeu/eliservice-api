<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\{Validator, Hash, Auth, DB};
use Illuminate\Http\RedirectResponse;
use App\Models\{
    User as US,
    Role as RL
};
use App\Traits\Auth\UsernameTrait as UsnameT;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\{Carbon, Str};

class RegisterController extends Controller
{
    use UsnameT;
    /**
     * Método para cadastrar usuário
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ],[
                'name.required' => 'O campo nome é obrigatório.',
                'name.string' => 'O campo nome deve ser um texto.',
                'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'Por favor, insira um endereço de email válido.',
                'email.unique' => 'Este email já está registado.',
                'password.required' => 'O campo palavra-passe é obrigatório.',
                'password.min' => 'A palavra-passe deve ter pelo menos 6 caracteres.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message '=> 'Erro ao criar a conta',
                    'erros' => $validator
                ], 422);
            }
    
            $username = UsnameT::CreateUsername($request->name);
    
            $role = RL::where('name', 'cliente')->first();
    
            $userData = [
                'name' => $request->name, 
                'username' => $username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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
