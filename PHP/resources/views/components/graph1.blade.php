@props(['labels', 'data', 'id'])

<div class="graph1-container">
    @if ($data)
    <div class="d-flex justify-content-center">
        <p><Strong><?php echo date('Y-m-d'); ?></Strong></p>
    </div>
        <canvas class="myChart" id="myChart_{{$id}}"></canvas>
    @else
        <p>No data available</p>
    @endif
</div>


<script>
const ctx_{{$id}} = document.getElementById('myChart_{{$id}}');

// Datos para la gráfica desde PHP
var labels_{{ $id }} = {!! json_encode($labels) !!};
var data_{{ $id }} = {!! json_encode($data) !!};
var id = '{{$id}}'
console.log(data_{{ $id }})
if (id === 'task') {
    // Mapear los datos dinámicamente según los estados en labels_{{ $id }}
    var data_{{ $id }} = labels_{{ $id }}.map(label => {
        // Filtrar los elementos que coinciden con el estado actual (label)
        const filteredData = data_{{ $id }}.filter(item => item.estado === label);

        return filteredData.length || 0;
    });

    console.log(data_{{ $id }}); // Verifica el resultado
}
console.log(labels_{{ $id }})

const Colors_{{ $id }} = [
    'rgb(180, 210, 240)', // Azul cielo claro
    'rgb(190, 220, 200)', // Verde menta suave
    'rgb(220, 220, 220)', // Gris claro
    'rgb(230, 210, 190)', // Arena clara
    'rgb(200, 200, 230)', // Lavanda suave
    'rgb(210, 190, 200)', // Rosa tenue
];

    new Chart(ctx_{{$id}}, {
        type: 'pie',
        data: {
        labels: labels_{{ $id }},
        datasets: [{
            label: 'Horas Faltas',
            data: data_{{ $id }},
            backgroundColor: Colors_{{ $id }},
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

</script>