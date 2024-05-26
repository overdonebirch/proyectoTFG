<?php

namespace App\Http\Controllers;

use App\Models\Gimnasio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GimnasioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = null;
        $gimnasioUser = null;

        if(Auth::user()){
            $user = Auth::user();
            $gimnasioUser = Gimnasio::where("_id",$user->id_gimnasio)->first();

        }


        return view("inicio",compact('user','gimnasioUser'));

    }

    public function dondeEstamos()
    {
        $gimnasios = Gimnasio::all();
        return view("dondeEstamos",compact('gimnasios'));
    }

    public function gimnasio($gym)
    {

        $gimnasio = Gimnasio::where('_id', $gym)->first();
        return view("gimnasio",compact('gimnasio'));


    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
