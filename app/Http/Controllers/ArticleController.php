<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Office;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('offices')->get();
        return view('articles.index', compact('articles'));
    }
    
    public function create()
    {
        $offices = Office::all();
        return view('articles.create', compact('offices'));
    }
    
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'code_bar' => 'required',
            'designation' => 'required',
            'quantite' => 'required',
            'office_id' => 'required' // Add validation for office_id
        ]);
    
        // Créer un nouvel article
        $article = new Article;
        $article->code_bar = $validatedData['code_bar'];
        $article->designation = $validatedData['designation'];
        $article->quantite = $validatedData['quantite'];
    
        // Enregistrer l'article dans la base de données
        $article->save();
    
        // Associer l'article au bureau sélectionné
        $article->offices()->attach($validatedData['office_id']); // Changed from 'office_ids' to 'office_id'
    
        // Rediriger vers la liste des articles avec un message de succès
        return redirect()->route('articles.index')->with('success', 'Article ajouté avec succès');
    }
    
    // Afficher le formulaire de modification d'un agent
    public function edit($id)
    {
        $article = Article::with('offices')->findOrFail($id);
        $offices = Office::all();
        return view('articles.edit', compact('article', 'offices'));
    }
    

    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'code_bar' => 'required',
            'designation' => 'required',
            'quantite' => 'required',
            'office_id' => 'required' // Add validation for office_id
        ]);
    
        // Trouver l'article à mettre à jour
        $article = Article::findOrFail($id);
    
        // Mettre à jour les attributs de l'article
        $article->code_bar = $validatedData['code_bar'];
        $article->designation = $validatedData['designation'];
        $article->quantite = $validatedData['quantite'];
    
        // Enregistrer les modifications dans la base de données
        $article->save();
    
        // Mettre à jour l'association de l'article au bureau
        $article->offices()->sync([$validatedData['office_id']]); // Use sync for updating. Note the array.
    
        // Rediriger vers la liste des articles avec un message de succès
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès');
    }
    

    // Supprimer un agent de la base de données
    public function destroy($id)
    {
        $Article = Article::findOrFail($id);
        $Article->delete();

        // Rediriger vers la liste des agents avec un message de succès
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès');
    }
}
