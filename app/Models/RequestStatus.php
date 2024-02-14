<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class RequestStatus extends Model {
    protected $table = "tbl_request_status";
    protected $connection = 'mysql';
    public $timestamps = false;
}
