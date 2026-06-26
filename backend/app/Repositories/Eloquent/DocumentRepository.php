<?php

namespace App\Repositories\Eloquent;

use App\Models\Document;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Document::query()->with('stall.vendor')->latest('uploaded_at')->paginate($perPage);
    }

    public function create(array $data): Document
    {
        return Document::query()->create($data);
    }

    public function delete(Document $document): void
    {
        $document->delete();
    }
}

