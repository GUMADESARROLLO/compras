<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Http\Request;

class Roles extends Model {
    protected $table = "rol";
    protected $connection = 'mysql';

    public function users()
    {
        return $this->hasMany(Usuario::class, 'id','role_id');
    }

    public static function getRoles()
    {
        return Roles::where('active',1)->get();
    }
}
