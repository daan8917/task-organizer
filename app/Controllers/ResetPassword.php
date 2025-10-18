<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Database\BaseConnection;

class ResetPassword extends BaseController
{
    public function index()
    {
        echo "<h3>🔄 Reset Completo de Contraseña</h3>";
        
        try {
            $db = db_connect();
            $userModel = new UserModel();
            
            // 1. Buscar o crear usuario admin
            $user = $userModel->where('username', 'admin')->first();
            
            if (!$user) {
                echo "❌ Usuario admin no existe. Creándolo...<br>";
                $userData = [
                    'username' => 'admin',
                    'email' => 'admin@example.com',
                    'password' => password_hash('123456', PASSWORD_DEFAULT)
                ];
                $userModel->insert($userData);
                echo "✅ Usuario admin creado<br>";
            } else {
                echo "✅ Usuario admin encontrado<br>";
            }
            
            // 2. Resetear contraseña a '123456' con hash
            $newHash = password_hash('123456', PASSWORD_DEFAULT);
            $userModel->where('username', 'admin')->set(['password' => $newHash])->update();
            
            echo "✅ Contraseña reseteada a: 123456<br>";
            echo "Nuevo hash: $newHash<br><br>";
            
            // 3. Verificar
            $updatedUser = $userModel->where('username', 'admin')->first();
            $check = password_verify('123456', $updatedUser['password']);
            
            echo "Verificación final: " . ($check ? '✅ ÉXITO' : '❌ FALLÓ') . "<br><br>";
            
            echo "🎉 <strong>¡Reset completado!</strong><br>";
            echo "Ahora puedes iniciar sesión con:<br>";
            echo "👤 Usuario: <strong>admin</strong><br>";
            echo "🔑 Contraseña: <strong>123456</strong><br><br>";
            
            echo "<a href='" . base_url('auth/login') . "' style='
                background: #28a745; color: white; padding: 10px 20px; 
                text-decoration: none; border-radius: 5px; display: inline-block;
            '>🚀 Probar Login</a>";
            
        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
}

