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
    Schema::table('service_details', function (Blueprint $table) {
        if (!Schema::hasColumn('service_details', 'image')) {
            $table->string('image')->nullable()->after('architect');
        }
    });
}


public function down()
{
    Schema::table('service_details', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}

};
