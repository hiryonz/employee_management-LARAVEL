 <!-- Modal para el historial de descuentos -->
 <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="historialLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateProfileImageModalLabel">Historial de descuentos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="filterForm">
                                    <div class="form-group">
                                        <label for="startDate">Fecha de inicio</label>
                                        <input type="date" id="startDate" name="startDate" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="endDate">Fecha de fin</label>
                                        <input type="date" id="endDate" name="endDate" class="form-control">
                                    </div>
                                    <button type="button" onclick="filterByDate()" class="btn btn-primary">Filtrar</button>
                                    <button type="button" onclick="filterByDate('all')" class="btn btn-primary ml-2">mostrar todo</button>
                                </form>
                                <div class="tables mt-2" id="table-container">
                                    <div class="table-responsive">
                                        <x-tables-layout path="none" name="descuento" :descuentoFalta="$descuentoFalta"></x-tables-layout>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                            </div>
                    </div>
                </div>
            </div>