<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\{Hash, Auth, DB};
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest as UsRequest;
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
        $user = US::find($id);
        $userData = new UserResource($user);

        return response()->json([
            'status' => true,
            'user'=>$userData
        
        ], 200);
    }

    /**
     * Método para validar se o usuário é o dono do perfil
     */
    private function isOwner($user)
    {
        if (Auth::user()->id === $user->id) {

            return true;
        }    
    }

    /**
     * Método para atualizar dados do usuário
     */
    public function update(UsRequest $request, string $id)
    {
        try{
            $user = US::findOrfail($id);

            if (!$this->isOwner($user)) {
                abort(404);
            }

            $userData = $request->validated();

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

            $userData = [
                'name' => $userData['name'],
                'photo' => $photo,
                'email'=> $userData['email'] ?? $user->email
            ];

            $user->update($userData);

            return response()->json([
                'status' => true,
                'message' => 'Dados atualizados com sucesso!'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=>'Não conseguimos editar os teus dados!',
            ], 400);
        }

    }

    /**
     * Método para eliminar a conta do usuário
     */
    public function deleteAcount(UsRequest $request, string $id)
    {
        try {    
            $userData = $request->validated();

            $Authuser = US::where('email', $userData['email'])->where('id', Auth::user()->id)->exists();
    
            if (!$Authuser) {
                return response()->json([
                    'status' => false,
                    'message '=> 'Lamentamos, mas o e-mail não está correto!',
                ], 422);
    
            }else {
                $user = US::findOrfail($id);
                
                if (!$this->isOwner($user)) {
                    abort(404);
                }

                $user->delete();
                $user->tokens()->delete();
    
                return response()->json([
                    'status' => true,
                    'message '=> 'Conta eliminada com sucesso',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=>'Não conseguimos eliminar a tua conta!',
            ], 400);
        }  
    }
}