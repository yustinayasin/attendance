<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    // Define the table if it's different from the default 'leave_requests'
    protected $table = 'leave_requests';

    // Set the attributes that should be mass assignable
    protected $fillable = [
        'employee_id',   // Foreign key to the Employee table
        'start_date',
        'end_date',
        'reason',        // Reason for leave
        'status',        // Pending, Approved, Rejected
    ];

    // Define the relationship with the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class); // A leave request belongs to an employee
    }
}
