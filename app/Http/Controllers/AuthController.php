<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function registerForm()
    {
        return view('auth.register');
    }

    // Registrar usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:administrador,personal',

            // Solo se validan si es personal
            'cargo' => 'nullable|string|',
            'turno' => 'nullable|string|',
        ]);

        // Datos base
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Si es personal, agregar campos extra
        if ($request->role === 'personal') {
            $data['cargo'] = $request->cargo;
            $data['turno'] = $request->turno;
        }

        // Crear usuario
        $user = User::create($data);

        // Login automático
        Auth::login($user);

        return redirect()->route('libros.index');
    }

    // Mostrar login
    public function loginForm()
    {
        return view('auth.login');
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('libros.index');
        }

        return back()->withErrors([
            'email' => 'Datos incorrectos',
        ])->onlyInput('email');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/acceso');
    }
}