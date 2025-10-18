<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (!empty($_POST)) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->userModel->getUserByUsername($username);

            if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                // Crear sesión
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'logged_in' => true
                ]);

                // Redirigir a tareas
                echo "<script>window.location.href = 'http://localhost/task-organizer/public/index.php/tasks';</script>";
                exit;
            } else {
                echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos</div>";
            }
        }

        // Mostrar formulario de login
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Login</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='container mt-5'>
                <div class='row justify-content-center'>
                    <div class='col-md-4'>
                        <div class='card'>
                            <div class='card-header'>
                                <h4>Iniciar Sesión</h4>
                            </div>
                            <div class='card-body'>
                                <form action='http://localhost/task-organizer/public/index.php/auth/login' method='post'>
                                    <div class='mb-3'>
                                        <label>Usuario:</label>
                                        <input type='text' name='username' class='form-control' value='admin' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label>Contraseña:</label>
                                        <input type='password' name='password' class='form-control' value='123456' required>
                                    </div>
                                    <button type='submit' class='btn btn-primary w-100'>Entrar</button>
                                </form>
                                <div class='mt-3 text-center'>
                                    <small>Usuario: admin / Contraseña: 123456</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    }

    public function logout()
    {
        session()->destroy();
        echo "<script>window.location.href = 'http://localhost/task-organizer/public/index.php/auth/login';</script>";
        exit;
    }
}
