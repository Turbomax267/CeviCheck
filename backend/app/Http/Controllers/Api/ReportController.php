<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportStoreRequest;
use App\Http\Requests\Report\ReportUpdateRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function __construct(private readonly ReportService $reportService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json(ReportResource::collection($this->reportService->paginate($request->user())));
    }

    public function store(ReportStoreRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Reporte registrado correctamente.',
            'data' => ReportResource::make($this->reportService->store($request->user(), $request->validated())),
        ], Response::HTTP_CREATED);
    }

    public function show(Report $report): JsonResponse
    {
        $this->authorize('view', $report);

        return response()->json([
            'data' => ReportResource::make($report->load(['citizen', 'stall.vendor'])),
        ]);
    }

    public function update(ReportUpdateRequest $request, Report $report): JsonResponse
    {
        return response()->json([
            'message' => 'Reporte actualizado correctamente.',
            'data' => ReportResource::make($this->reportService->update($report, $request->validated())),
        ]);
    }

    public function destroy(Report $report): JsonResponse
    {
        $this->authorize('view', $report);
        $this->reportService->destroy($report);

        return response()->json([
            'message' => 'Reporte eliminado correctamente.',
        ]);
    }
}
