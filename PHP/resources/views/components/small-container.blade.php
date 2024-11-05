@props(['name', 'logo', 'countPersonal', 'totalPersonal', 'reportes', 'anuncios', 'class'])


<div class="general-info  {{$class}}">
    <div class="container-logo">
        {!!$logo!!}
    </div>
    <div class="container-info">
        <div class="small-value">
            @switch($name)
                @case('Empleados Presentes')
                    <p>{{$countPersonal}}/{{$totalPersonal}}</p>
                    @break

                @case('Reportes')
                    <p>{{$reportes}}</p>
                    @break

                @case('Anuncios')
                    <p>{{$anuncios}}</p>
                    @break

                @default
                    <p>dato desconocido.</p>
            @endswitch
            
        </div>
        <div class="small-info">
            {{$name}}
        </div>
    </div>
</div>