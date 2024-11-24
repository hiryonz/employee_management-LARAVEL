            
            <!-- es necesario el tipo de filtro -->
            
            <!-- Modal de Actualización -->
            @foreach (['departamento', 'fecha', 'prioridad'] as $type)
                <div class="modal fade" id="filter-{{$type}}" tabindex="-1" role="dialog" aria-labelledby="{{$type}}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="{{$type}}Label">Filtrar por {{$type}}</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($type === 'departamento')
                                    <select class="form-control" id="filter-departamento-input" name="filter-departamento-input">
                                        <option value="all">Mostrar Todos</option>
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
                                    @elseif ($type === 'fecha')
                                        <input type="date" id="filter-fecha-input" class="form-control">
                                        <div class="mt-2">
                                            <button type="button" id="filter-fecha-all" class="btn btn-secondary" data-bs-dismiss="modal">Mostrar Todo</button>
                                        </div>
                                    @elseif ($type === 'prioridad')
                                        <select id="filter-prioridad-input" class="form-control">
                                            <option value="all">Mostrar Todo</option>
                                            <option value="alta">Alta</option>
                                            <option value="media">Media</option>
                                            <option value="baja">Baja</option>
                                        </select>
                                    @endif

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="apply-filter-{{$type}}" >Aplicar Filtro</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
