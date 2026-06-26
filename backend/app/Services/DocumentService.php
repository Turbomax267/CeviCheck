<?php

namespace App\Services;

use App\Models\Document;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function __construct(private readonly DocumentRepositoryInterface $documentRepository)
    {
    }

    public function paginate(int $perPage = 15)
    {
        return $this->documentRepository->paginate($perPage);
    }

    public function store(array $data, UploadedFile $file): Document
    {
        $path = $file->store('documents', 'public');

        return $this->documentRepository->create([
            'stall_id' => $data['stall_id'],
            'document_type' => $data['document_type'],
            'file_path' => $path,
            'uploaded_at' => now(),
        ])->load('stall.vendor');
    }

    public function destroy(Document $document): void
    {
        Storage::disk('public')->delete($document->file_path);
        $this->documentRepository->delete($document);
    }
}

