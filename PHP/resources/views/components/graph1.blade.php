@props(['labels', 'dataDescuento'])

<div>
    <div class="d-flex justify-content-center">
        <p><Strong><?php echo date('Y-m-d'); ?></Strong></p>
    </div>
    <canvas id="myChart"></canvas>
</div>


<script>
const ctx = document.getElementById('myChart');

// Datos para la gráfica desde PHP
var labels = {!! json_encode($labels) !!};
var data = {!! json_encode($dataDescuento) !!};


new Chart(ctx, {
    type: 'pie',
    data: {
    labels: labels,
    datasets: [{
        label: 'Horas Faltas',
        data: data,
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