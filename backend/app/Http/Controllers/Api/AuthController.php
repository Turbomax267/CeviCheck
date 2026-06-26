<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $payload = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'Usuario registrado correctamente.',
            'user' => UserResource::make($payload['user']),
            'token' => $payload['token'],
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $payload = $this->authService->login($request->validated());

        return response()->json([
            'message' => 'Inicio de sesión exitoso.',
            'user' => UserResource::make($payload['user']),
            'token' => $payload['token'],
        ]);
    }

    public function me(): JsonResponse
    {
        return response()->json([
            'user' => UserResource::make(auth('api')->user()->load('vendor')),
        ]);
    }

    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ]);
    }

    public function refresh(): JsonResponse
    {
        return response()->json([
            'token' => auth('api')->refresh(),
        ]);
    }
}

