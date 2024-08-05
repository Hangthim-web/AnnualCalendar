<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTaskStatus extends Model
{
    use HasFactory;
    // protected $table = "employee_task_status";
       protected $table = 'employee_task_status';

    public $timestamps = false; 

    protected $fillable = [
        'task_id', 'is_checked', 'is_pending', 'employee_id','task_description'
    ];
}
