<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Nome' => $this->name,
            'Foto' => $this->photo,
            'Nome de usuário' => $this->username,
            'E-mail' => $this->email,
            'Aderiu em' =>$this->created_at->format('d-m-y')
        ];
    }
}
