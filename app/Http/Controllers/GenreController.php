<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sorting_options = [
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc']
        ];

        $default_sorting = ['name', 'asc'];
        $sort = $request->input('sort');

        $orderBy =  $sorting_options[$sort] ?? $default_sorting;
        // dd($orderBy);
        $genres = Genre::orderBy($orderBy[0], $orderBy[1])->paginate(10);

        return view('admin.genres.index', compact('genres', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.genres.create');
    }

    private function validategenreData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255'
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $this->validategenreData($request);
        //creo un'istanza
        $genre = new genre();
        //riempio i campi della tabella
        $genre->fill($validateData);

        $genre->save();

        return redirect()->route('genres.index');
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
        $genre=genre::findOrFail($id);
        return view('admin.genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData= $this->validategenreData($request);
        $genre= genre::findOrFail($id);
        $genre-> fill($validateData);

        $genre->save();
        return redirect()->route('genres.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre= genre::find($id);
        if(!$genre){
            return redirect()->route('genres.index')->with('success','Genere non presente');

        }

        $genre->delete();

        return redirect()->route('genres.index')->with('success','Genere eliminato');
    }

}
