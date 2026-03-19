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
            'phone' => 'required',
            'edad' => 'required',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:cliente,personal,administrador',

            'cargo' => 'nullable|string|',
            'turno' => 'nullable|string|in:matutino,vespertino,nocturno',
        ]);

        $role = $request->role;

        // Datos base
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'edad' => $request->edad,
            'password' => Hash::make($request->password),
            'role' => $role,
            'cargo' => $role === 'personal' ? ($request->cargo ?? '') : '',
            'turno' => $role === 'personal' ? ($request->turno ?? '') : '',
        ];

<<<<<<< HEAD
    
        if ($request->role === 'personal') {
            $data['cargo'] = $request->cargo;
            $data['turno'] = $request->turno;
        }

=======
>>>>>>> ffaa61479c6a5cf156faa9450cf38ba74e245126
        // Crear usuario
        $user = User::create($data);

        // Login automático
        Auth::login($user);

        return redirect()->route('hoteles.index') ->with('success', 'Usuario registrado correctamente.');
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
            return redirect()->route('hoteles.index');
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
    
     public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function empleadoDashboard()
    {
        return redirect()->route('hoteles.index');
    }
}