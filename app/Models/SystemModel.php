<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemModel extends Model
{
    use HasFactory;
    protected $table = 'ci_erp_settings';

    protected $primaryKey = 'setting_id';

}
