<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('Admin.AjouteCategorie', compact('categories')); 
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
        ]);

        Categorie::create([
            'name' => $request->name, 
        ]);

        return redirect()->route('categories.index')->with('success', 'categorie ajoutée avec succès.');  
    }

    public function destroy($id)
    {
        $Categorie = Categorie::findOrFail($id);
        $Categorie->delete();
        return redirect()->route('categories.index')->with('success', 'Ville supprimée avec succès.');
    }
}
