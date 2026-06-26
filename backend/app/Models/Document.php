<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'stall_id',
        'document_type',
        'file_path',
        'uploaded_at',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
        ];
    }

    public function stall()
    {
        return $this->belongsTo(FoodStall::class, 'stall_id');
    }
}

