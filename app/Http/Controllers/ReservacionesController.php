<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservaciones;

class ReservacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $hoteles = Hoteles::all();

        return view('hoteles.index', compact('hoteles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('hoteles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Boletos::create([
            'nombrehuesped' => $request -> nombrehuesped,
            'fechaingreso' => $request ->fechaingreso,
            'fechafin' => $request ->fechafin,
            'numhabitacion' => $request ->numhabitacion,
            'metodopago' => $request ->metodopago,
            'estadocontrato' => $request ->estadocontrato,
            'servicios' => $request ->servicios,            
        ]);

        return redirect()->route('hoteles.create');
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
    public function edit(Hoteles $hotel)
    {
        //
        return view('hoteles.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hoteles $hotel)
    {
        //
        $request - validate([
            'nombrehuesped' => 'required',
            'fechaingreso' => 'required',
            'fechafin' => 'required',
            'numhabitacion' => 'required',
            'metodopago' => 'required',
            'estadocontrato' => 'required',
            'servicios' => 'required', 
        ]);

        $hotel -> update($request->all());

        return redirect() -> route('hoteles.index')
        -> with('success', 'Actualización con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hoteles $hotel)
    {
        //
        $hotel -> delete();
        
        return redirect() -> route('hoteles.index')
        -> with('success', 'Reservación eliminada');
    }
}
