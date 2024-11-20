<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'description',
        'client',
        'location',
        'year_completed',
        'surface_area',
        'value',
        'architect',
        'image',
    ];

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
