<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ClientePlanoTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function clientePlanoStore()
    {
        Sanctum::actingAs(User::factory()->create());
        $cliente = Cliente::factory()->create();
        $plano= Plano::factory()->create();
        $cliente->planos()->sync($plano);

        $this->assertDatabaseHas('cliente_plano', [
            'cliente_id' => $cliente->id,
            'plano_id' => $plano->id
        ]);
    }
}
