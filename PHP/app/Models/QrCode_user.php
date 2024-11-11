<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode_user extends Model
{

    use HasFactory;

    protected $table = 'QR_code';

    protected $fillable = [
        'id',
        'cedula',
        'authcode',
        'qr_code',
    ];

    public function  employee() {
        return $this->belongsTo(Employee::class, 'cedula');
    }
}
