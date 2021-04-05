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
     * @OA\Get(
     *     tags={"/cliente"},
     *     summary="Mostra uma listagem de clientes",
     *     description="Mostra uma listagem páginada de clientes cadastrados",
     *     path="/cliente",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *          response="200", description="Listagem de clientes"
     *     )
     * )
     *
     * @return Cliente
     */
    public function index()
    {
        return Cliente::with('planos')->paginate(5);
    }

    /**
     * @OA\Post(
     *     tags={"/cliente"},
     *     summary="Adiciona um cliente",
     *     description="Adiciona um cliente",
     *     path="/cliente",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="nome", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *              @OA\Property(property="data_nascimento", type="date"),
     *              @OA\Property(property="cidade", type="string"),
     *              @OA\Property(property="estado", type="string"),
     *              @OA\Property(property="planos", type="array", @OA\Items(type="integer")),
     *         )
     *      ),
     *     @OA\Response(
     *          response="201", description="Novo cliente adicionado"
     *     )
     * )
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
     * @OA\Get(
     *     tags={"/cliente"},
     *     summary="Mostra um cliente",
     *     description="Mostra o cliente cliente informado",
     *     path="/cliente/{cliente}",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          description="cliente_id",
     *          in="path",
     *          name="cliente",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200", description="Exibir cliente"
     *     )
     * )
     *
     * @param  \App\Models\Cliente  $cliente
     * @return Cliente
     */
    public function show(Cliente $cliente)
    {
        $clientePesquisado = Cliente::with('planos')->find($cliente);
        return $clientePesquisado;
    }

    /**
     * @OA\Put(
     *     tags={"/cliente"},
     *     summary="Atualiza um cliente",
     *     description="Atualiza as informações de um cliente",
     *     path="/cliente/{cliente}",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          description="cliente_id",
     *          in="path",
     *          name="cliente",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          )
     *     ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="nome", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *              @OA\Property(property="data_nascimento", type="date"),
     *              @OA\Property(property="cidade", type="string"),
     *              @OA\Property(property="estado", type="string"),
     *              @OA\Property(property="planos", type="array", @OA\Items(type="integer")),
     *         )
     *      ),
     *     @OA\Response(
     *          response="200", description="Exibir cliente"
     *     )
     * )
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
     * @OA\Delete(
     *     tags={"/cliente"},
     *     summary="Exclui um cliente",
     *     description="Exclui as informações de um cliente",
     *     path="/cliente/{cliente}",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          description="cliente_id",
     *          in="path",
     *          name="cliente",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          )
     *     ),
     *     @OA\Response(
     *          response="204", description="Excluir cliente"
     *     )
     * )
     *
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
