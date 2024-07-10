<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::inRandomOrder()->paginate(8); //in ordine random 
        return view('welcome', ['films' => $films]);
    }    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //per visualizzare un singolo film
    }

    public function search(Request $request)
    {
        // dd($request);
        $search = $request->search;
        // dd($search);
        //filtrare i dati per questo campo di ricerca
        $films = Film::where('title','like','%'.$search .'%')->get();
        // dd($film);
        return view('films.search', compact('films'));

    }



    
}
