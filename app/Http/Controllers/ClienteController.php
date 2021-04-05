<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use App\Models\Plano;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Cliente
     */
    public function index()
    {     
        return Cliente::with('planos')->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClienteStoreRequest  $request
     * @return ClienteResource
     */
    public function store(ClienteStoreRequest $request)
    {
        $cliente = Cliente::create($request->validated());
        $cliente->planos()->sync($request->planos);
        return new ClienteResource($cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return ClienteResource
     */
    public function show(Cliente $cliente)
    {
        $clientePesquisado = Cliente::with('planos')->find($cliente);
        return $clientePesquisado;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClienteUpdateRequest $request
     * @param  \App\Models\Cliente  $cliente
     * @return ClienteResource
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());
        $cliente->planos()->sync($request->planos);

        return new ClienteResource($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Cliente $cliente)
    {

        if($cliente->estado === 'São Paulo'){
            $clientePlanos = $cliente->planos->toArray();
            foreach ($clientePlanos as $plano){
                if($plano['id'] === 1){
                    return response()->json('Este cliente não pode ser excluído', 403);
                }
            }
        }

        $cliente->delete();

        return response()->json(null, 204);
    }
}
