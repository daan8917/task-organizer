<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Lista de Tareas</h1>
            <a href="<?= base_url('index.php/tasks/create') ?>" class="btn btn-primary">➕ Nueva Tarea</a>
        </div>

        <!-- Buscador -->
        <form action="<?= base_url('index.php/tasks/search') ?>" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar tareas..." 
                       value="<?= $searchTerm ?? '' ?>">
                <button class="btn btn-outline-secondary" type="submit">🔍 Buscar</button>
            </div>
        </form>

        <?php if (empty($tasks)): ?>
            <div class="alert alert-info">
                No hay tareas registradas. <a href="<?= base_url('index.php/tasks/create') ?>">¡Crea la primera!</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($tasks as $task): ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card task-card status-<?= $task['status'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($task['title']) ?></h5>
                                <p class="card-text"><?= esc($task['description']) ?: 'Sin descripción' ?></p>
                                
                                <div class="mb-2">
                                    <span class="badge 
                                        <?= $task['status'] === 'completada' ? 'bg-success' : 
                                           ($task['status'] === 'en_progreso' ? 'bg-warning' : 'bg-danger') ?>">
                                        <?= ucfirst(str_replace('_', ' ', $task['status'])) ?>
                                    </span>
                                </div>

                                <?php if ($task['due_date']): ?>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            📅 Vence: <?= date('d/m/Y', strtotime($task['due_date'])) ?>
                                        </small>
                                    </p>
                                <?php endif; ?>

                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('index.php/tasks/view/' . $task['id']) ?>" class="btn btn-outline-info">👁️ Ver</a>
                                    <a href="<?= base_url('index.php/tasks/edit/' . $task['id']) ?>" class="btn btn-outline-warning">✏️ Editar</a>
                                    <a href="<?= base_url('index.php/tasks/delete/' . $task['id']) ?>" 
                                       class="btn btn-outline-danger" 
                                       onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">🗑️ Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
