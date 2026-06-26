<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pendiente';
    public const STATUS_IN_PROGRESS = 'en_proceso';
    public const STATUS_RESOLVED = 'resuelto';
    public const STATUS_REJECTED = 'rechazado';

    protected $fillable = [
        'citizen_id',
        'stall_id',
        'description',
        'status',
    ];

    public function citizen()
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function stall()
    {
        return $this->belongsTo(FoodStall::class, 'stall_id');
    }
}

