<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Bureau;
use App\Models\Office;
use App\Models\Siege;


class BureauController extends Controller
{
    public function index()
    {
        $bureaux = Office::with('sieges')->get();
        $sieges = Siege::all();
        return view('bureaux.index', compact('bureaux', 'sieges'));
    }


    public function create()
    {
        $sieges = Siege::all();

        return view('bureaux.create', compact('sieges'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'num_bureau' => 'required',
            'etage' => 'required',
            'siege_id' => 'required' // Validate the siege_id input
        ]);
    
        // Create a new bureau
        $bureau = new Office();
        $bureau->num_bureau = $validatedData['num_bureau'];
        $bureau->etage = $validatedData['etage'];
        $bureau->save();
    
        // Attach the selected siege to the bureau
        $bureau->sieges()->attach($validatedData['siege_id']);
    
        // Redirect to a specific route with a success message
        return redirect()->route('bureaux.index')->with('success', 'Bureau ajouté avec succès');
    }
    



    public function edit($id)
    {
        $bureau = Office::with('sieges')->findOrFail($id);
        $sieges = Siege::all();
        return view('bureaux.edit', compact('bureau', 'sieges'));
    }
    

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'num_bureau' => 'required',
            'etage' => 'required',
            'siege_id' => 'required' // Validate the siege_id input
        ]);
    
        // Find the bureau by id and update it
        $bureau = Office::findOrFail($id);
        $bureau->num_bureau = $validatedData['num_bureau'];
        $bureau->etage = $validatedData['etage'];
        $bureau->save();
    
        // Update the associated siege
        // First, detach any existing associations and then attach the new one
        $bureau->sieges()->sync($validatedData['siege_id']);
    
        // Redirect to a specific route with a success message
        return redirect()->route('bureaux.index')->with('success', 'Bureau mis à jour avec succès');
    }
    

    // Supprimer un agent de la base de données
    public function destroy($id)
    {
        $bureaux = Office::findOrFail($id);
        $bureaux->delete();

        // Rediriger vers la liste des agents avec un message de succès
        return redirect()->route('bureaux.index')->with('success', 'Bureau supprimé avec succès');
    }
}
