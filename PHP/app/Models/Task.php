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
        'decripcion', 
        'prioridad', 
        'fecha_creacion', 
        'fecha_limite', 
    ];



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
}
