<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class Department extends Model {
    protected $table = "tbl_department";
    protected $connection = 'mysql';
    public $timestamps = false;
    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_id','id_compy');
    }

    public function employees()
    {
        return $this->hasManyThrough(
            Employee::class,
            Position::class,
            'department_id',
            'position_id',
            'id_department',
            'id_position'
        )->where('tbl_employee.active', 1);
    }
    public function sumVacationBalance()
    {
        return $this->employees()->sum('vacation_balance');
    }
}
