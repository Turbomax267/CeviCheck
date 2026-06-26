<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorStoreRequest;
use App\Http\Requests\Vendor\VendorUpdateRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{
    public function __construct(private readonly VendorService $vendorService)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json(VendorResource::collection($this->vendorService->publicIndex()));
    }

    public function store(VendorStoreRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Vendedor creado correctamente.',
            'data' => VendorResource::make($this->vendorService->store($request->validated())),
        ], Response::HTTP_CREATED);
    }

    public function show(Vendor $vendor): JsonResponse
    {
        return response()->json([
            'data' => VendorResource::make($this->vendorService->show($vendor)),
        ]);
    }

    public function update(VendorUpdateRequest $request, Vendor $vendor): JsonResponse
    {
        $this->authorize('modify', $vendor);

        return response()->json([
            'message' => 'Vendedor actualizado correctamente.',
            'data' => VendorResource::make($this->vendorService->update($vendor, $request->validated())),
        ]);
    }

    public function destroy(Vendor $vendor): JsonResponse
    {
        $this->authorize('modify', $vendor);
        $this->vendorService->destroy($vendor);

        return response()->json([
            'message' => 'Vendedor eliminado correctamente.',
        ]);
    }
}
