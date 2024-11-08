<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescuentoFalta extends Model
{

    use HasFactory;


    protected $table = 'descuentosfaltas';

    protected $fillable = [
        'cedula',
        'fecha',
        'descuento_falta',
        'horas_falta'
    ];


    private function employee() {
        return $this->belongsTo(Employee::class, 'cedula');
    }

}
