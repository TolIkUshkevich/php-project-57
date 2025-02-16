<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asigned_to_tasks', function (Blueprint $table) {
            $table->foreignId('task_id')->constrainted()->cascadeOnDelete();
            $table->foreignId('assigned_to_id')->constrainted('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asigned_to_tasks');
    }
};
