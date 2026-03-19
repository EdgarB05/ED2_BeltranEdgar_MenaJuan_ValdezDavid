<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $allowedRoles = Auth::check() && Auth::user()->role === 'administrador'
            ? 'cliente,personal,administrador'
            : 'cliente';

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:30',
            'edad' => 'required|integer|min:1',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:' . $allowedRoles,
            'cargo' => 'nullable|string|max:255',
            'turno' => 'nullable|string|in:matutino,vespertino,nocturno',
        ]);

        $role = $request->role;

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

        $user = User::create($data);

        if (!Auth::check()) {
            Auth::login($user);
        }

        return redirect()->route('hoteles.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('hoteles.index');
        }

        $user = User::where('email', $credentials['email'])->first();

        if ($user && !str_starts_with((string) $user->password, '$2y$') && $user->password === $credentials['password']) {
            $user->password = Hash::make($credentials['password']);
            $user->save();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('hoteles.index')
                ->with('success', 'Tu contraseña fue actualizada correctamente.');
        }

        return back()->withErrors([
            'email' => 'Datos incorrectos',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('acceso');
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
