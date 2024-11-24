 <!-- Modal para actualizar la imagen -->
 <div class="modal fade" id="updateProfileImageModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileImageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('updateImg.post', $employeeData->cedula) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateProfileImageModalLabel">Actualizar Foto de Perfil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="profile_image">Selecciona una imagen:</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Actualizar Imagen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
