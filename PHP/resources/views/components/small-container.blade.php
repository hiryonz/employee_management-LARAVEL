@props(['name', 'info', 'logo', 'first', 'second', 'third', 'class', 'path'])


<div class="general-info  {{$class}}">
    <div class="container-logo">
        {!!$logo!!}
    </div>
    <div class="container-info">
        <div class="small-value">
            @switch($info)
                @case('1')
                    <!-- first type of container -->
                    <p>{{ $first }}{{ isset($second) ? "/$second" : '' }}</p>
                @break

                @case('2')
                    <!-- second type of container -->
                    <p>{{$third}}</p>
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

@if (isset($path))
<script>
    let {{$class}} = document.querySelector('.{{$class}}')
    {{$class}}.addEventListener('click', () => {
        window.location.href = "{{url($path ?? '')}}"
    })

</script>
@endif