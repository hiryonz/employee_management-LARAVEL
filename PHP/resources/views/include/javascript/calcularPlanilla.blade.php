<script>

//recibe el contenedor padre en donde se quiere realizar el calculo
function initializePlanillaCalculators(form) {
            const 
                hora_trabajada = form.querySelector('.hora_trabajada')
                salarioHora = form.querySelector(".sal_hora"),
                salarioBruto = form.querySelector(".salario_bruto"),
                seguroSocial = form.querySelector(".seguro_social"),
                seguroEducativo = form.querySelector(".seguro_educativo"),
                ir = form.querySelector(".ir"),
                descuento = form.querySelector(".descuento"),
                deducciones = form.querySelector(".deducciones"),
                salarioNeto = form.querySelector(".salario_neto");
                

            hora_trabajada.addEventListener('input', calcularPlanilla);
            salarioHora.addEventListener("input", calcularPlanilla);
            descuento.addEventListener("input", calcularPlanilla);
           
             calcularPlanilla();
           

            function calcularPlanilla() {
                let horaTrabajadaValor = parseInt(hora_trabajada.value || 205);
                let salarioHoraValor = Math.round((parseFloat(salarioHora.value) || 0) * 100) / 100;
                let descuento1Valor = Math.round((parseFloat(descuento.value) || 0) * 100) / 100;
               


                salarioBruto.value = (horaTrabajadaValor * salarioHoraValor).toFixed(2);
                seguroSocial.value = (salarioBruto.value * 0.0975).toFixed(2);
                seguroEducativo.value = (salarioBruto.value * 0.0125).toFixed(2);

                // Calcular impuesto sobre la renta
                let salarioAnual = ((salarioBruto.value || 0) * 13).toFixed(2);
                let impuesto = 0;
                if (salarioAnual > 11000 && salarioAnual < 50000) {
                    impuesto = ((salarioAnual - 11000) * 0.15) / 13;
                } else if (salarioAnual > 50000) {
                    impuesto = ((50000 - 11000) * 0.15) / 13;
                    impuesto += ((salarioAnual - 50000) * 0.25) / 13;
                }

                ir.value = impuesto.toFixed(2);

                deducciones.value = parseFloat(
                    parseFloat(seguroSocial.value) + 
                    parseFloat(seguroEducativo.value) + 
                    parseFloat(ir.value) + 
                    parseFloat(descuento1Valor) 
                ).toFixed(2);

                salarioNeto.value = ((salarioBruto.value || 0) - (deducciones.value || 0)).toFixed(2);
            }   

        }

</script>