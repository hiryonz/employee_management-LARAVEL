<script>

        function validacionLetras(event) {
            const char = String.fromCharCode(event.which);
            // Verifica si el carácter es una letra (a-z o A-Z)
            if (!/[a-zA-Z]/.test(char)) {
                event.preventDefault(); // Evita la entrada del carácter
            }
        }

        function validacionNumeros(event) {
            const char = String.fromCharCode(event.which);

            // Verifica si el carácter es un número (0-9)
            if (!/[0-9]/.test(char)) {
                event.preventDefault(); // Evita la entrada del carácter
            }
        }


        function validacionNumerosPlanilla(event) {
            const char = String.fromCharCode(event.which);

            // Obtener el valor actual del input
            const inputValue = event.target.value;

            // Permitir solo números y el punto
            if (!/[0-9.]/.test(char)) {
                event.preventDefault(); // Evita la entrada del carácter
                return;
            }

            // Permitir solo un punto
            if (char === '.' && inputValue.includes('.')) {
                event.preventDefault(); // Evita más de un punto
                return;
            }


        }

        function redondearInput(event) {
            const value = parseFloat(event.target.value);
            if (!isNaN(value)) {
                event.target.value = value.toFixed(2); // Redondea a dos decimales
            }
        }

        function validacionCedula(event) {
            const char = String.fromCharCode(event.which);

            // Verifica si el carácter es un número (0-9)
            if (!/[0-9-]/.test(char)) {
                event.preventDefault(); // Evita la entrada del carácter
            }
        }

        function formatear(event) {
            const regex = /^\d{1,3}-\d{3}-\d{3,4}$/; // Expresión regular para validar el formato 8-888-8888

            if(event.target.value == '') {
                return
            }

            if (!regex.test(event.target.value)) {
                alert("Por favor, introduce el formato correcto: x-x-xxxx");
                event.target.value = ''
            }
        }

</script>