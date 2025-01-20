<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Game;
use App\Models\Game_Genre;
use App\Models\Game_Media;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 2) { // User is Customer
            return back()->with('error', 'Customer please use frontend.');
        }
        if (Auth::user()->role == 1) { // User is Developer
            $game = Game::where('users_id', Auth::user()->id)->orderBy('id')->get();
        } else {
            $game = Game::orderBy('id')->get();
        }
        $user = User::orderBy('id')->get();
        return view('backend.v_game.index', [
            'judul' => 'Game Data',
            'index' => $game,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        $genre = Genre::orderBy('nama_genre')->get();
        return view('backend.v_game.create', [
            'judul' => 'Add Game',
            'genres' => $genre
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_game' => 'required|max:255',
            'tanggal_rilis' => 'required|date:Y-m-d',
            'harga' => 'required|numeric',
            'status' => 'required',
            'deskripsi' => 'required',
        ]);
        $validatedData['id'] = Null;
        $validatedData['users_id'] = Auth::user()->id;

        $game = Game::create($validatedData);

        $genre = $request->input('genres');
        foreach ($genre as $genre_id) {
            Game_Genre::create(['games_id' => $game->id, 'genres_id' => $genre_id]);
        }
        return redirect()->route('backend.game.index')->with('success', 'Data successfully saved');   
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        $review = Review::where('games_id', $game->id)->get();
        $user = User::findOrFail($game->users_id);
        $game = Game::with('game_medias')->findOrFail($game->id);
        $game_media = Game_Media::where('games_id', $game->id)->get();
        return view('backend.v_game.show', [
            'judul' => 'Game Media',
            'game' => $game,
            'game_media' => $game_media,
            'user' => $user,
            'review' => $review,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        if (Auth::user()->role == 2) { // User is Customer
            return back()->with('error', 'Customer please use frontend.');
        }
        if (Auth::user()->role == 1) { // User is Developer
            if ($game->users_id != Auth::user()->id) {
                return back()->with('error', 'Developer can only edit their own game.');
            }
        }

        $game_genre = Game_Genre::where('games_id', $game->id)->get();
        $game = Game::findOrFail($game->id);
        $genre = Genre::orderBy('nama_genre')->get();
        return view('backend.v_game.edit', [
            'judul' => 'Edit Game',
            'edit' => $game,
            'genres' => $genre,
            'game_genre' => $game_genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $game = Game::findOrFail($game->id);
        $rules = [
            'nama_game' => 'required|max:255',
            'tanggal_rilis' => 'required|date:Y-m-d',
            'harga' => 'required|numeric',
            'status' => 'required',
            'deskripsi' => 'required',
        ];
        $validatedData = $request->validate($rules);

        $game->update($validatedData);

        $genre = $request->input('genres');
        Game_Genre::where('games_id', $game->id)->delete();
        foreach ($genre as $genre_id) {
            Game_Genre::create(['games_id' => $game->id, 'genres_id' => $genre_id]);
        }
        return redirect()->route('backend.game.index')->with('success', 'Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game = Game::findOrFail($game->id);

        $game_medias = Game_Media::where('games_id', $game->id)->get();
        foreach ($game_medias as $media) {
            $media->delete();
        }

        $game_genre = Game_Genre::where('games_id', $game->id)->get();
        foreach ($game_genre as $genre) {
            Game_Genre::where('games_id', $game->id)->where('genres_id', $genre->genres_id)->delete();
        }
        $game->delete();
        return redirect()->route('backend.game.index')->with('success', 'Data successfully deleted');
    }

    

    public function frontendShow(string $id)
    {
        // Wrap in try-catch for better error handling
        try {
            $review = Review::where('games_id', $id)->orderBy('tanggal_ulasan', 'desc')->get();
            $game = Game::with('game_medias')->findOrFail($id);
            $users = User::orderBy('id')->get();
            $user = User::findOrFail($game->users_id);
            $genreId = Game_Genre::where('games_id', $id)->pluck('genres_id');
            $genre = Genre::whereIn('id', $genreId)->orderBy('usia_minimal', 'desc')->get();
            $media = Game_Media::where('games_id', $id)->orderBy('jenis', 'desc')->get();
            $other_games_id = Game_Genre::whereIn('genres_id', $genreId)->pluck('games_id');
            $other_games = Game::whereIn('id', $other_games_id)->whereNot('id', $id)->inRandomOrder()->get();
            $cart = Cart::where('games_id', $id)->get();




            // Check for empty genre collection *before* accessing value
            $usia_minimal = $genre->isNotEmpty() ? $genre->first()->usia_minimal : 0; // Use first() for single value

            if (Auth::check() && \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->age < $usia_minimal && Auth::user()->role == 2) {
                return back()->with('error', 'The game is not suitable for your age. The minimum age required is ' . $usia_minimal);
            }

            return view('frontend.v_game.show', [
                'judul' => 'Game Media',
                'game' => $game,
                'users' => $users,
                'user' => $user,
                'review' => $review,
                'genre' => $genre,
                'media' => $media,
                'other_game' => $other_games,
                'cart' => $cart,
            ]);

        } catch (\Exception $e) {
            // Log the error or display a user-friendly error page
            // For now, just dd() the error for debugging
            dd($e->getMessage());  // Remove this in production and replace with proper error handling
            return back()->with('error', 'An error occurred while retrieving the game.');
        }
    }


}
