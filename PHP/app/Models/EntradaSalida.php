<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaSalida extends Model
{

    use HasFactory;

    protected $table  = 'entrada_salida';

    protected $fillable = [
        'cedula',
        'fecha',
        'horaEntrada',
        'horaSalida',
    ];


    public function turno() 
    {
        return $this->belongsTo(Turno::class,  'id_turno', 'id');

    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'cedula');
    }


}
