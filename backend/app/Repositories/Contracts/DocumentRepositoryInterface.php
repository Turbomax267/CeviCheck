<?php

namespace App\Repositories\Contracts;

use App\Models\Document;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DocumentRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): Document;

    public function delete(Document $document): void;
}

