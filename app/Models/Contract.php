<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class Contract extends Model {
    protected $table = "tbl_contract_type";
    protected $connection = 'mysql';
    public $timestamps = false;
}
