<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentStoreRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function __construct(private readonly DocumentService $documentService)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json(DocumentResource::collection($this->documentService->paginate()));
    }

    public function store(DocumentStoreRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Documento subido correctamente.',
            'data' => DocumentResource::make(
                $this->documentService->store($request->validated(), $request->file('file'))
            ),
        ], Response::HTTP_CREATED);
    }

    public function show(Document $document): JsonResponse
    {
        return response()->json([
            'data' => DocumentResource::make($document->load('stall.vendor')),
        ]);
    }

    public function destroy(Document $document): JsonResponse
    {
        $this->documentService->destroy($document);

        return response()->json([
            'message' => 'Documento eliminado correctamente.',
        ]);
    }
}
