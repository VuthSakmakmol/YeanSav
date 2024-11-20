<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'temperature_range',
        'description',
    ];

    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}
