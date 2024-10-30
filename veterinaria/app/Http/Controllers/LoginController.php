<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller


{

    public function loguearse(){
        return view('login.login');
    }

    public function register(Request $request)
    {


        // Verificar si el usuario ya existe
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('success', 'El email ya está registrado en el sistema.');
        } else {
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


    public function registerAdmin(Request $request)
    {


        // Verificar si el usuario ya existe
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('success', 'El email ya está registrado en el sistema.');
        } else {
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
        $user->role = 'admin';
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('listar.usuarios'))->with('success', 'Registro exitoso. Nuevo administrador registrado.');
    }

public function login(Request $request)
{
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

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar el rol del usuario y redirigir según el rol
        if ($user->role === 'admin' || $user->role === 'editor') {
            // Redirigir a la página establecida
            return redirect()->intended(route('inicio'));
        } elseif ($user->role === 'user') {
            // Redirigir al index de la web para usuarios tipo 'user'
            return redirect()->route('home');
        }
    } else {
        // Redirige de nuevo al login en caso de fallo, puedes agregar un mensaje de error
        return redirect(route('login'))->with('success', 'Usuario o Contraseña incorrecto.');
    }
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function listarUsuarios(Request $request)
    {
        $filtros = [
            'nombre' => $request->input('nombre', ''), // Cambia a 'nombre'
            'correo' => $request->input('correo', ''),
            'role' => $request->input('role', ''),
        ];

        // Filtrar usuarios según los valores de los filtros
        $usuarios = User::query();

        if ($filtros['nombre']) { // Cambiar a 'nombre'
            $usuarios->where('name', 'like', '%' . $filtros['nombre'] . '%'); // Cambiar a 'nombre'
        }

        if ($filtros['correo']) {
            $usuarios->where('email', 'like', '%' . $filtros['correo'] . '%');
        }

        if ($filtros['role']) {
            $usuarios->where('role', $filtros['role']);
        }

        $usuarios = $usuarios->paginate(10);

        return view('login.listado', compact('usuarios', 'filtros'));
    }

    public function destroy($id)
    {
        // Buscar el usuario por id y eliminarlo


        $user = User::find($id);
        if ($user === null) {
            return redirect()->route('listar.usuarios')->with('error', 'Usuario no encontrado.');
        }
        $user->delete();
        return redirect()->route('listar.usuarios')->with('success', 'Usuario eliminado correctamente');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:4|confirmed',
            'role' => 'required|in:admin,user', // Define los roles que aceptas
        ]);

        // Obtener el usuario
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->name = ucwords(strtolower($request->name)); // Capitalizar nombre
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Encriptar la contraseña
        }
        $user->role = $request->role;

        // Guardar los cambios
        $user->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('listar.usuarios', $user->id)->with('success', 'Usuario actualizado correctamente');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('login.edit', compact('user'));
    }
}
