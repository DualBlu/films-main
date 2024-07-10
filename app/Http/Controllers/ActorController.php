<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;

class ActorController extends Controller
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
        $actors = Actor::orderBy($orderBy[0], $orderBy[1])->paginate(10);

        return view('admin.actors.index', compact('actors', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.actors.create');
    }

    private function validateActorData(Request $request)
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
        $validateData = $this->validateActorData($request);
        //creo un'istanza
        $actor = new Actor();
        //riempio i campi della tabella
        $actor->fill($validateData);

        $actor->save();

        return redirect()->route('actors.index');
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
        $actor=Actor::findOrFail($id);
        return view('admin.actors.edit', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData= $this->validateActorData($request);
        $actor= Actor::findOrFail($id);
        $actor-> fill($validateData);

        $actor->save();
        return redirect()->route('actors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actor= Actor::find($id);
        if(!$actor){
            return redirect()->route('actors.index')->with('success','attore non presente');

        }

        $actor->delete();

        return redirect()->route('actors.index')->with('success','attore eliminato');
    }
}
