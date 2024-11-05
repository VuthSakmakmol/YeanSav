<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
       // Create the `pages` table
       Schema::create('pages', function (Blueprint $table) {
           $table->id();
           $table->string('title');
           $table->text('content');
           $table->string('color')->nullable();
           $table->string('font')->nullable();
           $table->string('image_path')->nullable();
           $table->text('description')->nullable();
           $table->timestamps();
       });

       // Add `is_admin` column to the `users` table
       Schema::table('users', function (Blueprint $table) {
           $table->boolean('is_admin')->default(false);
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the `pages` table
        Schema::dropIfExists('pages');

        // Remove `is_admin` column from `users` table
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_admin')) {
                $table->dropColumn('is_admin');
            }
        });
    }
};
