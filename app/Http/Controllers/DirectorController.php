<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $sorting_options = [
            'name_asc' => ['name','asc'],
            'name_desc' => ['name','desc'],
            ];

        $default_sorting = ['name', 'asc'];
        $sort = $request->input('sort');       

        $orderBy =  $sorting_options[$sort] ?? $default_sorting;
        // dd($orderBy);
        $directors = Director::orderBy($orderBy[0],$orderBy[1])->paginate(10);

        return view('admin.directors.index', compact('directors','sort'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.directors.create');

    }

    private function validateDirectorData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $this->validateDirectorData($request);
        //creo un'istanza
        $director = new Director();
        //riempio i campi della tabella
        $director->fill($validateData);

        $director->save();

        return redirect()->route('directors.index');
    
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
        $director=Director::findOrFail($id);
        return view('admin.directors.edit', compact('director'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData= $this->validateDirectorData($request);
        $director= Director::findOrFail($id);
        $director-> fill($validateData);

        $director->save();
        return redirect()->route('directors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $director= Director::find($id);
        if(!$director){
            return redirect()->route('directors.index')->with('success','regista non presente');

        }

        $director->delete();

        return redirect()->route('directors.index')->with('success','regista eliminato');
    }
}
