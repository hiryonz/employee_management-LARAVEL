<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{

    use HasFactory;

    protected $table = 'planillas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cedula', 
        'hora_trabajada',
        'salario_h', 
        'salario_bruto',
        'salario_neto',
        'seguro_social',
        'seguro_educativo',
        'impuesto_renta', 
        'descuentos', 
        'descuentos_faltas', 
        'horas_falta'
    ];


    public function  employee() {
        return $this->belongsTo(Employee::class, 'cedula');
    }

}
