<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Http\Requests\StoreannonceRequest;
use App\Http\Requests\UpdateannonceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $voyages = Annonce::where('company_id', $user->id)->orderBy('status', 'desc')->get();
        return view('company', compact('voyages'));
    }

    public function display()
    {
        $user = Auth::user();
        $voyages = Annonce::where('company_id', $user->id)->get();
        return view('form', compact('voyages'));
    }

    public function updateStatus($id, Request $request)
    {
        $voyage = Annonce::findOrFail($id);

        if (in_array($request->status, ['valid', 'closed'])) {
            $voyage->status = $request->status;
            $voyage->save();

            return response()->json(['success' => true, 'status' => $voyage->status]);
        }

        return response()->json(['success' => false], 400);
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
    public function store(StoreannonceRequest $request)
    {

        $request->validate([
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'bus_description' => 'nullable|string',
        ]); 

        $user = Auth::user();
        $voyage = new Annonce();
        $voyage->company_id = $user->id;
        $voyage->departure_city = $request->departure_city;
        $voyage->arrival_city = $request->arrival_city;
        $voyage->departure_time = $request->departure_time;
        $voyage->arrival_time = $request->arrival_time;
        $voyage->bus_description = $request->bus_description;
        $voyage->save();

        return redirect()->route('form')->with('success', 'Navette ajoutée avec succès!');
    }


    public function show(annonce $annonce)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateannonceRequest $request, annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(annonce $annonce)
    {
        //
    }
}
