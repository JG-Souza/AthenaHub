<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->name,
            'email' => $this->email,
            'telefone' => $this->phone,
            'role' => $this->role,
            'cpf' => $this->cpf,
            'criado_em' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
