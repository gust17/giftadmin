<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';

    protected $table = 'contratos';

    protected $primaryKey = 'id';

    protected $fillable = [
      'parceira_id',
      'plano_id'
    ];

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
}
