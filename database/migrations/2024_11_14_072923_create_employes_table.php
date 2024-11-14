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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->string('name');  // Employee's name
            $table->date('dob');  // Date of Birth
            $table->string('city');  // City
            $table->string('email')->unique();  // Unique email address
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
