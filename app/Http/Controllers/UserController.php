<?php

namespace App\Http\Controllers;

use App\Models\Gimnasio;
use App\Models\Membresia;
use App\Models\Plan;
use App\Models\Suscripcion;
use App\Models\User;
use Carbon\Carbon;
use Exception;
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


    public function perfil(){

        $user = Auth::user();

        $gimnasio = Gimnasio::where("_id",$user->id_gimnasio)->first();

        return view("perfil",compact('user','gimnasio'));
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

        $membresia = Membresia::where("_id",$request->id_membresia)->first();

        try{
            $user = User::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'dni' => $request->dni,
                'password' => $request->password,
                'id_gimnasio' => $request->id_gimnasio,
                'fecha_registro' => $request->fecha_registro,
                'membresia' => $membresia->toArray()
            ]);
            Suscripcion::create([

                "id_cliente" => $user->_id,
                "id_suscripcion" => $request->subscription_id,

            ]);

            return redirect('inicio')->with('success', 'Usuario Registrado');

        }
        catch(Exception $e){
            return redirect('inicio')->with("error",$e->getMessage());
        }


    }

    public function redirectRegister(Request $request){

        $id_membresia = $request->session()->get('id_membresia');

        $fecha_actual = Carbon::today()->toDateString();

        $params = [

            'nombre' => $request->session()->get('nombre'),
            'apellidos' => $request->session()->get('apellidos'),
            'email' => strtolower($request->session()->get('email')),
            'dni' => strtoupper($request->session()->get('dni')),
            'password' => $request->session()->get('password'),
            'id_gimnasio' => $request->session()->get('id_gimnasio'),
            'fecha_registro' => $fecha_actual,
            'id_membresia' => $id_membresia,
            'subscription_id' => $request->session()->get('subscription_id')

        ];
        return view("redirect.redirectRegister",compact("params"));


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
