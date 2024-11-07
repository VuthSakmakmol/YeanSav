<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Define the table if it's not `pages`
    protected $table = 'pages';

    // Define fillable fields if necessary
    protected $fillable = ['title', 'description', 'content', 'color', 'font', 'image_path'];
}
