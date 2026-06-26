<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodStall extends Model
{
    use HasFactory;

    public const SANITARY_APTO = 'apto';
    public const SANITARY_PENDIENTE = 'pendiente';
    public const SANITARY_NO_APTO = 'no_apto';
    public const LICENSE_VIGENTE = 'vigente';
    public const LICENSE_VENCIDA = 'vencida';
    public const LICENSE_SUSPENDIDA = 'suspendida';
    public const LICENSE_SIN_LICENCIA = 'sin_licencia';

    protected $fillable = [
        'vendor_id',
        'stall_name',
        'district',
        'address',
        'license_status',
        'sanitary_status',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class, 'stall_id');
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'stall_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'stall_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'stall_id');
    }
}

