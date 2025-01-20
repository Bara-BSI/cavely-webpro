<?php

namespace App\Http\Controllers;

use App\Models\Game_Genre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role != 0) { // User is not admin
            return back()->with('error', 'Genre page can only be accessed by Admin.');
        }
        $genre = Genre::orderBy('id')->get();
        return view('backend.v_genre.index', [
            'judul' => 'Data Genre',
            'index' => $genre
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role != 0) { 
            return back()->with('error', 'Genre page can only be accessed by Admin.');
        }

        return view('backend.v_genre.create', [
            'judul' => 'Add Genre'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_genre' => 'required|max:255|unique:genres',
            'usia_minimal' => 'required|max:3',
        ]);
        $validatedData['id'] = Null;
        Genre::create($validatedData);
        return redirect()->route('backend.genre.index')->with('success', 'Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        $genre = Genre::findOrFail($genre->id);

        if (Auth::user()->role != 0) {
             return back()->with('error', 'Genre page can only be accessed by Admin.');
        }

        return view('backend.v_genre.edit', [
            'judul' => 'Edit Genre',
            'edit' => $genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $genre = Genre::findOrFail($genre->id);
        $rules = [
            'nama_genre' => 'required|max:255|unique:genres',
            'usia_minimal' => 'required|max:3',
        ];
        $messages = [
            'nama_genre.unique' => 'Genre has been added.',
        ];

        $validatedData = $request->validate($rules, $messages);
        $genre->update($validatedData);
        return redirect()->route('backend.genre.index')->with('success', 'Data successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $game_genres = Game_Genre::where('genres_id', $genre->id)->get();

        foreach ($game_genres as $gameGenre) {
            if ($gameGenre) { //check if $gameGenre exists
                $gameGenre->delete();
            }
        }

        $genre->delete();

        return redirect()->route('backend.genre.index')->with('success', 'Data successfully removed');
    }


}
