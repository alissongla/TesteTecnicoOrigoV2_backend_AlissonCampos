<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ClienteResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Post(
     *     tags={"/auth/login"},
     *     summary="Realiza o login",
     *     description="Realiza a verificação de login",
     *     path="/auth/login",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *         )
     *      ),
     *     @OA\Response(
     *          response="201", description="Login feito com sucesso"
     *     )
     * )
     *
     */
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

    /**
     * @OA\Post(
     *     tags={"/auth/register"},
     *     summary="Adiciona um usuário",
     *     description="Adiciona um usuário",
     *     path="/auth/register",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="nome", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *         )
     *      ),
     *     @OA\Response(
     *          response="201", description="Novo usuário adicionado"
     *     )
     * )
     *
     * @param  RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @OA\Delete(
     *     tags={"/auth/logout"},
     *     summary="Exclui um cliente",
     *     description="Exclui as informações de um cliente",
     *     path="/auth/logout/user",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          description="user_id",
     *          in="path",
     *          name="user",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          )
     *     ),
     *     @OA\Response(
     *          response="204", description="Logout realizado com sucesso"
     *     )
     * )
     *
     *
     * @return string[]
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout realizado com sucesso'
        ];
    }


}
