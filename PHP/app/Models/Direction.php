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


    public static function insertDirection($request) {
        return Direction::create([
            'cedula' => $request->cedula,
            'ciudad' => $request->ciudad,
            'codigo_postal' => $request->codigo_postal,
            'provincia' => $request->provincia,
            'corregimiento' => $request->corregimiento,
            'distrito' => $request->distrito,
            'numero_casa' => $request->numero_casa,
            'descripcion' => $request->descripcion
        ]);
    }

    public function employee() 
    {
        return $this->belongsTo(Employee::class, 'cedula');
    }


}
