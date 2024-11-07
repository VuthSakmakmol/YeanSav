<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('temperature_range')->nullable();
            $table->string('image_path')->nullable(); // Store image paths
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('homes');
    }
}
