<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\{Validator, Hash, Auth, DB,};
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\UserResource;
use App\Http\Controllers\AuthController;
use App\Models\{
    User as US,
};
use Illuminate\Support\{Carbon, Str};

class ProfileController extends Controller
{
    /**
     * Método para visualizar os dados do usuário
     */
    public function show(string $id)
    {
        try {
            $user = US::find($id);
            $userData = new UserResource($user);

            return response()->json([
                'user'=>$userData
            
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
    }

    /**
     * Método para atualizar dados do usuário
     */
    public function update(Request $request, string $id)
    {
        try{
            $user = Auth::user();

            if ($id !== $user->id) {
                return response()->json([
                    'message '=> 'Algo deu errado! Tente mais tarde',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name'=>'required|regex:/^[a-zA-ZÀ-úçÇ\s]+$/u|min:5|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            ],[
                'name.required'=>'É obrigatório fornecer um nome',
                'name.regex'=>'Só é permitido usar nome com letras',
                'name.min'=>'O nome deve conter no mínimo :min letras',
                'name.max'=>'O nome deve conter no máximo :max letras',

                'photo.image' => 'So pode carregar uma imagem',
                'photo.mimes' => 'A imagem só pode ser peg,png,jpg,gif',
                'photo.max' => 'O tamanho máximo da imagem deve ser de 1MB',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message '=> 'Erro ao atualizar os dados do perfil',
                    'erros' => $validator
                ], 422);
            }

            //Se o Usuário enviar alguma foto
            if ($request->hasFile('photo')){
                if($user->photo === null) {
                    $file = $request->file('photo');
                    $fileName = time() . '_' . $file->getClientOriginalName();

                    $photo = $file->storeAs('profilephotos', $fileName);
                }
                else{
                    Storage::delete($user->photo);
                    $file = $request->file('photo');

                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $photo = $file->storeAs('profilephotos', $fileName);
                }
            }
            else {
                $photo = $user->photo;
            }

            $user->update([
                'name' => preg_replace('/\s+/', ' ', $request->name),
                'photo' => $photo,
            ]);

            return response()->json([
                'message' => 'Dados atualizados com sucesso!'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }

    }

    /**
     * Método para eliminar a conta do usuário
     */
    public function deleteAcount(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'=>'required|email|max:255',
            ],[
                'email.required'=>'É obrigatório fornecer o seu e-mail',
                'email.email'=>'Deve fornecer um email válido',
                'email.max'=>'O e-mail deve conter no máximo :max letras',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'message '=> 'Erro ao deletar a conta',
                    'erros' => $validator
                ], 422);
            }
    
            $Authuser = US::where('email', $request->email)->where('id', Auth::user()->id)->exists();
    
            if (!$Authuser) {
                return response()->json([
                    'message '=> 'Lamentamos, mas o e-mail não está correto!',
                ], 422);
    
            }else {
                $user = US::findOrfail($id);
                
                $user->delete();
                $user->tokens()->delete();
    
                return response()->json([
                    'message '=> 'Conta eliminada com sucesso',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Algo deu errado! Tente mais tarde...'
            ], 500);
        }
           
    }
}