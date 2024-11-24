<script>
             // Datos de empleados se pasan desde el backend al frontend
const employeeData = <?php echo json_encode($employeeData); ?>;

let previousDepartments = {};

// Actualizar lista de empleados
function updateEmployeeList(modalId) {
    const modal = document.getElementById(modalId);
    const modalParent = modal.closest('.modal.fade');
    console.log(modalParent)

    const departamentoSelect = modal.querySelector('.departamento');
    console.log(departamentoSelect.value)
    const employeeSelect = modal.querySelector('.employee-select');
    const checkboxGroup = modal.querySelector('.checkbox-group');
    const departamento = departamentoSelect.value;
    // Verificar si el contenedor tiene elementos hijos

    if (checkboxGroup.children.length > 0 && modalParent.classList.contains('show') ) {
        if (!confirm('Se borrarán todos los empleados seleccionados si cambia de departamento. ¿Desea continuar?')) {
            // Restaurar el valor anterior
            departamentoSelect.value = previousDepartments[modalId] || '';
            return;
        }
        // Vaciar el contenedor si se confirma
        checkboxGroup.innerHTML = '';
    }
    console.log(departamento)

    // Actualizar el valor previo solo si el usuario confirma
    previousDepartments[modalId] = departamento;
    console.log(departamento)
    
    // Limpiar el select de empleados
    employeeSelect.innerHTML = '';


    // Crear y agregar la opción inicial
    const optionStart = document.createElement('option');
    optionStart.textContent = 'Asigne un empleado a la tarea';
    optionStart.value = '';
    optionStart.disabled = true;
    optionStart.selected = true;
    employeeSelect.appendChild(optionStart);

    // Filtrar empleados por departamento
    const filteredEmployees = employeeData.filter(employee => employee.departamento === departamento);

    // Agregar las opciones al select
    filteredEmployees.forEach(employee => {
        const option = document.createElement('option');
        option.value = employee.cedula;
        option.textContent = `${employee.nombre} | ${employee.cedula}`;
        employeeSelect.appendChild(option);
    });

}

// Agregar tarea para un empleado

function addTaskForEmployee(modalId) {
    const modal = document.getElementById(modalId);
    const employeeSelect = modal.querySelector('.employee-select');
    const checkboxGroup = modal.querySelector('.checkbox-group');

    const selectedEmployeeName = employeeSelect.options[employeeSelect.selectedIndex].text;
    const selectedEmployeeCedula = employeeSelect.value;

    const [nombre] = selectedEmployeeName.split(' | ');

    if (!selectedEmployeeCedula) {
        alert('Selecciona un empleado válido.');
        return;
    }

    // Verificar si ya existe este empleado
    const existingEmployees = Array.from(checkboxGroup.querySelectorAll('input')).map(input => input.value);
    if (existingEmployees.includes(selectedEmployeeCedula)) {
        alert('Este empleado ya fue asignado.');
        return;
    }

    // Crear el contenedor del empleado asignado
    const forEmployeeTaskContainer = document.createElement('div');
    forEmployeeTaskContainer.className = 'checkbox-item';

    // Crear el contenedor para la foto y nombre
    const profileContainer = document.createElement('div');
    profileContainer.className = 'employee-profile';
    profileContainer.style.display = 'flex';
    profileContainer.style.alignItems = 'center';
    profileContainer.style.gap = '10px';

    // Foto de perfil
    const employeeSingleData = employeeData.find(employee => employee.cedula === selectedEmployeeCedula);
    const baseUrl = "<?php echo asset(''); ?>";
    const profileImageUrl = employeeSingleData?.profile_image
        ? `${baseUrl}${employeeSingleData.profile_image}`
        : `${baseUrl}img/default_profile_img.png`;

    const profileImage = document.createElement('img');
    profileImage.className = 'profile-image';
    profileImage.src = profileImageUrl;
    profileImage.alt = `${nombre} Foto de Perfil`;
    profileImage.style.width = '40px';
    profileImage.style.height = '40px';
    profileImage.style.borderRadius = '50%';

    // Nombre del empleado
    const employeeName = document.createElement('span');
    employeeName.textContent = nombre;
    employeeName.style.fontWeight = 'bold';

    // Input oculto para enviar al formulario
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'forEmployee[]';
    input.value = selectedEmployeeCedula;

    // Botón para eliminar
    const deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.textContent = 'Eliminar';
    deleteButton.className = 'delete-btn';

    deleteButton.addEventListener('click', () => {
        checkboxGroup.removeChild(forEmployeeTaskContainer);
    });

    // Agregar los elementos al contenedor principal
    profileContainer.appendChild(profileImage);
    profileContainer.appendChild(employeeName);

    forEmployeeTaskContainer.appendChild(profileContainer);
    forEmployeeTaskContainer.appendChild(input);
    forEmployeeTaskContainer.appendChild(deleteButton);

    checkboxGroup.appendChild(forEmployeeTaskContainer);
}

function initializeAssignedEmployees(modalId, assignedEmployees) {
    const modal = document.getElementById(modalId);
    const checkboxGroup = modal.querySelector('.checkbox-group');

    // Limpiar el grupo antes de inicializar
    checkboxGroup.innerHTML = '';
    console.log('initializeAssignedEmployees')

    assignedEmployees.forEach(employee => {
        // Simular la funcionalidad de addTaskForEmployee
        const employeeData2 = employeeData.find(e => e.cedula === employee.cedula);

        if (!employeeData2) {
            console.warn(`No se encontró información para el empleado con cédula: ${employee.cedula}`);
            return;
        }

        const employeeSelectOption = {
            text: `${employeeData2.nombre} | ${employee.cedula}`,
            value: employee.cedula
        };

        // Simula la selección y agrega el empleado
        simulateAddTaskForEmployee(modalId, employeeSelectOption);
    });
}


// Función para simular agregar empleados al checkbox
function simulateAddTaskForEmployee(modalId, employeeOption) {
    const modal = document.getElementById(modalId);
    const checkboxGroup = modal.querySelector('.checkbox-group');

    // Crear el contenedor del empleado asignado
    const forEmployeeTaskContainer = document.createElement('div');
    forEmployeeTaskContainer.className = 'checkbox-item';

    // Crear el contenedor para la foto y nombre
    const profileContainer = document.createElement('div');
    profileContainer.className = 'employee-profile';
    profileContainer.style.display = 'flex';
    profileContainer.style.alignItems = 'center';
    profileContainer.style.gap = '10px';

    // Foto de perfil
    const employeeSingleData = employeeData.find(employee => employee.cedula === employeeOption.value);
    const baseUrl = "<?php echo asset(''); ?>";
    const profileImageUrl = employeeSingleData?.profile_image
        ? `${baseUrl}${employeeSingleData.profile_image}`
        : `${baseUrl}img/default_profile_img.png`;

    const profileImage = document.createElement('img');
    profileImage.className = 'profile-image';
    profileImage.src = profileImageUrl;
    profileImage.alt = `${employeeOption.text.split(' | ')[0]} Foto de Perfil`;
    profileImage.style.width = '40px';
    profileImage.style.height = '40px';
    profileImage.style.borderRadius = '50%';

    // Nombre del empleado
    const employeeName = document.createElement('span');
    employeeName.textContent = employeeOption.text.split(' | ')[0];
    employeeName.style.fontWeight = 'bold';

    // Input oculto para enviar al formulario
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'forEmployee[]';
    input.value = employeeOption.value;

    // Botón para eliminar
    const deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.textContent = 'Eliminar';
    deleteButton.className = 'delete-btn';

    deleteButton.addEventListener('click', () => {
        checkboxGroup.removeChild(forEmployeeTaskContainer);
    });

    // Agregar los elementos al contenedor principal
    profileContainer.appendChild(profileImage);
    profileContainer.appendChild(employeeName);

    forEmployeeTaskContainer.appendChild(profileContainer);
    forEmployeeTaskContainer.appendChild(input);
    forEmployeeTaskContainer.appendChild(deleteButton);

    checkboxGroup.appendChild(forEmployeeTaskContainer);
}



            </script>
            