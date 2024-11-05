<form action="{{ route($route) }}" method="POST">
    @csrf
    <h4><strong>Informacion personal</strong></h4>
    <hr>
    <div class="row md-3">
        <div class="col">
            <label for="cedula">Ingrese cedula</label>
            <input type="text" class="form-control" name="cedula" id="cedula" placeholder="ejemplo: 8995327" required autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label" >Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                placeholder="Ingresa tu primer nombre" onkeypress="validacionLetras(event)" autocomplete="off" required>
        </div>
        <div class="col-md-6">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido"
                placeholder="Ingresa tu primer apellido" onkeypress="validacionLetras(event)" autocomplete="off">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="genero" class="form-label">Género</label>
            <select class="form-control genero" id="genero" name="genero">
                <option value="masculino" selected>Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="helicoptero">Helicoptero</option>

            </select>
        </div>
        <div class="col">
            <label for="edad">Ingrese edad</label>
            <input type="number" class="form-control" name="edad" id="edad" placeholder="edad" required autocomplete="off">
        </div>
        <div class="col">
            <label for="nacimiento">Ingrese nacimiento</label>
            <input type="date" class="form-control" name="nacimiento" id="nacimiento" required  autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo"
                placeholder="Ingresa tu correo" autocomplete="off">
        </div>
        <div class="col-md-6">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono"
                placeholder="Ingresa tu teléfono" onkeypress="validacionNumeros(event)" autocomplete="off">
        </div>
    </div>
    <div class="row md-6">
        <div class="col-md-4">
            <label for="tipo">Seleccione el tipo</label>
            <select class="form-control " name="tipo" id="tipo" required>
                <option value="admin">Admin</option>
                <option value="empleado">Empleado</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="turno" class="form-label">Turno:</label>
            <select class="form-control" id="turno" name="turno">
                <option value="1" selected>Turno 1</option>
                <option value="2">Turno 2</option>
                <option value="3">Turno 3</option>                          
            </select>
        </div>
        <div class="col-md-4">
            <label for="departamento" class="form-label">Departamento:</label>
            <select class="form-control" id="departamento" name="departamento">
                <option value="recursos humano">Recursos Humano</option>
                <option value="finanzas" selected>Finanzas</option>
                <option value="contabilidad">Contabilidad</option>
                <option value="marketing">Marketing</option>
                <option value="produccion">Produccion</option>   
                <option value="tecnologia">Tecnologia</option>                           
                <option value="logistica">Logistica</option>                           
                <option value="legal">Legal</option>                           
                <option value="atencion al cliente">Atencion al Cliente</option>   
                <option value="sistemas">Sistemas</option>                           
                    
            </select>
        </div>
    </div>
   

    <h4 class="mt-5"><strong>Direccion</strong></h4>
    <hr>
    <div class="row mb-3">
        <div class="col">
            <label for="provincia">Provincia</label>
            <input type="text" class="form-control" name="provincia" id="provincia" placeholder="provincia" onkeypress="validacionLetras(event)" required autocomplete="off">
        </div>
        <div class="col">
            <label for="corregimiento">Corregimiento</label>
            <input type="text" class="form-control" name="corregimiento" id="corregimiento" placeholder="corregimiento" onkeypress="validacionLetras(event)" required autocomplete="off">
        </div>
        <div class="col">
            <label for="distrito">Distrito:</label>
            <input type="text" class="form-control" name="distrito" id="distrito" placeholder="distrito" required autocomplete="off"> 
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="ciudad" onkeypress="validacionLetras(event)" required autocomplete="off">
        </div>

        <div class="col">
            <label for="codigo_postal">Código Postal</label>
            <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" placeholder="código postal" required autocomplete="off">
        </div>
        <div class="col">
            <label for="numero_casa">Número de Casa</label>
            <input type="text" class="form-control" name ="numero_casa" id="numero_casa" placeholder="número de casa" required autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" placeholder="descripción"  autocomplete="off" rows="3"></textarea>
        </div>
    </div>


    <h4 class="mt-5"><strong>Planilla</strong></h4>
    <hr>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="hora_trabajada" class="form-label">Horas Trabajadas:</label>
            <input type="text" class="form-control hora_trabajada" id="hora_trabajada" name="hora_trabajada"
                placeholder="Ingresa el total de hora que se trabaja"  onkeypress="validacionNumeros(event)" required autocomplete="off">
        </div>
        <div class="col-md-4">
            <label for="sal_hora" class="form-label">Salario por hora:</label>
            <input type="text" class="form-control sal_hora" id="sal_hora" name="sal_hora"
                placeholder="Ingresa el salario por hora" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" required autocomplete="off">
        </div>
        <div class="col-md-4">
            <label for="descuento" class="form-label">Descuento:</label>
            <input type="text" class="form-control descuento" id="descuento" name="descuento"
                placeholder="Ingresa el Descuento" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" autocomplete="off">
        </div>

    </div>

    <div class="readonly-container-planilla">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="seguro_social" class="form-label">Seguro Social:</label>
                <input type="text" class="form-control seguro_social" id="seguro_social" name="seguro_social"
                    placeholder="Seguro Social" readonly>
            </div>
            <div class="col-md-4">
                <label for="seguro_educativo" class="form-label">Seguro Educativo:</label>
                <input type="text" class="form-control seguro_educativo" id="seguro_educativo" name="seguro_educativo"
                    placeholder="Seguro Educativo" readonly>
            </div>
            <div class="col-md-4">
                <label for="ir" class="form-label">Impuesto/Renta:</label>
                <input type="text" class="form-control ir" id="ir" name="ir" 
                placeholder="Ingresa Impuesto/Renta:" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="deducciones" class="form-label">Deducciones:</label>
                <input type="text" class="form-control deducciones" id="deducciones" name="deducciones" 
                placeholder="Deducciones" readonly>
            </div>
            <div class="col-md-4">
                <label for="salario_bruto" class="form-label">Salario Bruto:</label>
                <input type="text" class="form-control salario_bruto" id="salario_bruto" name="salario_bruto"
                    placeholder="salario bruto" readonly>
            </div>
            <div class="col-md-4">
                <label for="salario_neto" class="form-label">Salario Neto:</label>
                <input type="text" class="form-control salario_neto" id="salario_neto" name="salario_neto" 
                placeholder="Salario Neto" readonly>
            </div>
        </div>    
    </div>
  


    <br>
    <h4><strong>Credenciales de Usuario</strong></h4>
    <hr>
    <div class="row md-3">
        <div class="col-md-6">
            <label for="user">Nombre de usuario</label>
            <input type="text" class="form-control" name="user" id="user" placeholder="usuario" required>
        </div>
        <div class="col-md-6">
            <label for="password">Contraseña</label>
            <div class="row ">
                <div class="col">
                    <input type="password" class="form-control" name="password" id="password" placeholder="contraseña" required>
                </div>
                <div>
                    <button type="button" class="btn view-password" onclick="activarPasword(event)">ver</button>
                </div>
            </div>
        </div>

    </div>
    <br>

    <div class="button-container d-flex justify-content-center mb-5 mt-5">
        <button type="submit" class="btn btn-primary mr-5">Registrar</button>
        <button type="button" class="btn btn-danger limpiar_data" onclick="limpiarFormulario(event)">Limpiar</button>

    </div>
</form>