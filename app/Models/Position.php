<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class Position extends Model {
    protected $table = "tbl_position";
    protected $connection = 'mysql';
    public $timestamps = false;
    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id','id_department');
    }
}
