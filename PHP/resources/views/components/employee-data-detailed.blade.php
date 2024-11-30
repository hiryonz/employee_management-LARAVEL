@props(['name', 'employeeData', 'planillaData', 'direcionData', 'userData', 'QR', 'faltas'])
@csrf
<div class="submain-data">
    <div class="title-container">
    </div>
    <div class="employee-profile-container">
        <div class="profile-picture-container">
            <div class="card">
                <div class="img-container">
                    @if ($employeeData->profile_image ?? '' && File::exists(public_path($employeeData->profile_image ?? '')))
                        <img class="card-img-top img" src="{{ asset($employeeData->profile_image) }}" alt="Card image cap" class="profile-image img">
                        @else
                        <img src="{{ asset('img/default_profile_img.png') }}" alt="Imagen predeterminada" class="profile-image img">
                    @endif
                </div>
                <div class="card-body">
                    <!--se verifica por qr code porque solo aparece en la apgina principal  https://i.pinimg.com/236x/f5/7e/ea/f57eeaea750b772c083acbd7ad971aa8.jpg-->
                    @if(isset($name))
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#updateProfileImageModal">
                            Actualizar Foto de perfil
                        </button>

                    @endif

                    <hr>
                    <h5>Contactos personales</h5>
                        <div class="data-container">
                            <label for="correo" class=" title">Correo:</label>
                            <input type="text" class="form-control" name="correo" id="correo" 
                            value="{{ $employeeData->email ?? '' }}" placeholder="N/A" autocomplete="off">
                        </div>
                        <div class="data-container">
                            <label for="telefono" class=" title">Telefono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono"
                            value="{{ $employeeData->telefono ?? '' }}" placeholder="N/A" autocomplete="off"> 
                        </div>
                    <hr>
                    <h5>Cuenta de Usuario</h5>
                        <div class="data-container">
                            <label for="user" class=" title">Usuario:</label>
                            <input type="text" class="form-control" name="user" id="user"
                            value="{{ $userData->user ?? '' }}" placeholder="N/A" autocomplete="off"> 
                        </div>
                        <button type="button" class="btn btn-light mb-3" onclick="window.location.href='{{ route('get.password') }}'">
                            Cambiar contraseña?
                        </button>

                        <div class="data-container">
                            @if (isset($QR))
                                <img src="data:image/png;base64,{{ $QR->qr_code }}" alt="Código QR">
                            @endif
                        </div>
                </div>
            </div>
        </div>
        <div class="profile-data-container">
            <h5>Datos Personales</h5>
                <div class="data-container">
                    <label for="cedula" class="title">Cedula:</label>
                    <input type="text" class="form-control" name="cedula" id="cedula"
                    value="{{ $employeeData->cedula ?? '' }}" placeholder="N/A" autocomplete="off" readonly>
                </div>
                <div class="data-container">
                    <label for="nombre" class="title">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" onkeypress="validacionLetras(event)"
                    value="{{ $employeeData->nombre ?? '' }}" placeholder="N/A" autocomplete="off" >
                </div>
                <div class="data-container">
                    <label for="apellido" class=" title">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" onkeypress="validacionLetras(event)"
                    value="{{ $employeeData->apellido ?? '' }}" placeholder="N/A" autocomplete="off">
                </div>

                <div class="data-container">
                    <label for="genero" class="title">Género</label>
                    <select class="form-control genero" id="genero" name="genero">
                        <option value="masculino" {{ $employeeData->genero === 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ $employeeData->genero === 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="helicoptero" {{ $employeeData->genero === 'helicoptero' ? 'selected' : '' }}>Helicoptero</option>
                    </select>
                </div>

                <div class="data-container">
                    <label for="edad" class="title">Edad:</label>
                    <input type="text" class="form-control" name="edad" id="edad" onkeypress="validacionNumeros(event)"
                    value="{{ $employeeData->edad ?? '' }}" placeholder="N/A" autocomplete="off">
                </div>
                <div class="data-container">
                    <label for="nacimiento" class=" title">Nacimiento:</label>
                    <input type="date" class="form-control" name="nacimiento" id="nacimiento"
                    value="{{ $employeeData->nacimiento ?? '' }}" placeholder="N/A" autocomplete="off"> 
                </div>
                <div class="data-container">
                    <label for="turno" class="title">Turno:</label>
                    <select class="form-control" id="turno" name="turno">
                        <option value="1" {{ $employeeData->turno == 1 ? 'selected' : '' }}>Turno 1</option>
                        <option value="2" {{ $employeeData->turno == 2 ? 'selected' : '' }}>Turno 2</option>
                        <option value="3" {{ $employeeData->turno == 3 ? 'selected' : '' }}>Turno 3</option>                          
                    </select>                
                </div>      
                    <div class="data-container-sub">
                        <label for="tipo" class="title">Rol del empleado:</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="admin" {{ $employeeData->tipo === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="empleado" {{ $employeeData->tipo === 'empleado' ? 'selected' : '' }}>Empleado</option>
                        </select>                            
                    </div>
                    <div class="data-container-sub">
                        <label for="departamento" class=" title">Departamento:</label>
                            <select class="form-control" id="departamento" name="departamento">
                                <option value="" {{ !$employeeData->departamento ? 'selected' : '' }}>N/A</option>
                                <option value="recursos humano" {{ $employeeData->departamento === 'recursos humano' ? 'selected' : '' }}>Recursos Humano</option>
                                <option value="finanzas" {{ $employeeData->departamento === 'finanzas' ? 'selected' : '' }}>Finanzas</option>
                                <option value="contabilidad" {{ $employeeData->departamento === 'contabilidad' ? 'selected' : '' }}>Contabilidad</option>
                                <option value="marketing" {{ $employeeData->departamento === 'marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="produccion" {{ $employeeData->departamento === 'produccion' ? 'selected' : '' }}>Produccion</option>   
                                <option value="tecnologia" {{ $employeeData->departamento === 'tecnologia' ? 'selected' : '' }}>Tecnologia</option>                           
                                <option value="logistica" {{ $employeeData->departamento === 'logistica' ? 'selected' : '' }}>Logistica</option>                           
                                <option value="legal" {{ $employeeData->departamento === 'legal' ? 'selected' : '' }}>Legal</option>                           
                                <option value="atencion al cliente" {{ $employeeData->departamento === 'atencion al cliente' ? 'selected' : '' }}>Atencion al Cliente</option>   
                                <option value="sistemas" {{ $employeeData->departamento === 'sistemas' ? 'selected' : '' }}>Sistemas</option>                              
                            </select>
                    </div>

            <hr>
            <h5>Direcciones</h5>
            <div class="direction-container">
                <div class="direction-1">
                    <div class="data-container">
                        <label for="provincia" class="title">Provincia:</label>
                        <input type="text" class="form-control" name="provincia" id="provincia"
                            value="{{ $direcionData->provincia ?? '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="corregimiento" class="title">Corregimiento:</label>
                        <input type="text" class="form-control" name="corregimiento" id="corregimiento"
                            value="{{ $direcionData->corregimiento ?? '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="distrito" class="title">Distrito:</label>
                        <input type="text" class="form-control" name="distrito" id="distrito"
                            value="{{ $direcionData->distrito ?? '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="ciudad" class="title">Ciudad:</label>
                        <input type="text" class="form-control" name="ciudad" id="ciudad"
                            value="{{ $direcionData->ciudad ?? '' }}" placeholder="N/A" onkeypress="validacionLetras(event)" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="codigo_postal" class="title">Código Postal:</label>
                        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal"
                            value="{{ $direcionData->codigo_postal ?? '' }}" placeholder="N/A" required autocomplete="off">
                    </div>
                    <div class="data-container">
                        <label for="numero_casa" class="title"># Casa:</label>
                        <input type="text" class="form-control" name="numero_casa" id="numero_casa"
                            value="{{ $direcionData->numero_casa ?? '' }}" placeholder="N/A" required autocomplete="off">
                    </div>
                    <div class="direction-2">
                        <div class="col form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion"
                                    autocomplete="off" rows="3">{{ $direcionData->descripcion ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>

            <div class="profile-planilla-container">
                <h4 class="mt-5"><strong>Planilla</strong></h4>
                <hr>
                <div class="row data-container mb-3">
                    <div class="col-md-6 col-lg-4 data-container-sub">
                        <label for="hora_trabajada" class="form-label">Horas Trabajadas:</label>
                        <input type="text" class="form-control hora_trabajada" id="hora_trabajada" name="hora_trabajada"
                            value="{{ $planillaData->hora_trabajada ?? 205 }}" placeholder="N/A" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" required autocomplete="off">
                    </div>
                    <div class="col-md-6 col-lg-4 data-container-sub">
                        <label for="sal_hora" class="form-label">Salario por hora:</label>
                        <input type="text" class="form-control sal_hora" id="sal_hora" name="sal_hora"
                            value="{{ $planillaData->salario_h ?? 0 }}" placeholder="N/A" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" required autocomplete="off">
                    </div>
                    <div class="col-md-6 col-lg-4 data-container-sub">
                        <label for="descuento" class="form-label">Descuento:</label>
                        <input type="text" class="form-control descuento" id="descuento" name="descuento"
                            value="{{ $planillaData->descuentos ?? 0 }}" placeholder="N/A" onblur="redondearInput(event)" onkeypress="validacionNumerosPlanilla(event)" autocomplete="off">
                    </div>
                </div>

                <div class="readonly-container-planilla">
                <div class="row mb-3 mr-6">
                        <div class="col-sm-4 col-md-5 col-lg-4 mb-2">
                            <label for="horas_faltas" class="form-label">Horas Faltadas:</label>
                            <input type="text" class="form-control horas_faltas" id="horas_faltas" name="horas_faltas"
                                value="{{ $faltas->horas ?? 0 }}" placeholder="N/A" readonly>
                        </div>
                        <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                            <label for="total_descuento" class="form-label">Total de descuento:</label>
                            <input type="text" class="form-control total_descuento" id="total_descuento" name="total_descuento"
                                value="{{ $faltas->descuento ?? 0 }}" placeholder="N/A" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 col-md-5 col-lg-4 mb-2">
                            <label for="seguro_social" class="form-label">Seguro Social:</label>
                            <input type="text" class="form-control seguro_social" id="seguro_social" name="seguro_social"
                                value="{{ $planillaData->seguro_social ?? 0 }}" placeholder="N/A" readonly>
                        </div>
                        <div class="col-sm-4 col-md-5 col-lg-4 mb-2">
                            <label for="seguro_educativo" class="form-label">Seguro Educativo:</label>
                            <input type="text" class="form-control seguro_educativo" id="seguro_educativo" name="seguro_educativo"
                                value="{{ $planillaData->seguro_educativo ?? 0 }}" placeholder="N/A" readonly>
                        </div>
                        <div class="col-sm-4 col-md-5 col-lg-4 mb-2">
                            <label for="ir" class="form-label">Impuesto/Renta:</label>
                            <input type="text" class="form-control ir" id="ir" name="ir" 
                                value="{{ $planillaData->impuesto_renta ?? 0 }}" placeholder="N/A" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 col-md-5 col-lg-4 mb-2">
                            <label for="deducciones" class="form-label">Deducciones:</label>
                            <input type="text" class="form-control deducciones" id="deducciones" name="deducciones" 
                                value="{{ $planillaData->deducciones ?? 0 }}" placeholder="N/A" readonly>
                        </div>
                        <div class="col-sm-4 col-md-5 col-lg-4 mb-2">
                            <label for="salario_bruto" class="form-label">Salario Bruto:</label>
                            <input type="text" class="form-control salario_bruto" id="salario_bruto" name="salario_bruto"
                                value="{{ $planillaData->salario_bruto ?? 0 }}" placeholder="N/A" readonly>
                        </div>
                        <?php $salario_final = ($planillaData->salario_neto ?? 0) - ($faltas->descuento ?? 0) ?>
                        <div class="col-sm-4 col-md-5 col-lg-4 mb-2">
                            <label for="salario_neto" class="form-label">Salario Neto:</label>
                            <input type="text" class="form-control salario_neto" id="salario_neto" name="salario_neto" 
                                value="{{ $salario_final }}" placeholder="N/A" readonly>
                        </div>
                </div>    
            </div>
        </div>
    </div>