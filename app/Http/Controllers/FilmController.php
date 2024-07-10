<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $films = Film::orderBy('id')->paginate(10);

       
        $sorting_options = [
            'title_asc' => ['title','asc'],
            'title_desc' => ['title','desc'],
            'anno_asc' => ['year','asc'],
            'anno_desc' => ['year','desc'],
        ];

        $default_sorting = ['title', 'asc'];
        $sort = $request->input('sort');       

        $orderBy =  $sorting_options[$sort] ?? $default_sorting;
        // dd($orderBy);
        $films = Film::orderBy($orderBy[0],$orderBy[1])->paginate(10);

        return view('admin.films.index', compact('films','sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        // Recupera tutti i registi disponibili
        $directors = Director::all();
        // Recupera tutti gli attori disponibili
        $actors = Actor::all();
        // Passa i dati alla vista create
        return view('admin.films.create', compact('genres', 'directors', 'actors'));
    }

    private function validateFilmData(Request $request)     {
        return $request->validate([
            'title' => 'required|string|max:255',            
            'director_id' => 'required|exists:directors,id',
            'actors' => 'required|array',            
            'actors.*' => 'exists:actors,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y')),           
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'genres' => 'required|array',            
            'genres.*' => 'exists:genres,id',       
        ]);    
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validare i dati
        $validateData = $this->validateFilmData($request);
        //creo un'istanza
        $film = new Film();
        //riempio i campi della tabella
        $film->fill($validateData);

        //gestiamo l'immagine
        if($request->hasFile('poster')){
            $fileName = time() . '_' .$request->file('poster')->getClientOriginalName();
            //carica l'immagine dentro la cartella storage/posters
            $posterPath = $request->file('poster')->storeAs('posters', $fileName, 'public');
            // $request->file('poster')->store('posters', 'public');

            //salva il percorso nel campo del db
            $film->poster = $posterPath;
        }

        $film->created_at = date('Y-m-d H:i:s');

        if($film->save()){
            $film->actors()->attach($validateData['actors']);
            $film->genres()->attach($validateData['genres']);
        }

        return redirect()->route('films.index');


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
        // Trova il film da modificare
        $film = Film::findOrFail($id);
        // Ottieni tutti i generi disponibili
        $genres = Genre::all();
        // Ottieni tutti i registi disponibili
        $directors = Director::all();
        // Ottieni tutti gli attori disponibili
        $actors = Actor::all();
        // Passa i dati alla vista di modifica
        return view('admin.films.edit', compact('film', 'genres', 'directors', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validare i dati
        $validateData = $this->validateFilmData($request);
        $film = Film::findOrFail($id);
        $film->fill($validateData);

        if($request->hasFile('poster')){
            //gestiamo l'immagine
        $fileName = time() . '_' .$request->file('poster')->getClientOriginalName();
        //carica l'immagine dentro la cartella storage/posters
        $posterPath = $request->file('poster')->storeAs('posters', $fileName, 'public');
        //salva il percorso nel campo del db
        $film->poster = $posterPath;
        }

        if($film->save()){
            $film->actors()->sync($validateData['actors']);
            $film->genres()->sync($validateData['genres']);
        }

        return redirect()->route('films.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $film = Film::find($id);
       if(!$film) {
        return redirect()->route('films.index')->with('success','film non presente');
       }

    // //    cancelliamo il percorso dell'immagine
    //    $posterPath = $film->poster ? storage_path('app/public/storage/'.$film->poster) : null;
     

    //    if($posterPath) {
    //     unlink($posterPath);
    //    }

       $film->delete();

       return redirect()->route('films.index')->with('success','film eliminato');


    }
}
