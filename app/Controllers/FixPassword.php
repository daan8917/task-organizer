<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Database\BaseConnection;

class FixPassword extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $db = db_connect();
        
        echo "<h3>🔧 Reparando Sistema de Contraseñas</h3>";
        
        // 1. Buscar usuario admin
        $user = $userModel->where('username', 'admin')->first();
        
        if (!$user) {
            echo "❌ ERROR: No se encontró el usuario 'admin'<br>";
            return;
        }
        
        echo "✅ Usuario encontrado: " . $user['username'] . "<br>";
        echo "🔑 Contraseña actual en BD: " . $user['password'] . "<br>";
        echo "📏 Longitud: " . strlen($user['password']) . " caracteres<br><br>";
        
        // 2. Verificar el estado actual
        echo "<h4>Pruebas de verificación:</h4>";
        
        // Prueba con password_verify
        $test1 = password_verify('123456', $user['password']);
        echo "password_verify('123456', BD): " . ($test1 ? '✅ TRUE' : '❌ FALSE') . "<br>";
        
        // Prueba con comparación directa (texto plano)
        $test2 = ('123456' === $user['password']);
        echo "Comparación texto plano ('123456' === BD): " . ($test2 ? '✅ TRUE' : '❌ FALSE') . "<br><br>";
        
        // 3. Crear nuevo hash
        $newHashedPassword = password_hash('123456', PASSWORD_DEFAULT);
        echo "🆕 Nuevo hash para '123456':<br>";
        echo "<code>" . $newHashedPassword . "</code><br>";
        echo "📏 Longitud del hash: " . strlen($newHashedPassword) . " caracteres<br><br>";
        
        // 4. Verificar que el nuevo hash funciona
        $verifyTest = password_verify('123456', $newHashedPassword);
        echo "Prueba del nuevo hash - password_verify('123456', nuevo_hash): " . 
             ($verifyTest ? '✅ TRUE' : '❌ FALSE') . "<br><br>";
        
        // 5. Actualizar en la base de datos
        echo "<h4>Actualizando base de datos...</h4>";
        $result = $userModel->update($user['id'], ['password' => $newHashedPassword]);
        
        if ($result) {
            echo "✅ Contraseña actualizada en la BD<br><br>";
            
            // 6. Verificar que ahora funciona
            $updatedUser = $userModel->find($user['id']);
            $finalTest = password_verify('123456', $updatedUser['password']);
            
            echo "<h4>✅ Verificación final:</h4>";
            echo "password_verify('123456', BD_actualizada): " . 
                 ($finalTest ? '✅ TRUE - ¡FUNCIONA!' : '❌ FALSE - Algo salió mal') . "<br><br>";
            
            echo "🎉 <strong>¡Sistema reparado!</strong><br>";
            echo "Ahora puedes iniciar sesión con:<br>";
            echo "👤 Usuario: <strong>admin</strong><br>";
            echo "🔑 Contraseña: <strong>123456</strong><br><br>";
            
            echo "<a href='" . base_url('auth/login') . "' style='
                background: #007bff; 
                color: white; 
                padding: 10px 20px; 
                text-decoration: none; 
                border-radius: 5px;
                display: inline-block;
            '>🚀 Probar Login Ahora</a>";
            
        } else {
            echo "❌ Error al actualizar la contraseña en la BD<br>";
            echo "Intenta ejecutar este comando manualmente en MySQL:<br>";
            echo "<code>UPDATE users SET password = '" . $newHashedPassword . "' WHERE username = 'admin';</code>";
        }
    }
    
    public function testLogin()
    {
        // Script para probar el login directamente
        $userModel = new UserModel();
        $user = $userModel->where('username', 'admin')->first();
        
        echo "<h3>🧪 Test de Login Directo</h3>";
        echo "Usuario: admin<br>";
        echo "Contraseña en BD: " . $user['password'] . "<br><br>";
        
        $testPasswords = ['123456', 'password', 'admin'];
        
        foreach ($testPasswords as $pwd) {
            $result = password_verify($pwd, $user['password']);
            echo "password_verify('" . $pwd . "', BD): " . ($result ? '✅ TRUE' : '❌ FALSE') . "<br>";
        }
    }
}
