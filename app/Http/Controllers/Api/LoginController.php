<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\{Validator, Hash, Auth, DB};
use Illuminate\Http\RedirectResponse;
use App\Models\User as US;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\{Carbon, Str};

class LoginController extends Controller
{
    /**
     * Método para gerenciar o login do usuário
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required',
            ],[
                'email.required'=>'Por favor forneça um e-mail!',
                'email.email'=>'Por favor forneça um e-mail válido!',
                'password.required'=>'Digite a senha!',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message '=> 'Erro ao iniciar sessão',
                    'erros' => $validator->errors()
                ], 422);
            }
    
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                
                $user = Auth::user();

                $isAuth = DB::table('personal_access_tokens')
                ->where('tokenable_id', $user->id)->delete();

                $token = $request->user()->createToken('api-token')->plainTextToken;
        
                return $this->SuccessfulLogin($user, $token);
    
            }else {
                return $this->FailedLogin();
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

    /**
     * Metodo para manipular um login sucedido
     */
    private function SuccessfulLogin($user, $token)
    {
        $authUserData = new UserResource($user);        
        return response()->json([
            'status'=>'true',
            'token'=>$token,
            'user'=>$authUserData,
            'message'=> $user->name . ' Seja bem vindo!',
        ], 200);

    }

    /**
     * Metodo para manipular um login falhado
     */
    private function FailedLogin()
    {
        return response()->json([
            'status'=>'false',
            'message'=>'Dados incorretos! Revê o que escreveu errado e tente novamente',
        ], 400);
    }


    /**
     * Método para gerenciar o logout
     */
    public function logout(US $user): JsonResponse 
    {
        try {

            $user->tokens()->delete();

            return response()->json([
                'status'=>'true',
                'message'=>'A sua sessão foi terminada com sucesso!',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'false',
                'message'=>'Não conseguimos terminar a sua sessão por causa de um erro interno!',
            ], 400);
        }
    }
}
