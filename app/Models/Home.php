<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'title',
        'description',
        'temperature_range',
        'image_path',
    ];
}
