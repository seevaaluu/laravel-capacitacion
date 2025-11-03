<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',  // Nombre: obligatorio, texto, máx 255 caracteres
            'email' => 'required|string|email|max:255|unique:users',  // Email: obligatorio, formato email, único en tabla users
            'password' => 'required|string|min:8|confirmed',  // Password: obligatorio, mínimo 8 caracteres, debe coincidir con password_confirmation
        ]);

        $user = User::create([
            'name' => $request->name,  // Toma el nombre del request
            'email' => $request->email,  // Toma el email del request
            'password' => Hash::make($request->password),  // Encripta la contraseña (NUNCA guardes passwords en texto plano)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'user' => $user,
            'access_token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',  // Email: obligatorio, formato email
            'password' => 'required|string',  // Password: obligatorio
        ]);

        $user = User::where('email', $request->email)->first();

        //if (!$user || !Hash::check($request->password, $user->password)) {
        //    // !$user - el usuario no existe
        //    // !Hash::check(...) - la contraseña no coincide
        //    // Hash::check() compara la contraseña ingresada con la encriptada en la BD

        //    throw \ValidationException::withMessages([
        //        'email' => ['Las credenciales son incorrectas.'],
        //    ]);
        //}

        
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password], false)) {

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }


        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function authenticated_user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
