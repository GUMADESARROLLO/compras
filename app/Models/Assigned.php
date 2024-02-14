<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class Assigned extends Model {
    protected $table = "tbl_employee_assigned";
    protected $connection = 'mysql';
    public $timestamps = false;
}
