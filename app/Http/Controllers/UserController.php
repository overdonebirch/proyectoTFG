<?php

namespace App\Http\Controllers;

use App\Models\Gimnasio;
use App\Models\User;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $gimnasios = Gimnasio::all();

        return view('auth.register',compact('gimnasios'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        User::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_gimnasio' => $request->id_gimnasio,

        ]);


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
