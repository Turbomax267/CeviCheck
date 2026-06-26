<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\License\LicenseStoreRequest;
use App\Http\Requests\License\LicenseUpdateRequest;
use App\Http\Resources\LicenseResource;
use App\Models\License;
use App\Services\LicenseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LicenseController extends Controller
{
    public function __construct(private readonly LicenseService $licenseService)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json(LicenseResource::collection($this->licenseService->paginate()));
    }

    public function store(LicenseStoreRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Licencia registrada correctamente.',
            'data' => LicenseResource::make($this->licenseService->store($request->validated())),
        ], Response::HTTP_CREATED);
    }

    public function show(License $license): JsonResponse
    {
        return response()->json([
            'data' => LicenseResource::make($license->load('stall.vendor')),
        ]);
    }

    public function update(LicenseUpdateRequest $request, License $license): JsonResponse
    {
        return response()->json([
            'message' => 'Licencia actualizada correctamente.',
            'data' => LicenseResource::make($this->licenseService->update($license, $request->validated())),
        ]);
    }

    public function destroy(License $license): JsonResponse
    {
        $this->licenseService->destroy($license);

        return response()->json([
            'message' => 'Licencia eliminada correctamente.',
        ]);
    }
}
