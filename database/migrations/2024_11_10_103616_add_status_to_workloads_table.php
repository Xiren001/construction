<?php

// database/migrations/xxxx_xx_xx_add_status_to_workloads_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('workloads', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Canceled'])->default('Pending');
        });
    }

    public function down() {
        Schema::table('workloads', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

