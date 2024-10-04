<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function register(Request $request) {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4', // Cambié a 4 para que cumpla tu requerimiento
        ]);
    
        // Verificar si el usuario ya existe
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors([
                'email' => 'El email ya está registrado en el sistema.'
            ]);
        }
    
        // Crear un nuevo usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect(route('login'))->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
    
    public function login(Request $request) {
        // Validaciones
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:1',
        ]);
    
        // Define las credenciales de autenticación
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];
    
        // Verifica si el checkbox 'remember' está marcado
        $remember = $request->has('remember') ? true : false;
    
        // Intentar autenticar al usuario con las credenciales y el valor de 'remember'
        if (Auth::attempt($credentials, $remember)) {
            // Regenera la sesión para proteger contra ataques de fijación de sesión
            $request->session()->regenerate();
    
            // Redirige al usuario a la página de inicio o a la página que intentaba acceder
            return redirect()->intended(route('inicio'));

        } else {
            // Redirige de nuevo al login en caso de fallo, puedes agregar un mensaje de error
            return redirect('login')->with('success', 'Usuario o Contraseña incorrecto.');
            
          
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
