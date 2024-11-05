@props(['employeeData', 'planillaData', 'direcionData', 'userData'])


<div class="submain-data">
    <div class="title-container">
        <h1>hola </h1>
    </div>
    <div class="employee-profile-container">
        <div class="profile-picture-container">
            <div class="card">
                <img class="card-img-top" src="https://i.pinimg.com/236x/f5/7e/ea/f57eeaea750b772c083acbd7ad971aa8.jpg" alt="Card image cap">
                <div class="card-body">
                    <button class="btn btn-light ">Actaulizar Foto de perfil?</button>
                    <hr>
                    <h5>Contactos personales</h5>
                        <div class="data-container">
                            <label for="correo" class=" title">Correo:</label>
                            <input type="text" class="form-control" name="correo" id="correo" 
                            value="{{ isset($employeeData[0]['email']) ? $employeeData[0]['email'] : '' }} " placeholder="N/A" autocomplete="off">
                        </div>
                        <div class="data-container">
                            <label for="telefono" class=" title">Telefono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono"
                            value="{{ isset($employeeData[0]['telefono']) ? $employeeData[0]['telefono'] : '' }} " placeholder="N/A" autocomplete="off"> 
                        </div>
                    <hr>
                    <h5>Cuenta de Usuario</h5>
                        <div class="data-container">
                            <label for="user" class=" title">Usuario:</label>
                            <input type="text" class="form-control" name="user" id="user"
                            value="{{ isset($userData[0]['user']) ? $userData[0]['user'] : '' }}"  placeholder="N/A" autocomplete="off"> 
                        </div>
                </div>
            </div>
        </div>
        <div class="profile-data-container">
            <h5>Datos Personales</h5>
                <div class="data-container">
                    <label for="cedula" class="title">Cedula:</label>
                    <input type="text" class="form-control" name="cedula" id="cedula"
                    value="{{ isset($employeeData[0]['cedula']) ? $employeeData[0]['cedula'] : '' }}"   placeholder="N/A" autocomplete="off">
                </div>
                <div class="data-container">
                    <label for="nombre" class="title">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre"
                    value="{{ isset($employeeData[0]['nombre']) ? $employeeData[0]['nombre'] : '' }}" placeholder="N/A" autocomplete="off">
                </div>
                <div class="data-container">
                    <label for="apellido" class=" title">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido"
                    value="{{ isset($employeeData[0]['apellido']) ? $employeeData[0]['apellido'] : '' }}" placeholder="N/A" autocomplete="off">
                </div>
                <div class="data-container">
                    <label for="genero" class=" title">Genero:</label>
                    <input type="text" class="form-control" name="genero" id="genero"
                    value="{{ isset($employeeData[0]['genero']) ? $employeeData[0]['genero'] : '' }}" placeholder="N/A" autocomplete="off">
                </div>

                <div class="data-container">
                    <label for="edad" class="title">Edad:</label>
                        <input type="text" class="form-control" name="edad" id="edad"
                        value="{{ isset($employeeData[0]['edad']) ? $employeeData[0]['edad'] : '' }}" placeholder="N/A" autocomplete="off">
                </div>
                <div class="data-container">
                    <label for="nacimiento" class=" title">Nacimiento:</label>
                    <input type="date" class="form-control" name="nacimiento" id="nacimiento"
                    value="{{ isset($employeeData[0]['nacimiento']) ? $employeeData[0]['nacimiento'] : '' }}" placeholder="N/A" autocomplete="off"> 
                </div>
                <div class="data-container">
                    <label for="turno" class="title">Turno:</label>
                    <select class="form-control" id="turno" name="turno">
                        <option value="1" selected>Turno 1</option>
                        <option value="2">Turno 2</option>
                        <option value="3">Turno 3</option>                          
                    </select>                
                </div>

                <div class="data-container data-container-duo">         
                    <div class="data-container-sub">
                        <label for="tipo" class="title">Rol del empleado:</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="admin">Admin</option>
                            <option value="empleado">Empleado</option>
                        </select>                            
                    </div>
                    <div class="data-container-sub">
                        <label for="departamento" class=" title">Departamento:</label>
                            <select class="form-control" id="departamento" name="departamento">
                                <option>N/A</option>
                                <option value="recursos humano">Recursos Humano</option>
                                <option value="finanzas">Finanzas</option>
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
            <hr>
            <h5>Direcciones</h5>
            <div class="direction-container">
                <div class="direction-1">
                    <div class="data-container">
                        <label for="provincia" class="title">Provincia:</label>
                        <input type="text" class="form-control" name="provincia" id="provincia"
                        value="{{ isset($direcionData[0]['provincia']) ? $direcionData[0]['provincia'] : '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="corregimiento" class="title">Corregimiento:</label>
                        <input type="text" class="form-control" name="corregimiento" id="corregimiento"
                        value="{{ isset($direcionData[0]['corregimiento']) ? $direcionData[0]['corregimiento'] : '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="distrito" class="title">Distrito:</label>
                        <input type="text" class="form-control" name="distrito" id="distrito"
                        value="{{ isset($direcionData[0]['distrito']) ? $direcionData[0]['distrito'] : '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="ciudad" class="title">Ciudad:</label>
                        <input type="text" class="form-control" name="ciudad" id="ciudad"
                        value="{{ isset($direcionData[0]['ciudad']) ? $direcionData[0]['ciudad'] : '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="codigo_postal" class="title">Código Postal:</label>
                        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal"
                        value="{{ isset($direcionData[0]['codigo_postal']) ? $direcionData[0]['codigo_postal'] : '' }}" placeholder="N/A" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="numero_casa" class="title"># Casa:</label>
                        <input type="text" class="form-control" name="numero_casa" id="numero_casa"
                        value="{{ isset($direcionData[0]['numero_casa']) ? $direcionData[0]['numero_casa'] : '' }}" placeholder="N/A" required autocomplete="off">
                    </div>
                </div>
                <div class="direction-2">
                    <div class="col form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion"
                        value="{{ isset($direcionData[0]['descripcion']) ? $direcionData[0]['descripcion'] : '' }}" autocomplete="off" rows="3"></textarea>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="profile-planilla-container">
        <h4 class="mt-5"><strong>Planilla</strong></h4>
        <hr>
        <div class="row data-container mb-3">
            <div class="col-md-6     col-lg-4 data-container-sub">
                <label for="hora_trabajada" class="form-label">Horas Trabajadas:</label>
                <input type="text" class="form-control hora_trabajada" id="hora_trabajada" name="hora_trabajada"
                    value="{{ isset($planillaData[0]['hora_trabajada']) ? $planillaData[0]['hora_trabajada'] : 205 }}"
                    placeholder="N/A" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" required autocomplete="off">
            </div>
            <div class="col-md-6 col-lg-4 data-container-sub">
                <label for="sal_hora" class="form-label">Salario por hora:</label>
                <input type="text" class="form-control sal_hora" id="sal_hora" name="sal_hora"
                value="{{ isset($planillaData[0]['salario_h']) ? $planillaData[0]['salario_h'] : 0 }}"
                    placeholder="N/A" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" required autocomplete="off">
            </div>
            <div class="col-md-6 col-lg-4 data-container-sub">
                <label for="descuento" class="form-label">Descuento:</label>
                <input type="text" class="form-control descuento" id="descuento" name="descuento"
                value="{{ isset($planillaData[0]['descuentos']) ? $planillaData[0]['descuentos'] : 0 }}"
                    placeholder="N/A" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" autocomplete="off">
            </div>

        </div>

        <div class="readonly-container-planilla">
            <div class="row mb-3">
                <div class="col-md-5 col-lg-4 mb-2">
                    <label for="seguro_social" class="form-label">Seguro Social:</label>
                    <input type="text" class="form-control seguro_social" id="seguro_social" name="seguro_social"
                    value="{{ isset($planillaData[0]['seguro_social']) ? $planillaData[0]['seguro_social'] : 0 }}" placeholder="N/A" readonly>
                </div>
                <div class="col-md-5 col-lg-4 mb-2">
                    <label for="seguro_educativo" class="form-label">Seguro Educativo:</label>
                    <input type="text" class="form-control seguro_educativo" id="seguro_educativo" name="seguro_educativo"
                    value="{{ isset($planillaData[0]['seguro_educativo']) ? $planillaData[0]['seguro_educativo'] : 0 }}" placeholder="N/A" readonly>
                </div>
                <div class="col-md-5 col-lg-4 mb-2">
                    <label for="ir" class="form-label">Impuesto/Renta:</label>
                    <input type="text" class="form-control ir" id="ir" name="ir" 
                    value="{{ isset($planillaData[0]['impuesto_renta']) ? $planillaData[0]['impuesto_renta'] : 0 }}" placeholder="N/A" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-5 col-lg-4 mb-2">
                    <label for="deducciones" class="form-label">Deducciones:</label>
                    <input type="text" class="form-control deducciones" id="deducciones" name="deducciones" 
                    value="{{ isset($planillaData[0]['deducciones']) ? $planillaData[0]['deducciones'] : 0 }}" placeholder="N/A" readonly>
                </div>
                <div class="col-md-5 col-lg-4 mb-2">
                    <label for="salario_bruto" class="form-label">Salario Bruto:</label>
                    <input type="text" class="form-control salario_bruto" id="salario_bruto" name="salario_bruto"
                    value="{{ isset($planillaData[0]['salario_bruto']) ? $planillaData[0]['salario_bruto'] : 0 }}" placeholder="N/A" readonly>
                </div>
                <div class="col-md-5 col-lg-4 mb-2">
                    <label for="salario_neto" class="form-label">Salario Neto:</label>
                    <input type="text" class="form-control salario_neto" id="salario_neto" name="salario_neto" 
                    value="{{ isset($planillaData[0]['salario_neto']) ? $planillaData[0]['salario_neto'] : 0 }}" placeholder="N/A" readonly>
                </div>
            </div>    
        </div>
    </div>
</div>