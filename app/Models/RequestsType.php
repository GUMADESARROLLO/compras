<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class RequestsType extends Model {
    protected $table = "tbl_request_type";
    protected $connection = 'mysql';
    public $timestamps = false;
}
