<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saque extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $connection = 'mysql3';
    protected $table = 'saques';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];



    protected $fillable = ['contrato_id','status'];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function userLoja()
    {
        return $this->belongsTo(UserLoja::class, 'user_id', 'id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }

    public function parceira()
    {
        return $this->belongsTo(Parceira::class, 'parceira_id', 'id');
    }

    public function dataLimite()
    {

        return $this->created_at->addDays($this->contrato->plano->dias)->format('d/m/Y');

    }

    public function valorSaque()
    {
        return $this->valor - ($this->valor * ($this->contrato->plano->taxa/100));

    }

    public function statusFormat()
    {
        if ($this->attributes['status'] == 0) {
            return 'Pendente';
        }
        return 'Efetivado';
    }



//    public function contratoAtual()
//    {
//        return $this->contrato->plano->name;
//    }
//
//    public function contratoAtualTaxa()
//    {
//        return $this->contratos()->latest('created_at')->first()->plano->taxa;
//    }
//
//    public function contratoAtualDia()
//    {
//        return $this->contratos()->latest('created_at')->first()->plano->dia;
//    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
