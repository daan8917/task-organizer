<?php
namespace App\Controllers;

use App\Models\UserModel;

class UpdatePassword extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Actualizar la contraseña del admin con hash
        $hashedPassword = password_hash('123456', PASSWORD_DEFAULT);
        $result = $userModel->where('username', 'admin')->set(['password' => $hashedPassword])->update();
        
        if ($result) {
            echo "✅ Contraseña del admin actualizada correctamente con hash<br>";
            echo "Nuevo hash: " . $hashedPassword . "<br><br>";
            echo "Ahora puedes: <br>";
            echo "1. Iniciar sesión con admin/123456<br>";
            echo "2. Probar el cambio de contraseña<br>";
            echo "<a href='" . base_url('auth/login') . "'>Ir al Login</a>";
        } else {
            echo "❌ Error al actualizar la contraseña";
        }
    }
}
