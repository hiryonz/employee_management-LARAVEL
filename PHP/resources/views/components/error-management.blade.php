
<div class="mt-1 mb-2">
    @if ($errors -> any())
        <div class="col-12">
            @foreach ($errors->all() as $error )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ostia, un error!</strong> {{$error}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
        </div>
    @endif

    @if (session()->has("error"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ostia, un error muy malo!</strong> {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Se logro!</strong> {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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



</script>