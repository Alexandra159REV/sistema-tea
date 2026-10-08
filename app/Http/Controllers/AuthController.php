<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Procesa el inicio de sesión único del sistema.
     */
    public function login(Request $request)
    {
        // 1. Validar estrictamente los tres datos del formulario
        $request->validate([
            'name'     => 'required|string',
            'identity' => 'required|string',
            'password' => 'required|string',
            'rol'      => 'required|string'
        ]);

        $name     = $request->input('name');
        $identity = $request->input('identity');
        $password = $request->input('password');
        $rol      = $request->input('rol'); 

        // 2. Buscar al usuario combinando Nombre y Correo directamente en la tabla 'users'
        $user = DB::table('users')
            ->where('name', $name)
            ->where('email', $identity)
            ->first();

        // 3. Validar coincidencia de credenciales y contraseña
        if ($user && $user->password === $password) {
            
            // Loguear al usuario en el sistema usando su ID único
            Auth::loginUsingId($user->id);

            // Almacenar las variables de autenticación en la sesión global
            session([
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role
            ]);

            // ¡Redirección exitosa hacia el Dashboard!
            return redirect()->route('dashboard');
        }

        // 4. Retorno con mensaje de error controlado si falla
        return back()->withErrors([
            'identity' => 'Los datos ingresados no coinciden con nuestros registros del sistema.',
        ])->onlyInput('name', 'identity', 'rol');
    }

    /**
     * Cierra la sesión del usuario de forma segura.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}