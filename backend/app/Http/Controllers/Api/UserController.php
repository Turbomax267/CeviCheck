<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json(UserResource::collection($this->userService->paginate()));
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'data' => UserResource::make($this->userService->store($request->validated())),
        ], Response::HTTP_CREATED);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => UserResource::make($user->load('vendor')),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        return response()->json([
            'message' => 'Usuario actualizado correctamente.',
            'data' => UserResource::make($this->userService->update($user, $request->validated())),
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->destroy($user);

        return response()->json([
            'message' => 'Usuario eliminado correctamente.',
        ]);
    }
}
