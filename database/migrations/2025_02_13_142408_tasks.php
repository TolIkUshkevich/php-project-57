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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->foreignId('created_by_id')->nullable()->constrained(table: 'users');
            $table->foreignId('assigned_to_id')->nullable()->constrained(table: 'users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    //
    {
        Schema::dropIfExists('task');
    }
};
