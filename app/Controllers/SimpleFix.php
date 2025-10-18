<?php
namespace App\Controllers;

use App\Models\UserModel;

class SimpleFix extends BaseController
{
    public function index()
    {
        try {
            echo "<h3>Reparando contraseña...</h3>";
            
            $userModel = new UserModel();
            $user = $userModel->where('username', 'admin')->first();
            
            if (!$user) {
                echo "❌ No se encontró usuario admin";
                return;
            }
            
            echo "✅ Usuario admin encontrado<br>";
            echo "ID: " . $user['id'] . "<br>";
            echo "Contraseña actual: " . $user['password'] . "<br><br>";
            
            // Crear nuevo hash para 123456
            $newPassword = password_hash('123456', PASSWORD_DEFAULT);
            
            // Actualizar directamente
            $userModel->update($user['id'], ['password' => $newPassword]);
            
            echo "✅ Contraseña actualizada<br>";
            echo "Nuevo hash: " . $newPassword . "<br><br>";
            
            // Verificar
            $updatedUser = $userModel->find($user['id']);
            $check = password_verify('123456', $updatedUser['password']);
            
            echo "Verificación: " . ($check ? '✅ OK' : '❌ Falló') . "<br><br>";
            echo "🎉 ¡Listo! Prueba el login con admin/123456<br>";
            echo "<a href='" . base_url('auth/login') . "'>Ir al Login</a>";
            
        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage() . "<br>";
            echo "En: " . $e->getFile() . " línea " . $e->getLine();
        }
    }
}
