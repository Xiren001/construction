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
        Schema::create('completed_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workload_id');
            $table->string('workload_name');
            $table->string('employee_name')->nullable();
            $table->json('checklist');
            $table->string('photo');
            $table->timestamps();

            $table->foreign('workload_id')->references('id')->on('workloads')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_works');
    }
};
