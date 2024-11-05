<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InchargeTask extends Model
{

    use HasFactory;

    protected $table = 'incharge_task'; 
    protected $primaryKey = 'id_incharge';

    protected $fillable = [
        'id_incharge',
        'cedula',
        'id',
    ];

    public function employee() 
    {
        return $this->belongsTo(Employee::class, 'cedula');
    }

    public function task()
    {
        return $this->belongsTo(Task::class,'id');
    }



}
