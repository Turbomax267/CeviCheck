<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodStall\FoodStallStoreRequest;
use App\Http\Requests\FoodStall\FoodStallUpdateRequest;
use App\Http\Resources\FoodStallResource;
use App\Models\FoodStall;
use App\Models\User;
use App\Services\FoodStallService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FoodStallController extends Controller
{
    public function __construct(private readonly FoodStallService $foodStallService)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json(FoodStallResource::collection($this->foodStallService->paginate()));
    }

    public function store(FoodStallStoreRequest $request): JsonResponse
    {
        $payload = $request->validated();

        if ($request->user()?->role === User::ROLE_VENDOR && $request->user()?->vendor) {
            $payload['vendor_id'] = $request->user()->vendor->id;
        }

        return response()->json([
            'message' => 'Puesto registrado correctamente.',
            'data' => FoodStallResource::make($this->foodStallService->store($payload)),
        ], Response::HTTP_CREATED);
    }

    public function show(FoodStall $foodStall): JsonResponse
    {
        return response()->json([
            'data' => FoodStallResource::make($this->foodStallService->show($foodStall)),
        ]);
    }

    public function update(FoodStallUpdateRequest $request, FoodStall $foodStall): JsonResponse
    {
        $this->authorize('modify', $foodStall);

        return response()->json([
            'message' => 'Puesto actualizado correctamente.',
            'data' => FoodStallResource::make($this->foodStallService->update($foodStall, $request->validated())),
        ]);
    }

    public function destroy(FoodStall $foodStall): JsonResponse
    {
        $this->authorize('modify', $foodStall);
        $this->foodStallService->destroy($foodStall);

        return response()->json([
            'message' => 'Puesto eliminado correctamente.',
        ]);
    }
}
