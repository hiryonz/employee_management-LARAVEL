<!-- Modal para Detalles de la Tarea -->
@php
    $isAdmin = auth()->user()->employee->tipo === "admin";
    $readonly = $isAdmin ? '' : 'readonly';
    $disabled = $isAdmin ? '' : 'disabled';
@endphp

<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del Modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Detalles de la Tarea
                    @if ($isAdmin)
                        || Actualizar Tarea
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="modal-body update-task-form" id="modalUpdate">
                <!-- Fila para Título y Cédula -->
                <div class="form-group row">
                    <div class="col">
                        <label for="task-title" class="modal-label">Título:</label>
                        <input type="text" id="task-title" name="titulo" class="form-control" placeholder="Título de la tarea" {{ $readonly }}>
                    </div>
                    <div class="col">
                        <label for="task-nombre" class="modal-label">Autor:</label>
                        <p id="task-nombre" class="modal-static-text"></p>
                    </div>
                </div>

                <!-- Departamento -->
                <div class="form-group row">
                    <div class="mb-3 col">
                        <label for="task-department" class="modal-label">Departamento:</label>
                        <select class="form-control departamento" id="task-department" name="departamento" onchange="updateEmployeeList('modalUpdate')" {{ $disabled }}>
                            <option value="recursos humano">Recursos Humano</option>
                            <option value="finanzas">Finanzas</option>
                            <option value="contabilidad">Contabilidad</option>
                            <option value="marketing">Marketing</option>
                            <option value="produccion">Producción</option>
                            <option value="tecnologia">Tecnología</option>
                            <option value="logistica">Logística</option>
                            <option value="legal">Legal</option>
                            <option value="atencion al cliente">Atención al Cliente</option>
                            <option value="sistemas">Sistemas</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="task-priority" class="modal-label">Prioridad:</label>
                        <select id="task-priority" name="prioridad" class="form-control" {{ $disabled }}>
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>
                        </select>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="form-group">
                    <label for="task-description" class="modal-label">Descripción:</label>
                    <textarea id="task-description" name="descripcion" class="form-control" rows="3" placeholder="Descripción de la tarea" {{ $readonly }}></textarea>
                </div>

                <!-- Asignar Tarea -->
                <div class="form-group">
                    <div class="mb-3" style="display: flex">
                        <label for="employee-select">Asignar Tarea</label>
                        <select class="form-control employee-select" id="employee-select" name="employeeSelect" onchange="addTaskForEmployee('modalUpdate')" {{ $disabled }}>
                            <!-- Empleados se llenarán dinámicamente -->
                        </select>
                    </div>
                    <div class="checkbox-group {{ $disabled }}" id="checkboxGroup" >
                        <!-- Los empleados aparecerán aquí -->
                    </div>
                </div>

                <!-- Fechas -->
                <div class="row">
                    <div class="col">
                        <label for="task-status" class="modal-label">Estado:</label>
                        <p id="task-status" class="modal-static-text">Nuevo</p>
                    </div>
                    <div class="col">
                        <label for="task-date-created" class="modal-label">Fecha de Creación:</label>
                        <p id="task-date-created" class="modal-static-text"></p>
                    </div>
                    <div class="col">
                        <label for="task-date-limit" class="modal-label">Fecha Límite:</label>
                        <input type="date" id="task-date-limit" name="fecha_limite" class="form-control" {{ $disabled }}>
                    </div>
                </div>
            </div>

            <!-- Pie de Página del Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                @if ($isAdmin)
                    <form method="POST" action="{{ route('tasks.destroy') }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="deleteId" id="task-id-delete" value="">
                        <button type="submit" class="btn btn-danger deleteTaskBtn" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea? Esta acción no se puede deshacer.');">Eliminar Tarea</button>
                    </form>
                    <button type="button" id="update-task-button" class="btn btn-primary updateTaskBtn" onclick="updateTask(this.id, event)">Confirmar Cambios</button>
                @endif
            </div>
        </div>
    </div>
</div>
