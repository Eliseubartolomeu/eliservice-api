<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Serviço' => $this->name,
            'Descrição' => $this->description,
            'Tempo (em Min)' => $this->duration,
            'Preço (AKZ)' => $this->price,
        ];
    }
}
