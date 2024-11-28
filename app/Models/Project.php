<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    // Allow mass assignment for the fields
    protected $fillable = ['title', 'description', 'image'];

    /**
     * Get the detail associated with the project.
     *
     * This sets up a one-to-one relationship between Project and ProjectDetail.
     */
    public function detail()
    {
        return $this->hasOne(ProjectDetail::class);
    }
}
