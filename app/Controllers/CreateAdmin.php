<?php
namespace App\Controllers;
use App\Models\UserModel;

class CreateAdmin extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Verificar si ya existe
        $user = $userModel->where('username', 'admin')->first();
        
        if (!$user) {
            // Crear usuario admin
            $userData = [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => '123456'
            ];
            $userModel->insert($userData);
            echo "✅ Usuario admin creado<br>";
        } else {
            echo "✅ Usuario admin ya existe<br>";
            echo "Contraseña actual: " . $user['password'] . "<br>";
        }
        
        echo "<a href='http://localhost/task-organizer/public/index.php/auth/login'>Ir al Login</a>";
    }
}
