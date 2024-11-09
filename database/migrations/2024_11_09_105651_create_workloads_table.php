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
        Schema::create('workloads', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // Client's name
            $table->string('email');      // Client's email
            $table->json('services');     // Store services as JSON
            $table->unsignedBigInteger('employee_id')->nullable();  // Reference to an employee, set to nullable
    
            // Foreign keys
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null'); // Corrected to reference 'users' table and set nullable
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workloads');
    }
};

