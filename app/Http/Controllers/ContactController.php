<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => '',
            'correo' => 'required|email',
            'mensaje' => 'required|string',
            'g-recaptcha-response' => 'required',
        ]);

            // Verificar reCAPTCHA con Google usando la clave secreta de prueba
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
        'response' => $request->input('g-recaptcha-response'),
    ]);

    $responseBody = $response->json();

    if (!$responseBody['success']) {
        return redirect(route('home'))
            ->with('errors', 'Error en la verificación del captcha. Por favor, inténtalo de nuevo.');
    }

    
        try {
            $data = [
                'nombre' => $validated['nombre'],
                'celular' => $validated['celular'],
                'correo' => $validated['correo'],
                'mensaje' => $validated['mensaje'],
            ];
    
            Mail::send('emails.contacto', $data, function ($message) {
                $message->to('eldegorronegro@gmail.com') // Cambia esto al correo real de los administradores
                    ->subject('Nuevo mensaje desde el formulario de contacto');
            });
    
            return redirect(route('home'))
                ->with('success', 'Mensaje enviado exitosamente.');
        } catch (\Exception $e) {
            return redirect(route('home'))
                ->with('error', 'Hubo un problema al enviar tu mensaje. Por favor, inténtalo de nuevo.');
        }
    }
}