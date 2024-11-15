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
       Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');  // Foreign key to employees table (corrected column name to employee_id)
            $table->date('attendance_date');  // Date of attendance
            $table->enum('status', ['present', 'absent', 'late', 'on_leave']);  // Attendance status
            $table->time('check_in_time')->nullable();  // Check-in time (nullable because it may not be available at creation)
            $table->time('check_out_time')->nullable();  // Check-out time (nullable because it may not be available at creation)
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
