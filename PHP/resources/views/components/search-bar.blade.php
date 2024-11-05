@props(['employeeData', 'name'])




<div class="search-box">
    <button class="btn-search"><i class="fas fa-search"></i></button>
    <input type="text" class="input-search" id="searchInput" placeholder="Escriba el Nombre o Cedula para buscar...">
    <div id="results">
    </div>
</div>

<hr style="margin-bottom: 0">


<script>
    const searchInput = document.getElementById('searchInput');
    const resultsContainer = document.getElementById('results');
    const searchBtn = document.querySelector('.btn-search')

    // Evitar que el input pierda el foco al hacer clic dentro del div de resultados
    resultsContainer.addEventListener('mousedown', function(event) {
        event.preventDefault(); // Evita que el input pierda el foco
    });

    const data = <?php
        for ($i = 0; $i<= count($employeeData)-1; $i++){
            $employee[] = [
                'cedula' => $employeeData[$i]['cedula'],
                'nombre' => $employeeData[$i]['nombre']
            ];
        }
        echo json_encode($employee)
    ?>;

    searchInput.addEventListener('click', searchBar);
    searchInput.addEventListener('input', searchBar);
    searchBtn.addEventListener('click', searchBar);
    document.addEventListener('DOMContentLoaded', searchBar);

    function searchBar() {
        const query = searchInput.value.toLowerCase();
        resultsContainer.innerHTML = ''; // Limpiar resultados anteriores

        // Filtrar datos
        const filteredData = data.filter(item => 
            item.nombre.toLowerCase().includes(query) || 
            item.cedula.includes(query)
        );

        // Mostrar resultados filtrados
        if(filteredData.length === 0) {
            const resultItem = document.createElement('div');
            resultItem.textContent = 'No se encontraron resultados';
            resultsContainer.appendChild(resultItem);
            return;
        }

        filteredData.forEach(item => {
            const resultItem = document.createElement('div');
            const name = document.createElement('p');
            const id = document.createElement('p');

            resultItem.appendChild(name)
            resultItem.appendChild(id)

            resultItem.classList.add("listResult")
            resultItem.id = item.cedula
            resultItem.addEventListener('click', () => {
                findEmployee(item.cedula)
            })

            name.textContent = `nombre: ${item.nombre}`
            id.textContent = `cedula: ${item.cedula}`
            resultsContainer.appendChild(resultItem);
        });

        
    }




</script>



