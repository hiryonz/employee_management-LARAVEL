@extends('layout')
@section('title', 'task manager')
@section('content')
@section('style')
 <style>
    body {
        min-width: 1110px !important;
    }
 </style>
@endsection


    @if (auth()->user()->employee->tipo === "admin")
        @include('include.modals.modal-createTask')
    @endif

    <!-- modal para filtrar tareas -->
    @include('include.modals.modal-filter-task')

    <!-- modal para ver los detalles de un task -->
     @include('include.modals.modal-detailTask')


    <div class="parent-container-task">
        <div class="controller-container-task mt-2">
            <h4 class="mr-2">Filtros: </h4>
            @if (auth()->user()->employee->tipo == 'admin')
                <a class="ov-btn-grow-skew-reverse" data-bs-toggle="modal" data-bs-target="#filter-departamento">Departamentos</a>
            @endif
            <a class="ov-btn-grow-skew-reverse" data-bs-toggle="modal" data-bs-target="#filter-fecha">Fechas</a>
            <a class="ov-btn-grow-skew-reverse" data-bs-toggle="modal" data-bs-target="#filter-prioridad">Prioridad</a>
        </div>
        <div class="parent-content-container-task">
            <div class="opcion-sidebar-task content-container-task" id="drop-zone-new">
            <div class="title">Nuevos
            </div>
            <div class="drop-zone" id="nuevo">
                @if (auth()->user()->employee->tipo === "admin")
                    <button class=" add-card card-task" data-bs-toggle="modal" data-bs-target="#agregarTarea" onclick="asignarFecha(), updateEmployeeList('modalCreate')">Agregar nueva tarea</button>
                @endif
                @foreach ($dataTask as $task)
                    <button class="card-task {{ $task['estado'] }}" id="{{ $task['id'] }}" draggable="true" data-task-id="{{ $task['id'] }}" onclick="updateEmployeeList('modalUpdate'), getAsignEmployee('modalUpdate', {{ $task['id'] }})">
                        <div class="card-task-title">{{ $task['titulo'] }}</div>
                        <hr class="hr-task">
                        <div class="card-task-content">
                            <div class="card-task-description">{{ $task['departamento'] }}</div>
                            <div class="card-task-relevance">{{ $task['prioridad'] }}</div>
                            <div class="card-task-status">{{ $task['estado'] }}</div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="content-container-task"  id="drop-zone-asign">
            <div class="title">asignado</div>
            <div class="drop-zone" id="asignado"></div>
        </div>
        <div class="content-container-task" id="drop-zone-working">
                <div class="title">En Proceso</div>
                <div class="drop-zone" id="trabajando"></div>
        </div>
        <div class="content-container-task" id="drop-zone-review">
            <div class="title">Listo para Revision</div>
            <div class="drop-zone" id="revisar"></div>
        </div>
        <div class="content-container-task" id="drop-zone-done">
            <div class="title">Terminado</div>
            <div class="drop-zone" id="listo"></div>
        </div>
        </div>

    </div>

    @include('include.javascript.changeAsignTask')


<script>
 

// Limpia el checkbox-group al cerrar "agregarTarea"

if(document.getElementById('agregarTarea')) {
    document.getElementById('agregarTarea').addEventListener('hidden.bs.modal', function () {
        const checkboxGroup = document.querySelector('#agregarTarea .checkbox-group');
    
        if (checkboxGroup) {
            checkboxGroup.innerHTML = ''; // Limpia el contenido del contenedor
        }
    });
}

// Limpia el checkbox-group al cerrar "taskModal"
if(document.getElementById('taskModal')) {
    document.getElementById('taskModal').addEventListener('hidden.bs.modal', function () {
        const checkboxGroup = document.querySelector('#taskModal .checkbox-group');
        const selectGroup = document.querySelector('#taskModal #employee-select');
        if (checkboxGroup) {
            checkboxGroup.innerHTML = ''; // Limpia el contenido del contenedor
        }
        if(selectGroup) {
            console.log(selectGroup)
    
            selectGroup.innerHTML = ''; // Limpia el contenido del contenedor
            console.log(selectGroup)
        }
    });
}


//function changeTextbox()
function getAsignEmployee(modal, id) {
    console.log(id)
    const assignedEmployees = @json($dataTask)
    .filter(task => task.id === id)
    .flatMap(task => {
        // Asegúrate de manejar la ausencia de `incharge`
        console.log(task)
        if (!task.incharge) {
            console.warn(`La tarea con ID ${task.id} no tiene propiedad 'incharge'.`);
            return [];
        }
        return task.incharge;
    })
    .map(incharge => {
        console.log(incharge); // Depurar cada elemento de incharge
        return {
            cedula: incharge.cedula,
            id_incharge: incharge.id_incharge,
        };
    });


        initializeAssignedEmployees(modal, assignedEmployees)
}



function adjustTextareaHeight(textarea) {
    console.log(textarea.scrollHeight)
    textarea.style.height = `${textarea.scrollHeight}px`;
}

const textarea = document.getElementById('task-description');
textarea.addEventListener('input', function () {
    adjustTextareaHeight(this);
});



//asignar automaticamente la fecha de creacion a hoy
function asignarFecha() {
    let now = new Date();

    // Extraer las partes individuales
    let year = now.getFullYear();
    let month = String(now.getMonth() + 1).padStart(2, '0'); // Meses van de 0 a 11
    let day = String(now.getDate()).padStart(2, '0');
    let hours = String(now.getHours()).padStart(2, '0');
    let minutes = String(now.getMinutes()).padStart(2, '0');
    let seconds = String(now.getSeconds()).padStart(2, '0');

    // Formatear la fecha y hora
    let formattedNow = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    document.querySelector('.create-fecha-creacion').value = formattedNow;

    console.log(formattedNow);
}


// Función para aplicar el filtro
function filterTasks(filterType, filterValue) {
    const tasks = document.querySelectorAll('.card-task:not(.add-card)');
    tasks.forEach(task => {
        let taskValue = '';
        // Obtener el valor del campo según el tipo de filtro
        if (filterType === 'departamento') {
            taskValue = task.querySelector('.card-task-description').textContent.toLowerCase();
        } else if (filterType === 'prioridad') {
            taskValue = task.querySelector('.card-task-relevance').textContent.toLowerCase();
        } else if (filterType === 'fecha') {
            const tasksData = @json($dataTask);
            const taskData = tasksData.find(t => t.id == task.getAttribute('id'));

            if (taskData) {
                taskValue = taskData.fecha_creacion; // Usa la fecha del backend
            } else {
                taskValue = '';
            }
            console.log(`Comparando: taskValue=${taskValue}, filterValue=${filterValue}`);
        }


        // Mostrar u ocultar la tarea según el filtro
        if (filterValue === 'all' || taskValue.includes(filterValue)) {
            task.style.display = 'block';
        } else {
            task.style.display = 'none';
        }
    });
}


document.addEventListener('DOMContentLoaded', function () {
    // Información de las tareas desde Laravel
    const tasks = @json($dataTask);
    console.log(tasks)
    // Asignar eventos drag and drop a las tarjetas
    asignarEventsDrag();

    // Mover tarjetas a la zona de caída correspondiente
    asignarTareasAZonas();

    // Asignar eventos de clic para abrir el modal con detalles
    asignarEventosClick(tasks);

     // Filtrar por Departamento
     document.getElementById('apply-filter-departamento').addEventListener('click', () => {
        const filterValue = document.getElementById('filter-departamento-input').value.toLowerCase();
        filterTasks('departamento', filterValue);
    });

    // Filtrar por Fecha (puedes ajustar según tus datos)
    document.getElementById('apply-filter-fecha').addEventListener('click', () => {
        const filterValue = document.getElementById('filter-fecha-input').value;
        console.log(filterValue)

        filterTasks('fecha', filterValue);
    });

    // Filtrar por Prioridad
    document.getElementById('apply-filter-prioridad').addEventListener('click', () => {
        const filterValue = document.getElementById('filter-prioridad-input').value.toLowerCase();
        filterTasks('prioridad', filterValue);
    });

    document.getElementById('filter-fecha-all').addEventListener('click', () => {
        filterTasks('fecha', 'all');
    });

});

// Función para mover tareas a las zonas de caída
function asignarTareasAZonas() {
    const cards = document.querySelectorAll(".card-task:not(.add-card)");

    cards.forEach(card => {
        // Obtener el estado desde el contenido de la tarjeta
        const taskStatus = card.querySelector(".card-task-status").textContent.trim();

        // Encontrar la zona de caída correspondiente
        const dropZone = document.getElementById(taskStatus.toLowerCase());

        if (dropZone) {
            // Mover la tarjeta a la zona correspondiente
            dropZone.appendChild(card);
        } else {
            console.error(`No existe una zona de caída para el estado: ${taskStatus}`);
        }
    });
}

// Función para asignar eventos de clic para abrir el modalEN TASK DETAIL
function asignarEventosClick(tasks) {
    const cards = document.querySelectorAll(".card-task");

    cards.forEach(card => {
        card.addEventListener("click", function () {
            const taskId = this.getAttribute("data-task-id");

            // Buscar la información de la tarea seleccionada
            const task = tasks.find(t => t.id == taskId);
            if (task) {
                // Actualizar el contenido del modal
                console.log(task);

                const taskDepartmentSelect = document.getElementById("task-department");
                const descripcion = document.getElementById("task-description");
                const status = document.getElementById("task-status");
                const container = document.getElementById(taskId); // Buscar el contenedor por ID

                const actualStatus = container.querySelector('.card-task-status').innerHTML;
                console.log(container)
                console.log(actualStatus)
                if(document.querySelector('.updateTaskBtn')) {
                    document.querySelector('.updateTaskBtn').id = taskId + '_task';
                }
                if( document.querySelector('#task-id-delete')) {
                    document.querySelector('#task-id-delete').value = taskId;
                }
                document.querySelector('#taskModalLabel').textContent = 'id= ' + taskId;

                // Actualizar los valores del modal
                document.getElementById("task-title").value = task.titulo;
                document.getElementById("task-priority").value = task.prioridad;
                document.getElementById("task-date-created").textContent = task.fecha_creacion;
                document.getElementById("task-date-limit").value = task.fecha_limite;
                document.getElementById("task-nombre").textContent = task.employee.nombre;
                descripcion.value = task.descripcion;
                status.textContent = actualStatus;
                status.className = 'task-status ' + actualStatus;

                // Ajustar altura del textarea
                setTimeout(() => {
                    adjustTextareaHeight(descripcion);
                }, 200);

                // Simular selección de departamento
                if (Array.from(taskDepartmentSelect.options).some(option => option.value === task.departamento)) {
                    Array.from(taskDepartmentSelect.options).forEach(option => {
                        if (option.value === task.departamento) {
                            option.selected = true; // Marcar como seleccionada
                            option.click(); // Simular clic
                        }
                    });

                    // Disparar evento 'change' para notificar cambios
                    taskDepartmentSelect.dispatchEvent(new Event('change', { bubbles: true }));
                } else {
                    console.warn(`El departamento "${task.departamento}" no coincide con ninguna opción del select.`);
                }

                // Mostrar el modal
                const taskModal = new bootstrap.Modal(document.getElementById("taskModal"));
                taskModal.show();
            } else {
                console.error("No se encontró la tarea con ID:", taskId);
            }
        });
    });
}



function updateTaskStatus(taskId, newStatus) {
    // Datos a enviar al servidor
    const data = {
        id: taskId,
        estado: newStatus
    };

    // Enviar la solicitud al servidor
    fetch("{{route('updateTaskState')}}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // Incluye el token CSRF si es necesario
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
            console.log('Estado de la tarea actualizado correctamente.');
        } else {
            console.error('Error al actualizar el estado:', result.message);
        }
    })
    .catch(error => {
        console.error('Error en updateTaskStatus:', error);
    });
}

function updateTask(taskId, event) {
    const modal = event.target.closest('.modal-content');
    const forEmployeeInputs = modal.querySelectorAll('input[name="forEmployee[]"]');
    const forEmployee = Array.from(forEmployeeInputs).map(input => input.value);
    taskId = taskId.split('_')[0]
    const data = {
        id: taskId,
        titulo: modal.querySelector('#task-title').value.trim(),
        descripcion: modal.querySelector('#task-description').value.trim(),
        departamento: modal.querySelector('#task-department').value,
        prioridad: modal.querySelector('#task-priority').value,
        estado: modal.querySelector('#task-status').textContent.trim(),
        fecha_limite: modal.querySelector('#task-date-limit').value,
        forEmployee: forEmployee
    };
    console.log(data)
    
    fetch("{{ route('updateTask') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'        
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
    if (data.success) {
        console.log("Encargados actuales:", data);
        alert('datos actualizada correctamente')
        window.location.reload();
    } else {
        console.error("Error:", data.message);
    }
    })
    .catch(error => {
        console.error('Error al actualizar la tarea:', error);
    });
}


//asignar lo seventos de drag y drop
function asignarEventsDrag() {
    const cards = document.querySelectorAll('.card-task:not(.original)');
    const dropZones = document.querySelectorAll('.drop-zone');
    
    // Agregar listeners de arrastrar a cada tarjeta
    let newX = 0, newY = 0, startX = 0, startY = 0;
    cards.forEach(card => {
        card.addEventListener('dragstart', function(event) {
            card.classList.add('dragging');
            event.dataTransfer.setData('text/plain', card.id); // Pasar el ID de la tarjeta
            console.log(`Dragging card: ${card.id}`);
        });
        card.addEventListener('dragend', function(event) {
            card.classList.remove('dragging');
        });
    });
    
       
    let placeholder = document.createElement('div'); // Crear un marcador global único
    placeholder.className = 'placeholder'; // Clase para estilos
    
    dropZones.forEach(dropZone => {
        let dragCounter = 0; // Contador para manejar eventos dragenter y dragleave
    
        dropZone.addEventListener('dragenter', function (event) {
            event.preventDefault();
            dragCounter++;
            dropZone.classList.add('highlight'); // Agregar highlight
        });
    
        dropZone.addEventListener('dragleave', function (event) {
            dragCounter--;
            if (dragCounter === 0) {
                dropZone.classList.remove('highlight'); // Quitar highlight solo si realmente sale
            }
        });
    
        dropZone.addEventListener('dragover', function (event) {
            event.preventDefault(); // Necesario para permitir el drop
    
            const mouseY = event.clientY;
    
            // Obtener todas las tarjetas dentro del dropZone
            const dropZoneCards = [...dropZone.children];
            const unavailableDropZone = document.querySelector('.add-card')
            // Encontrar el elemento sobre el que se pasa el ratón
            const targetCard = dropZoneCards.find(card => {
                const rect = card.getBoundingClientRect();
                return mouseY > rect.top && mouseY < rect.bottom;
            });
            console.log(targetCard)
            if (targetCard && targetCard !== placeholder && targetCard !== unavailableDropZone) {
                const rect = targetCard.getBoundingClientRect();
                const middleY = rect.top + rect.height / 2;
    
                if (mouseY <= middleY) {
                    // Si el mouse está en la mitad superior del targetCard
                    dropZone.insertBefore(placeholder, targetCard);
                } else {
                    // Si el mouse está en la mitad inferior del targetCard
                    dropZone.insertBefore(placeholder, targetCard.nextSibling);
                }
            } else if (!targetCard && !dropZone.contains(placeholder)) {
                // Si no hay objetivo, agregamos el placeholder al final
                dropZone.appendChild(placeholder);
            }
        });
    
        dropZone.addEventListener('drop', function (event) {
            const authUser = '<?php echo auth()->user()->employee->tipo; ?>';
            event.preventDefault();
            dragCounter = 0; // Reiniciar contador al soltar
            const cardId = event.dataTransfer.getData('text/plain'); // Obtener el ID de la tarjeta
            const card = document.getElementById(cardId);

            console.log(cardId);
            console.log(card);
            console.log(document.getElementById('20'));
            card.querySelector('.card-task-status').textContent = dropZone.id;
            console.log(authUser);
            console.log(dropZone.id);

            if (authUser !== 'admin' && dropZone.id === 'listo') {
                alert('La tarea debe ser revisado por el administrador');
                return;
            }
            updateTaskStatus(card.id, dropZone.id);
            card.className = 'card-task ' + dropZone.id;
            // Reemplazar el marcador con la tarjeta
            if (placeholder.parentElement === dropZone) {
                dropZone.replaceChild(card, placeholder);
            } else {
                dropZone.appendChild(card);
            }

            dropZone.classList.remove('highlight');

            // **Agregar clase para iniciar la animación**
            dropZone.classList.add('dropzone-animate');

            // **Escuchar el evento animationend para remover la clase después de la animación**
            dropZone.addEventListener('animationend', function handler() {
                dropZone.classList.remove('dropzone-animate');
                dropZone.removeEventListener('animationend', handler);
            });
        });

    });

    // Eliminar marcador cuando termina el drag
    document.addEventListener('dragend', function () {
        if (placeholder.parentElement) {
            placeholder.parentElement.removeChild(placeholder);
        }
    });
    
}






</script>

@endsection