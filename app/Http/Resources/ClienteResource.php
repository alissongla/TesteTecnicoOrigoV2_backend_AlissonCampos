<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'estado' => $this->estado,
            'cidade' => $this->cidade,
            'data_nascimento' => $this->data_nascimento->format('d/m/Y'),
        ];
    }
}
