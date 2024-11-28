<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_detail_id', // Assuming each image is linked to a ProjectDetail
        'path' // Assuming there's a column for the image path
    ];

    // Define the relationship to ProjectDetail
    public function projectDetail()
    {
        return $this->belongsTo(ProjectDetail::class);
    }
}
