<script>
        document.addEventListener('DOMContentLoaded', ()=> {
            if(document.querySelector('.formulario-container-employee')) {
                initializePlanillaCalculators(document.querySelector('.formulario-container-employee'))
            }
        })

        function limpiarFormulario(event) {
            const form = event.target.closest('form')
            form.reset();
            window.scrollTo({top:0, behavior: 'smooth'})
        } 


        function activarPasword(event) {
            const form = event.target.closest('form')
            const password = form.querySelector('#password')

            if(password.type == 'password') {
                password.type = 'text'
            }else {
                password.type = 'password'
            }
        }
    </script>