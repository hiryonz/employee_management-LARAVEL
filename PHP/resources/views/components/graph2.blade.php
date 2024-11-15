@props(['semanaFalta', 'mesFalta', 'id'])

<div class="graph2-container">
    <div class="d-flex justify-content-center mb-5">
        <p style="padding-top: 5px"><Strong><?php echo date('Y-m-d'); ?></Strong></p>
        <button class="btn btn-light ml-3 btnEmployee" id="month" disabled>Meses</button>
        <button class="btn btn-light ml-1 btnEmployee" id="day">Semana</button>

    </div>
    <canvas id="myChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('myChart');

    const months_{{$id}} = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    const monthData_{{$id}} = <?php echo json_encode(array_column($mesFalta, 'totalFaltasMes')) ?>;


    const days_{{$id}} = <?php echo json_encode(array_column($semanaFalta, 'nombreDia')); ?>;
    const dayData_{{$id}} = <?php echo json_encode(array_column($semanaFalta, 'totalFaltasDia')); ?>;

console.log(days_{{$id}})
console.log(dayData_{{$id}})


const monthBtn = document.getElementById('month');
const dayBtn = document.getElementById('day');

function toggleButtons() {
    if (monthBtn.disabled) {
        monthBtn.disabled = false;
        dayBtn.disabled = true;
        changeChart('day')
    } else {
        monthBtn.disabled = true;
        dayBtn.disabled = false;
        changeChart('month')
    }
}

const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months_{{$id}},
        datasets: [{
            label: 'Falta',
            data: monthData_{{$id}},
            borderWidth: 1,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)'
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
function changeChart(type) {

    console.log(type)
    if (type === 'day') {
        // Cambia a datos de días
        chart.data.labels = days_{{$id}};
        chart.data.datasets[0].data = dayData_{{$id}};
        chart.data.datasets[0].label = 'Datos por día';
        this.textContent = 'Cambiar a meses';
    } else {
        // Cambia a datos de meses
        chart.data.labels = months_{{$id}};
        chart.data.datasets[0].data = monthData_{{$id}};
        chart.data.datasets[0].label = 'Datos por mes';
        this.textContent = 'Cambiar a días';
    }
    chart.update();
    
}

monthBtn.addEventListener('click', toggleButtons);
dayBtn.addEventListener('click', toggleButtons);


</script>
