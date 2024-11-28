<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('client');
            $table->string('size');
            $table->decimal('price', 15, 2);
            $table->string('location');
            $table->string('architect');
            $table->string('link')->nullable();
            $table->string('instructor_image')->nullable(); // Path for the instructor image
            $table->timestamps();
        });

        // Create table to store multiple images
        Schema::create('project_detail_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_detail_id')->constrained()->onDelete('cascade');
            $table->string('image_path'); // Path for each image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_detail_images');
        Schema::dropIfExists('project_details');
    }
}