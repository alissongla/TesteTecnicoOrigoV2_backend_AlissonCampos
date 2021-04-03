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

class ClienteTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function clienteIndex() {
        Sanctum::actingAs(User::factory()->create());
        Cliente::factory($total = $this->faker->numberBetween(15 , 50))
            ->create();

        $response = $this->json('GET', route('cliente.index'));
        $response
            ->assertOk()
            ->assertJsonPath('meta.total', $total);
    }

    /**
     * @test
     */
    public function clienteShow()
    {
        Sanctum::actingAs(User::factory()->create());
        $cliente = Cliente::factory()->create();

        $response = $this->json('GET', route('cliente.show', $cliente));

        //dd($response->decodeResponseJson());
        $response
            ->assertOk()
            ->assertJsonPath('data.nome', $cliente->nome);

    }

    /**
     * @test
     */
    public function clienteStore()
    {
        Sanctum::actingAs($user = User::factory()->create());
        $clienteFake = Cliente::factory()->make();
        $clienteFake->planos = [1];
        $plano= Plano::factory()->create();

        $response = $this->json('POST', route('cliente.store'), $clienteFake->toArray());


        $response->assertCreated();
        $this->assertDatabaseHas('clientes', [
            'email' => $clienteFake->email
        ]);

        $clienteFake->id = 1;
        $this->assertDatabaseHas('cliente_plano', [
            'cliente_id' => $clienteFake->id,
            'plano_id' => $plano->id
        ]);
    }

    /**
     * @test
     */
    public function clienteUpdate()
    {
        Sanctum::actingAs(User::factory()->create());
        $cliente = Cliente::factory()->create();
        $plano= Plano::factory()->create();
        $clienteFake = Cliente::factory()->make();
        $clienteFake->planos = [1];

        $response = $this->json('PUT', route('cliente.update', $cliente), $clienteFake->toArray());

        $response->assertOk();
        $this->assertDatabaseHas('clientes', [
            'email' => $clienteFake->email
        ]);
        $this->assertDatabaseHas('cliente_plano', [
            'cliente_id' => $cliente->id,
            'plano_id' => $plano->id
        ]);
    }

    /**
     * @test
     */
    public function clienteDestroy()
    {
        Sanctum::actingAs(User::factory()->create());
        $cliente = Cliente::factory()->create();

        $response = $this->json('DELETE', route('cliente.destroy', $cliente));

        $response->assertNoContent();
        $this->assertDatabaseMissing('clientes', $cliente->getAttributes());
    }

    /**
     * @test
     */
    public function clienteDestroySaoPaulo()
    {
        Sanctum::actingAs(User::factory()->create());
        $cliente = Cliente::factory()->create(['estado' => 'São Paulo']);
        $plano= Plano::factory()->create();
        $cliente->planos()->sync($plano);
        $response = $this->json('DELETE', route('cliente.destroy', $cliente));

        $response->assertStatus(403);
    }

}
