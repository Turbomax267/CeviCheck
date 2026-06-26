<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dni',
        'full_name',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodStalls()
    {
        return $this->hasMany(FoodStall::class);
    }
}

