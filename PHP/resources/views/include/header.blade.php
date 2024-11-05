<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{{config('app.name')}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse mt-3" id="navbarNav">
  <a class="navbar-user small-logo" href="#"><i class="fa-solid fa-user"></i></a>

    <ul class="navbar-nav mb-2">
        @auth
        <li class="nav-item active">
          <a class="nav-link" href="{{route("home")}}">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route( "viewEmployee")}}">Empleados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("addEmployee")}}">Agregar Empleados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("task")}}">Tareas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("calendar")}}">calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("logout")}}">Cerrar Session</a>
        </li> 
      @else
        <li class="nav-item">
            <a class="nav-link" href="{{route("login2")}}">Login</a>
        </li>
        
      @endauth
    </ul>
  </div>
  <a class="navbar-user big-logo" href="#"><i class="fa-solid fa-user"></i></a>
</nav>

<script>

</script>