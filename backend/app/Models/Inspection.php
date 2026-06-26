<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'stall_id',
        'inspection_date',
        'observations',
        'sanitary_status',
        'inspected_by',
    ];

    protected function casts(): array
    {
        return [
            'inspection_date' => 'date',
        ];
    }

    public function stall()
    {
        return $this->belongsTo(FoodStall::class, 'stall_id');
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }
}

