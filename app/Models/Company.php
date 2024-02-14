<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class Company extends Model {
    protected $table = "tbl_company";
    protected $connection = 'mysql';
    public $timestamps = false;
}
