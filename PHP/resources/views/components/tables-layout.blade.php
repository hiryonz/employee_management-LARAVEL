@props(['name', 'task', 'employee', 'employeeData', 'directionData', 'descuentoFalta', 'path'])

<?php
    // Determina qué conjunto de datos usar basado en el valor de $name
    $combinedData = match($name) {
        'employee' => $employee,
        'directionData' => $directionData,
        'employeeData' => $employeeData,
        'task' => $task,
        'descuento' => $descuentoFalta,
        default => [],  // Devuelve un array vacío si no hay coincidencia
    };

?>
<table class="table" >
    <thead>
        <tr>
            @if (is_array($combinedData) && count($combinedData) > 0) 
                @foreach (array_keys($combinedData[0]) as $column)
                    <th>{{ ucfirst($column) }}</th>
                @endforeach
            @else
                <th>No hay datos disponibles</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if (is_array($combinedData) && count($combinedData) > 0)
            @foreach ($combinedData as $row)
            
                <tr class="tables-row" 
                @if (!isset($path))
                    @if ($name == 'employee')
                        onclick="findEmployee({{$row['cedula'] ?? ''}})" 
                    @elseif ($name == 'task')
                        onclick="window.location.href = '{{ url('task') }}'"
                    @endif
                @endif 
                >
                    @foreach ($row as $data)
                        <td>
                            @if ($data == '00:00:00')
                                N/A
                            @else
                                {{ $data  }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="100%">No hay datos que mostrar.</td>
            </tr>
        @endif
    </tbody>
</table>