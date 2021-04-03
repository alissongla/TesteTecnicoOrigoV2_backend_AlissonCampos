<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * Realização dos testes de autenticação.
     *
     * @return void
     */
    public function testApiLogin() {
        $body = [
            'email' => env('APP_TEST_EMAIL'),
            'password' => env('APP_TEST_PASSWORD'),
        ];
        $response = $this->json('POST', route('login'), $body);
        $response->assertOk();
    }
}
