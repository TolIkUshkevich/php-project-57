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
            $table->text('description');
            $table->foreignId('status_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by_id')->constrainted('users')->cascadeOnDelete();
            $table->foreignId('assigned_to_id')->constrainted('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    //
    {
    }
};
