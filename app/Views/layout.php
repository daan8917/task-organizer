<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Organizador de Tareas' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task-card { transition: transform 0.2s; }
        .task-card:hover { transform: translateY(-2px); }
        .status-pendiente { border-left: 4px solid #dc3545; }
        .status-en_progreso { border-left: 4px solid #ffc107; }
        .status-completada { border-left: 4px solid #198754; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('index.php/tasks') ?>">📝 Organizador de Tareas</a>
<div class="navbar-nav ms-auto">
    <?php if (session()->has('logged_in') && session('logged_in')): ?>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Hola, <?= session('username') ?>
            </a>
            <ul class="dropdown-menu">
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="http://localhost/task-organizer/public/index.php/auth/logout">Cerrar Sesión</a></li>
            </ul>
        </div>
    <?php else: ?>
        <a class="nav-link" href="http://localhost/task-organizer/public/index.php/auth/login">Iniciar Sesión</a>
    <?php endif; ?>
</div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
