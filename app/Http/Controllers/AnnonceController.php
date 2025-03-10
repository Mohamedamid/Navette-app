<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $voyages = Annonce::where('company_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('company', compact('voyages'));
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $departureTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->departure_time)->format('Y-m-d H:i:s');
        $arrivalTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->arrival_time)->format('Y-m-d H:i:s');

        $user = Auth::user();
        $voyage = new Annonce();
        $voyage->company_id = $user->id;
        $voyage->departure_city = $request->departure_city;
        $voyage->arrival_city = $request->arrival_city;
        $voyage->departure_time = $departureTime;
        $voyage->arrival_time = $arrivalTime;
        $voyage->bus_description = $request->bus_description;
        $voyage->save();

        return redirect()->route('form')->with('success', 'Navette ajoutée avec succès!');
    }

    public function edit($id)
    {
        $voyage = Annonce::findOrFail($id);
        return view('edit', compact('voyage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'bus_description' => 'nullable|string',
        ]);

        $departureTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->departure_time)->format('Y-m-d H:i:s');
        $arrivalTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->arrival_time)->format('Y-m-d H:i:s');

        $voyage = Annonce::findOrFail($id);

        $voyage->departure_city = $request->departure_city;
        $voyage->arrival_city = $request->arrival_city;
        $voyage->departure_time = $departureTime;
        $voyage->arrival_time = $arrivalTime;
        $voyage->bus_description = $request->bus_description;

        $voyage->save();

        return redirect()->route('company')->with('success', 'Rahla mise à jour avec succès!');
    }


    public function destroy($id)
    {
        $voyage = Annonce::findOrFail($id);
        $voyage->delete();

        return redirect()->route('company')->with('success', 'Rahla supprimée avec succès!');
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
}