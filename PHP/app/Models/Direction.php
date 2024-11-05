<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{

    use HasFactory;

    protected $table = 'direcciones';
    protected $fillable = [
        'cedula',
        'ciudad',
        'codigo_postal',
        'provincia',
        'corregimiento',
        'distrito',
        'numero_casa',
        'descripcion',
    ];

    public function employee() 
    {
        return $this->belongsTo(Employee::class, 'cedula');
    }


}
