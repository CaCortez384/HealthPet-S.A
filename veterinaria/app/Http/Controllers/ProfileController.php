<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Obtener el usuario autenticado
        $user = $request->user();
    
        // Verificar si el usuario tiene un cooldown activo
        $cacheKey = "user_update_{$user->id}";
        if (Cache::has($cacheKey)) {
            $remainingTime = Cache::get($cacheKey) - now()->timestamp;
            return redirect()->route('profile.edit')->withErrors([
                'cooldown' => "Debes esperar $remainingTime segundos antes de actualizar nuevamente."
            ]);
        }
    
        // Llenar los datos validados en el modelo del usuario
        $user->fill($request->validated());
    
        // Si el correo cambia, anular la verificación del correo
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        // Guardar los cambios del usuario
        $user->save();
    
        // Establecer un cooldown de 2 minutos (120 segundos)
        Cache::put($cacheKey, now()->addMinutes(2)->timestamp, 120);
    
        return redirect()->route('profile.edit')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function pedidos()
    {
        return view('profile.mis-pedidos');
    }
}
