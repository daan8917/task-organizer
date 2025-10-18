<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="h4 mb-0">Editar Tarea</h2>
            </div>
            <div class="card-body">
                <form action="<?= base_url('index.php/tasks/edit/' . $task['id']) ?>" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título *</label>
                        <input type="text" class="form-control" id="title" name="title" required 
                               value="<?= old('title', $task['title']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $task['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Estado *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pendiente" <?= old('status', $task['status']) === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="en_progreso" <?= old('status', $task['status']) === 'en_progreso' ? 'selected' : '' ?>>En Progreso</option>
                            <option value="completada" <?= old('status', $task['status']) === 'completada' ? 'selected' : '' ?>>Completada</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" 
                               value="<?= old('due_date', $task['due_date']) ?>">
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('index.php/tasks') ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
