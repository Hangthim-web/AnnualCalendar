<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualCalendar extends Model
{
    use HasFactory;
    protected $table = "annual_calendars";
    public $primaryKey = "id";
    
    }
