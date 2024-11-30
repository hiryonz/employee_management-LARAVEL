<div class="modal fade" id="pendingTaskModal" tabindex="-1" aria-labelledby="pendingTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="pendingTaskModalLabel">Tareas Pendientes para Hoy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Las siguientes tareas tienen fecha límite para hoy:</p>
                <ul id="pendingTaskList" class="list-group">
                    @foreach ($pendingTasks as $task)
                        <li class="list-group-item">
                            <strong>{{ $task['id'] }}</strong>: {{ $task['departamento'] }} - {{ $task['prioridad'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const showModal = @json($showModal); // Indica si el modal debe mostrarse

    if (showModal) {
        const pendingTaskModal = new bootstrap.Modal(document.getElementById('pendingTaskModal'));
        pendingTaskModal.show();
    }
});
</script>


