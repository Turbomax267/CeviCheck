<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inspection\InspectionStoreRequest;
use App\Http\Requests\Inspection\InspectionUpdateRequest;
use App\Http\Resources\InspectionResource;
use App\Models\Inspection;
use App\Services\InspectionService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InspectionController extends Controller
{
    public function __construct(private readonly InspectionService $inspectionService)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json(InspectionResource::collection($this->inspectionService->paginate()));
    }

    public function store(InspectionStoreRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Inspección registrada correctamente.',
            'data' => InspectionResource::make($this->inspectionService->store($request->validated())),
        ], Response::HTTP_CREATED);
    }

    public function show(Inspection $inspection): JsonResponse
    {
        return response()->json([
            'data' => InspectionResource::make($inspection->load(['stall.vendor', 'inspector'])),
        ]);
    }

    public function update(InspectionUpdateRequest $request, Inspection $inspection): JsonResponse
    {
        return response()->json([
            'message' => 'Inspección actualizada correctamente.',
            'data' => InspectionResource::make($this->inspectionService->update($inspection, $request->validated())),
        ]);
    }

    public function destroy(Inspection $inspection): JsonResponse
    {
        $this->inspectionService->destroy($inspection);

        return response()->json([
            'message' => 'Inspección eliminada correctamente.',
        ]);
    }
}
