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
        'descuentos'
    ];

    public static function insertPlanilla($request) {
        return Planilla::create([
            'cedula' => $request->cedula,
            'hora_trabajada'  => $request->hora_trabajada,
            'salario_h' => $request->sal_hora,
            'descuentos' => $request->descuento,
            'seguro_social' => $request->seguro_social,
            'seguro_educativo' => $request->seguro_educativo,
            'impuesto_renta' => $request->ir,
            'deducciones' => $request->deducciones,
            'salario_bruto' => $request->salario_bruto,
            'salario_neto' => $request->salario_neto
        ]);
    }

    public function  employee() {
        return $this->belongsTo(Employee::class, 'cedula');
    }

}
