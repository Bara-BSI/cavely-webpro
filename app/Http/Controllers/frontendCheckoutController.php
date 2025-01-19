<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Game;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class frontendCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::orderBy('id')->get();
        $cart = Cart::where('users_id', Auth::user()->id)->where('checkouts_id', Null)->orderBy('id')->get();
        $game = Game::orderBy('id')->get();
        $payment = Payment::orderBy('id')->get();
        return view('frontend.v_cart.create', [
            'judul' => 'My Cart',
            'cart' => $cart,
            'payment' => $payment,
            'user' => $user,
            'game' => $game
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total_harga' => 'required|numeric',
            'payments_id' => 'required|exists:payments,id'
        ]);
        $validatedData['id'] = Null;
        $validatedData['tanggal_checkout'] = $request->input('tanggal_checkout');

        $checkout = Checkout::create($validatedData);

        $cart = $request->input('carts');
        $cartID = json_decode($cart, true);
        foreach ($cartID as $cart_id) {
            Cart::where('id', $cart_id)->update(['checkouts_id' => $checkout->id]);
        }
        return redirect()->route('frontend.beranda')->with('success', 'Data successfully saved');
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
    public function destroy(string $id)
    {
        //
    }
}
