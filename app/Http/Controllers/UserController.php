<?php

namespace App\Http\Controllers;

use App\Models\Gimnasio;
use App\Models\Membresia;
use App\Models\Plan;
use App\Models\Reserva;
use App\Models\Suscripcion;
use App\Models\User;
use App\Subscriptions\PayPalSubscription;
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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirigir al usuario a la ruta de inicio después de iniciar sesión correctamente
            return redirect('/')->with('success', 'Logado correctamente');
        }

        // Si las credenciales son incorrectas, redirigir de vuelta al formulario de login con un mensaje de error
        return redirect()->back()->with('error', 'Credenciales Incorrectas.');
    }
    public function logout(Request $request)
    {
        Auth::logout();  // Cierra la sesión del usuario autenticado

        $request->session()->invalidate();  // Invalida la sesión actual
        $request->session()->regenerateToken();  // Regenera el token CSRF

        return redirect('/')->with('success', 'Has cerrado sesión correctamente');
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

            return redirect('/')->with('success', 'Usuario Registrado');

        }
        catch(Exception $e){
            return redirect('/')->with("error",$e->getMessage());
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
    public function show()
    {
        $user = Auth::user();

        $reservas = Reserva::where("dni_usuario",$user->dni)->get();
        $gimnasio = Gimnasio::where("_id",$user->id_gimnasio)->first();

        return view("perfil",compact('user','gimnasio','reservas'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $user = null;
        $eliminarUsuario = null;
        $gimnasio = null;

        if($request->dniUsuario){

            $user = User::where("dni",strtoupper($request->dniUsuario))->first();

            if($user == null){
                return redirect()->back()->with('error','no existe el usuario');
            }

            $gimnasio = Gimnasio::where('_id',$user->id_gimnasio)->first();
        }

        if($request->has('eliminarUser')){
            $eliminarUsuario = true;
        }



        $gimnasios = Gimnasio::all();
        return view('empleado.editUser',compact('user','gimnasios','eliminarUsuario','gimnasio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->id_gimnasio = $request->id_gimnasio;

        $user->save();

        return redirect()->back()->with('success','usuario modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        $suscription = Suscripcion::where("id_cliente",$user->_id)->first();
        $paypalSuscription = new PayPalSubscription();
        $paypalSuscription->cancel($suscription ->id_suscripcion);

        $suscription->delete();
        $user->delete();


        return redirect('/')->with('success','usuario eliminado');
    }
}
