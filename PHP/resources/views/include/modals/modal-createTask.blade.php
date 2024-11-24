<!-- Modal de crear nueva tarea -->
<div class="modal fade" id="agregarTarea" tabindex="-1" role="dialog" aria-labelledby="agregarTareaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarTareaLabel">Crea una nueva tarea!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('addTask')}}" method="POST" class="task-form create-task-form">
                @csrf
                <div class="modal-body" id="modalCreate">
                    <!-- Cédula -->
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" class="form-control cedula" name="cedula" value="{{auth()->user()->employee->cedula}}" readonly>
                    </div>
                    <!-- Título -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control titulo" name="titulo" placeholder="Título de la tarea...">
                    </div>
                    <!-- Descripción -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control descripcion" name="descripcion" rows="3" placeholder="Escribe una descripción..."></textarea>
                    </div>
                    <!-- Departamento -->
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento:</label>
                        <select class="form-control departamento" name="departamento" onchange="updateEmployeeList('modalCreate')">
                            <?php $departamento = auth()->user()->employee->departamento; ?>
                            <option value="recursos humano" {{ $departamento == 'recursos humano' ? 'selected' : '' }}>Recursos Humanos</option>
                            <option value="finanzas" {{ $departamento == 'finanzas' ? 'selected' : '' }}>Finanzas</option>
                            <option value="contabilidad" {{ $departamento == 'contabilidad' ? 'selected' : '' }}>Contabilidad</option>
                            <option value="marketing" {{ $departamento == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="produccion" {{ $departamento == 'produccion' ? 'selected' : '' }}>Producción</option>
                            <option value="tecnologia" {{ $departamento == 'tecnologia' ? 'selected' : '' }}>Tecnología</option>
                            <option value="logistica" {{ $departamento == 'logistica' ? 'selected' : '' }}>Logística</option>
                            <option value="legal" {{ $departamento == 'legal' ? 'selected' : '' }}>Legal</option>
                            <option value="atencion al cliente" {{ $departamento == 'atencion al cliente' ? 'selected' : '' }}>Atención al Cliente</option>
                            <option value="sistemas" {{ $departamento == 'sistemas' ? 'selected' : '' }}>Sistemas</option>
                        </select>
                    </div>
                    <!-- Prioridad -->
                    <div class="mb-3">
                        <label for="prioridad" class="form-label">Prioridad</label>
                        <select class="form-control prioridad" name="prioridad">
                            <option selected disabled>Seleccione la prioridad</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <!-- Usuarios disponibles -->
                    <div class="mb-3">
                        <label for="employee-select" class="form-label">Asignar Tarea</label>
                        <select class="form-control employee-select" onchange="addTaskForEmployee('modalCreate')">
                            <!-- Empleados se llenarán dinámicamente -->
                        </select>
                        <div class="checkbox-group"></div>
                    </div>
                    <!-- Fecha límite -->
                    <div class="mb-3">
                        <label for="fecha_limite" class="form-label">Fecha Límite</label>
                        <input type="date" class="form-control fecha-limite" name="fecha_limite">
                    </div>
                    <!-- Fecha de creación -->
                    <div class="mb-3">
                        <label for="fecha_creacion" class="form-label">Fecha de Creación</label>
                        <input type="text" class="form-control fecha-creacion create-fecha-creacion" name="fecha_creacion" value="" readonly>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                </div>
            </form>
        </div>
    </div>
</div>
