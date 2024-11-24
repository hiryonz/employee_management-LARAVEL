
<div class="container-error ms-auto me-auto">
    <!-- Errores de Validación -->
    @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>¡Ostia, un error!</strong> {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Mensaje Específico de Error -->
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Ostia, un error muy malo!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Mensaje de Éxito -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Se logró!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Mensaje Genérico de Error -->
    @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Ostia, un error!</strong> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>


<script>
    $(document).ready(function() {
        // Oculta automáticamente las alertas después de 10 segundos
        setTimeout(function() {
            $(".alert").alert('close');
        }, 30000);
    });


    document.addEventListener('click', function (e) {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.display = 'none'; // Oculta las alertas
        });
    });


</script>