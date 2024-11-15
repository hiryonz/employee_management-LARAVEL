@props(['labels', 'dataDescuento', 'id'])

<div class="graph1-container">
    <div class="d-flex justify-content-center">
        <p><Strong><?php echo date('Y-m-d'); ?></Strong></p>
    </div>
    <canvas id="myChart"></canvas>
</div>


<script>
const ctx = document.getElementById('myChart');

// Datos para la gráfica desde PHP
var labels_{{ $id }} = {!! json_encode($labels) !!};
var data_{{ $id }} = {!! json_encode($dataDescuento) !!};

console.log
new Chart(ctx, {
    type: 'pie',
    data: {
    labels: labels_{{ $id }},
    datasets: [{
        label: 'Horas Faltas',
        data: data_{{ $id }},
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