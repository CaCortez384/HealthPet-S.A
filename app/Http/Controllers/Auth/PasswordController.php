<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Cache;


class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Obtener el usuario autenticado
        $user = $request->user();
    
        // Verificar si el usuario tiene un cooldown activo para cambiar la contraseña
        $cacheKey = "password_update_{$user->id}";
        if (Cache::has($cacheKey)) {
            $remainingTime = Cache::get($cacheKey) - now()->timestamp;
            return redirect()->route('profile.edit')->withErrors([
                'cooldown' => "Debes esperar $remainingTime segundos antes de actualizar tu contraseña nuevamente."
            ]);
        }
    
        // Validar los datos de entrada
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);
    
        // Actualizar la contraseña del usuario
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);
    
        // Establecer un cooldown de 2 minutos (120 segundos)
        Cache::put($cacheKey, now()->addMinutes(2)->timestamp, 120);
    
        return redirect()->route('profile.edit')->with('success', 'Contraseña actualizada correctamente.');
    }
    
}
