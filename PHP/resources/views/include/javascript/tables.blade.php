<script>
    function findEmployee(id) {
        console.log(id);
        // Generar la URL con el parámetro dinámico
        window.location.href = "{{ url('viewEmployeeData') }}/" + id;
    }
</script>
