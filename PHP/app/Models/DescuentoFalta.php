<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getDescuentoFaltaMensual($cedula, $year) {
        return $mesFalta = DescuentoFalta::select(
            DB::raw('SUM(horas_faltas) as totalFaltasMes'), 
            DB::raw('MONTH(fecha) as mes')
        )
        ->whereYear('fecha', $year)
        ->where('cedula', $cedula)
        ->groupBy(DB::raw('MONTH(fecha)'))
        ->orderBy('mes')
        ->get()
        ->toArray();
    }

    public static function getDescuentoFaltaSemanal($cedula) {
        DB::statement("SET lc_time_names = 'es_ES'");
        $fechaActual = Carbon::today();
        $fechaInicio = $fechaActual->copy()->subDays(3); // Tres días antes
        $fechaFin = $fechaActual->copy()->addDays(3);    // Tres días después
        
        return $semanaFalta = DescuentoFalta::select(
            DB::raw('SUM(horas_faltas) as totalFaltasDia'), 
            DB::raw('DAY(fecha) as dia'),
            DB::raw('DATE_FORMAT(fecha, "%W") as nombreDia')
        )
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->where('cedula', $cedula)
        ->groupBy('fecha'   )
        ->orderBy('fecha')
        ->get()
        ->toArray();
    }

    private function employee() {
        return $this->belongsTo(Employee::class, 'cedula');
    }

}
