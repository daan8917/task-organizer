<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="h4 mb-0">Detalles de la Tarea</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Título:</strong>
                    <p class="fs-5"><?= esc($task['title']) ?></p>
                </div>

                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <p><?= esc($task['description']) ?: 'Sin descripción' ?></p>
                </div>

                <div class="mb-3">
                    <strong>Estado:</strong>
                    <span class="badge 
                        <?= $task['status'] === 'completada' ? 'bg-success' : 
                           ($task['status'] === 'en_progreso' ? 'bg-warning' : 'bg-danger') ?>">
                        <?= ucfirst(str_replace('_', ' ', $task['status'])) ?>
                    </span>
                </div>

                <?php if ($task['due_date']): ?>
                <div class="mb-3">
                    <strong>Fecha de Vencimiento:</strong>
                    <p><?= date('d/m/Y', strtotime($task['due_date'])) ?></p>
                </div>
                <?php endif; ?>

                <div class="mb-3">
                    <strong>Creado:</strong>
                    <p><?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></p>
                </div>

                <div class="mb-3">
                    <strong>Actualizado:</strong>
                    <p><?= date('d/m/Y H:i', strtotime($task['updated_at'])) ?></p>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= base_url('index.php/tasks') ?>" class="btn btn-secondary me-md-2">Volver</a>
                    <a href="<?= base_url('index.php/tasks/edit/' . $task['id']) ?>" class="btn btn-warning me-md-2">Editar</a>
                    <a href="<?= base_url('index.php/tasks/delete/' . $task['id']) ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
