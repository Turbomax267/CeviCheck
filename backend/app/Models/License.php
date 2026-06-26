<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'stall_id',
        'license_number',
        'issue_date',
        'expiration_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiration_date' => 'date',
        ];
    }

    public function stall()
    {
        return $this->belongsTo(FoodStall::class, 'stall_id');
    }
}

