<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image; // Import the Image model

class ProjectDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'client',
        'size',
        'price',
        'location',
        'architect',
        'link',
        'instructor_image'
    ];

    // Define the relationship to Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Define the relationship to Images (if there are multiple images related to details)
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
