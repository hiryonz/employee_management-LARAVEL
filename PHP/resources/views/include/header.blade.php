<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{{config('app.name')}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse mt-3" id="navbarNav">
    <ul class="navbar-nav mb-2">
        @auth
        <li class="nav-item active">
          <?php   
            if (auth()->user()->employee->tipo == 'admin') {
                $path = 'home';
            }else {
                $path = 'homeEmployee';
            }
              
          ?>
          <a class="nav-link" href="{{route($path)}}">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li><a class="nav-link" href="{{route("viewEmployeeData", auth()->user()->employee->cedula ?? 'login2')}}">Perfil</a></li>

        @if (auth()->user()->employee->tipo === "admin")
          <li class="nav-item">
              <a class="nav-link" href="{{route( "viewEmployee")}}">Empleados</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route("addEmployee")}}">Agregar Empleados</a>
          </li>
        @endif
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

  <a class="navbar-user big-logo" href="#" id="userIcon">
    @if ($employeeData->profile_image ?? '' && File::exists(public_path($employeeData->profile_image ?? '')))
        <img class="card-img-top img" src="{{ asset($employeeData->profile_image) }}" alt="Card image cap" class="profile-image img">
        @else
        <i class="fa-solid fa-user"></i>    
    @endif
    
  </a>
  @include('include.modals.modal-userProfile')
</nav>

<script>

</script>