<?php

namespace App\Http\Controllers;

use App\Models\Gimnasio;
use App\Models\Membresia;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return $users;
    }

    public function formLogin(){
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirigir al usuario a la ruta de inicio después de iniciar sesión correctamente
            return redirect()->intended('/inicio')->with('success', 'Logado correctamente');
        }

        // Si las credenciales son incorrectas, redirigir de vuelta al formulario de login con un mensaje de error
        return redirect()->back()->with('error', 'Credenciales Incorrectas.');
    }
    public function logout(Request $request)
    {
        Auth::logout();  // Cierra la sesión del usuario autenticado

        $request->session()->invalidate();  // Invalida la sesión actual
        $request->session()->regenerateToken();  // Regenera el token CSRF

        return redirect('/inicio')->with('success', 'Has cerrado sesión correctamente');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $gimnasios = Gimnasio::all();
        $membresias = Membresia::all();
        $planes = Plan::all();


        return view('auth.register',compact('gimnasios','membresias','planes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'dni' => $request->dni,
            'password' => Hash::make($request->password),
            'id_gimnasio' => $request->id_gimnasio,

        ]);

        return redirect('inicio')->with('success', 'Usuario Registrado');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
