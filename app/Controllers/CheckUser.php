<?php
namespace App\Controllers;

use App\Models\UserModel;

class CheckUser extends BaseController
{
    public function index()
    {
        echo "<h3>Verificando usuario admin...</h3>";
        
        $userModel = new UserModel();
        $user = $userModel->where('username', 'admin')->first();
        
        if ($user) {
            echo "✅ Usuario encontrado:<br>";
            echo "ID: " . $user['id'] . "<br>";
            echo "Username: " . $user['username'] . "<br>";
            echo "Password en BD: <strong>" . $user['password'] . "</strong><br>";
            echo "Longitud: " . strlen($user['password']) . " caracteres<br><br>";
            
            echo "<h4>Pruebas de contraseña:</h4>";
            $testPasswords = ['123456', 'password', 'admin'];
            
            foreach ($testPasswords as $pwd) {
                $result = $userModel->verifyPassword($pwd, $user['password']);
                echo "verifyPassword('$pwd', BD): " . ($result ? '✅ TRUE' : '❌ FALSE') . "<br>";
            }
        } else {
            echo "❌ Usuario admin no encontrado";
        }
    }
}

