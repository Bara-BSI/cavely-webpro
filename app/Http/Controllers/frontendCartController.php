<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class frontendCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()){
            return redirect()->route('backend.login')->with('error', 'You have to login first');
        }

        $cart = Cart::where('users_id', Auth::user()->id)->where('checkouts_id', Null)->orderBy('id')->get();
        $game = Game::orderBy('id')->get();
        

        return view('frontend.v_cart.index', [
            'judul' => 'My cart',
            'cart' => $cart,
            'game' => $game,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()){
            return back()->with('error', 'You have to login first');
        }
        // dd($request);
        $validatedData['id'] = Null;
        $validatedData['checkouts_id'] = Null;
        $validatedData['users_id'] = $request->input('users_id');
        $validatedData['games_id'] = $request->input('games_id');
        $validatedData['jumlah'] = $request->input('jumlah');


        Cart::create($validatedData);
        return back()->with('success', 'Item added to cart');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart = Cart::findOrFail($cart->id);
        $cart->delete();
        return back() -> with('success', 'Data successfully removed');
    }
}
