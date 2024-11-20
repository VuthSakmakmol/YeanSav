<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('description');
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->date('year_completed')->nullable();
            $table->decimal('surface_area', 10, 2)->nullable();
            $table->decimal('value', 15, 2)->nullable();
            $table->string('architect')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_details');
    }
}
