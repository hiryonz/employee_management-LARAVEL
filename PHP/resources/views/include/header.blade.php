
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
          <li class="nav-item"><a class="nav-link" href="{{route("viewEmployeeData", auth()->user()->employee->cedula ?? 'login2')}}">Perfil</a></li>

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
    <a class="navbar-user big-logo"  id="userIcon">
      @if ($employeeData->profile_image ?? '' && File::exists(public_path($employeeData->profile_image ?? '')))
          <img class="card-img-top img" src="{{ asset($employeeData->profile_image) }}" alt="Card image cap" class="profile-image img">
          @else
          <i class="fa-solid fa-user"></i>    
      @endif
      
    </a>
    @include('include.modals.modal-userProfile')
  </div>
</nav>