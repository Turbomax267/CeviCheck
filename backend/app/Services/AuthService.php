<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\VendorRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly VendorRepositoryInterface $vendorRepository,
    ) {
    }

    public function register(array $data): array
    {
        return DB::transaction(function () use ($data): array {
            $user = $this->userRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role'],
            ]);

            if ($user->role === User::ROLE_VENDOR) {
                $this->vendorRepository->create([
                    'user_id' => $user->id,
                    'dni' => $data['dni'],
                    'full_name' => $data['name'],
                    'phone' => $data['phone'],
                ]);
            }

            $token = JWTAuth::fromUser($user);

            return [
                'user' => $user->load('vendor'),
                'token' => $token,
            ];
        });
    }

    public function login(array $credentials): array
    {
        if (! $token = auth('api')->attempt($credentials)) {
            throw new AuthenticationException('Credenciales inválidas.');
        }

        return [
            'user' => auth('api')->user()->load('vendor'),
            'token' => $token,
        ];
    }
}

