<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Gimnasio;
use App\Models\TipoClase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gimnasios = Gimnasio::all();
        $clases = collect();
        $selectedGimnasio = null;

        if ($request->has('gimnasio_id')) {
            $selectedGimnasio = Gimnasio::find($request->input('gimnasio_id'));
            if ($selectedGimnasio) {
                $clases = $selectedGimnasio->clases;
            }
        }

        return view('clases', compact('gimnasios', 'clases', 'selectedGimnasio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


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
