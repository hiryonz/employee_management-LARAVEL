<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{

    use HasFactory;

    protected $table = 'turno';


    protected $fillable = [
        'entrada',
        'salida',
    ];

    public function entradaSalida() 
    {
        return $this->hasMany(EntradaSalida::class, 'id_turno', 'id');
    } 

}
