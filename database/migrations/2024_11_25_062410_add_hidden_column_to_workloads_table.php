<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('workloads', function (Blueprint $table) {
            $table->boolean('hidden')->default(false); // Add hidden column, default is false
        });
    }
    
    public function down()
    {
        Schema::table('workloads', function (Blueprint $table) {
            $table->dropColumn('hidden');
        });
    }
    
};
