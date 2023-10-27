<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presente extends Model
{
    use CrudTrait;
    use HasFactory;


    protected $connection = 'mysql2';


    protected $table = 'presentes';


    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo(UserCliente::class,'user_id','id');
    }
}
