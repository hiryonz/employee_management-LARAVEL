<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use HasFactory;


    const TYPE_ALTA = "alta";
    const TYPE_MEDIA = "media";
    const TYPE_BAJA = "baja";


    protected $table = "task";

    protected $fillable = [
        'cedula', 
        'descripcion', 
        'titulo',
        'prioridad', 
        'departamento',
        'estado',
        'fecha_creacion', 
        'fecha_limite', 
        'estado_db'
    ];

    public static function insertTask($request) {
        //dd($request->titulo,$request->descripcion);
        return Task::create([
            'cedula' => $request->cedula,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'departamento' => $request->departamento,
            'fecha_creacion' => $request->fecha_creacion,
            'fecha_limite' => $request->fecha_limite,
            'estado_db' => 'activo',
            'estado' => 'nuevo',
        ]);
        
    }


    public function getTypes()
    {
        return  [
            self::TYPE_ALTA,
            self::TYPE_MEDIA,
            self::TYPE_BAJA,
        ];
    }
    // Relación con Empleado
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'cedula');
    }

    public function incharge()
    {
        return $this->hasMany(InchargeTask::class, 'id_incharge', 'id');
    }
    
}
