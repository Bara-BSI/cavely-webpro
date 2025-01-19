<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role != 0) { // User is not admin
            return back()->with('error', 'Cart page can only be accessed by Admin.');
        }
        $cart = Cart::orderBy('users_id')->get();
        $user = User::orderBy('id')->get();
        $game = Game::orderBy('id')->get();
        return view('backend.v_cart.index', [
            'judul' => 'Cart Data',
            'index' => $cart,
            'user' => $user,
            'game' => $game
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role != 0) { 
            return back()->with('error', 'Cart page can only be accessed by Admin.');
        }

        $user = User::orderBy('id')->get();
        $game = Game::orderBy('id')->get();

        return view('backend.v_cart.create', [
            'judul' => 'Add Country',
            'user' => $user,
            'game' => $game
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'users_id' => 'required|exists:users,id',
            'games_id' => 'required|exists:games,id',
            'jumlah' => 'required|numeric'            
        ]);
        $validatedData['id'] = Null;
        $validatedData['checkouts_id'] = Null;

        Cart::create($validatedData);
        return redirect()->route('backend.cart.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        $cart = Cart::findOrFail($cart->id);
        $user = User::orderBy('id')->get();
        $game = Game::orderBy('id')->get();

        if (Auth::user()->role != 0) {
             return back()->with('error', 'Cart page can only be accessed by Admin.');
        }

        return view('backend.v_cart.edit', [
            'judul' => 'Edit Cart',
            'edit' => $cart,
            'user' => $user,
            'game' => $game
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $cart = Cart::findOrFail($cart->id);
        $rules = [
            'users_id' => 'required|exists:users,id',
            'games_id' => 'required|exists:games,id',
            'jumlah' => 'required|numeric'
        ];

        $validatedData = $request->validate($rules);
        $cart->update($validatedData);
        return redirect()->route('backend.cart.index')->with('success', 'Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart = Cart::findOrFail($cart->id);
        $cart->delete();
        return redirect() -> route('backend.cart.index')->with('success', 'Data successfully removed');
    }
}
