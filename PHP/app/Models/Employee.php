<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    const TYPE_ADMIN = 'admin';
    const TYPE_EMPLEADO = 'empleado';    
    
    protected $table = "Employee";

    protected $primaryKey = 'cedula';  // Usamos cedula como PK
    public $incrementing = false;
    protected $keyType = 'string';  // Ya que la cédula es un string
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cedula', 
        'nombre', 
        'apellido',
        'genero',
        'edad', 
        'nacimiento', 
        'tipo',
        'email',
        'telefono',
        'departamento',
        'id_turno',
        'profile_image',
        'image_mime',
    ];

        public static function getTypes()
        {
            return [
                self::TYPE_ADMIN,
                self::TYPE_EMPLEADO,
            ];
        }


        // Relación con Direccion
        public function direcciones()
        {
            return $this->hasOne(Direction::class, 'cedula', 'cedula');
        }


        public function entradaSalida() 
        {
            return $this->hasMany(Direction::class,'cedula', 'cedula');
        }
    
        // Relación con Planilla
        public function planillas()
        {
            return $this->hasOne(Planilla::class, 'cedula', 'cedula');
        }
    
        // Relación con Task
        public function tasks()
        {
            return $this->hasMany(Task::class, 'cedula', 'cedula');
        }

        //RElacion con login

        public function login() 
        {
            return $this->hasOne(Login_user::class, 'cedula', 'cedula');
        }

  

}
