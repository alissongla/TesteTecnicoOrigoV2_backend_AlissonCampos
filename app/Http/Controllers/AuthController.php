<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    {
        $loginValidate = $request->validated();

        if (!Auth::attempt($loginValidate)) {
            return $this->error('Acesso não autorizado', 401);
        }

        return $this->success(
            ['token' => auth()->user()->createToken('API Token')->plainTextToken],
        'Login realizado com sucesso'
        );
    }

    public function register(RegisterRequest $request)
    {
        $registerValidate = $request->validated();

        $user = User::create([
            'name' => $registerValidate['name'],
            'password' => Hash::make($registerValidate['password']),
            'email' => $registerValidate['email']
        ]);

        return $this->success(
            ['token' => $user->createToken('API Token')->plainTextToken],
        'Usuário criado com sucesso');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout realizado com sucesso'
        ];
    }


}
