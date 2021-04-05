<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"/plano"},
     *     summary="Mostra uma listagem de planos",
     *     description="Mostra uma listagem páginada de planos cadastrados",
     *     path="/plano",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *          response="200", description="Listagem de planos"
     *     )
     * )
     *
     * @return Plano
     */
    public function index()
    {
        return Plano::paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposition  $proposition
     * @return \Illuminate\Http\Response
     */
    public function show(Proposition $proposition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposition  $proposition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposition $proposition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposition  $proposition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposition $proposition)
    {
        //
    }
}
