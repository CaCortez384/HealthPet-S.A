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

    
        // Verificar si el usuario ya existe
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('success', 'El email ya está registrado en el sistema.');
        
            
        }else{
                    // Validar los datos
            // Validar los datos con mensajes personalizados
    $request->validate([
        'name' => 'required|string|max:50',
        'email' => 'required|string|email|max:50|unique:users,email', // Añade unique para validar que no esté registrado
        'password' => 'required|string|min:4',
    ], [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El nombre no puede tener más de 50 caracteres.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
        'email.max' => 'El correo electrónico no puede tener más de 50 caracteres.',
        'email.unique' => 'El correo electrónico ya está registrado en el sistema.', // Mensaje personalizado para el campo email
        'password.required' => 'El campo contraseña es obligatorio.',
        'password.min' => 'La contraseña debe tener al menos 4 caracteres.',
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
