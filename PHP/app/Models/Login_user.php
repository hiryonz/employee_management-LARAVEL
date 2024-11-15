<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class Login_user extends Authenticatable
{
    use HasFactory;

    /** 
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $table = 'login_user';

    protected $fillable = [
        'cedula',
        'user',
        'password',
        'remember_token',
    ];



    public static function insertLogin($request) {
        return Login_user::create([
            'cedula' => $request->cedula,
            'user' => $request->user,
            'password' => Hash::make($request->password)
        ]);
    }



    public function employee() {
        return $this->belongsTo(Employee::class, 'cedula', 'cedula');
    }






    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
