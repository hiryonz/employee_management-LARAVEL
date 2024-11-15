            
            <!-- es necesario la variable employeeData -->
            
            <!-- Modal de Actualización -->
            <div class="modal fade" id="Actualizar" tabindex="-1" role="dialog" aria-labelledby="ActualizarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content custom-modal-width">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ActualizarLabel">Actualizar Datos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php $route = route('updateEmployee.post', ['id' => $employeeData->cedula]); ?>

                        <form class="submain-data" action="{{ $route }}" method="post">
                            <div class="modal-body">
                                <x-employee-data-detailed 
                                    :route="$route"
                                    :employeeData="$employeeData"
                                    :direcionData="$direcionData"
                                    :planillaData="$planillaData"
                                    :userData="$userData"
                                    :faltas="$faltas"/>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>