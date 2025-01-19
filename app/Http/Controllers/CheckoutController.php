<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Game;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 2) { // User is not admin
            return back()->with('error', 'Checkout page can only be accessed by Admin and Publisher.');
        } elseif (Auth::user()->role == 1) {
            $gameIds = Game::where('users_id', Auth::user()->id)->pluck('id'); // Get the game IDs
            $index = Cart::whereIn('games_id', $gameIds)->whereNotNull('checkouts_id')->orderBy('games_id')->get();

        } elseif (Auth::user()->role == 0) {
            $index = Checkout::orderBy('tanggal_checkout')->get();
        }
        $payment = Payment::orderBy('id')->get();
        $cart = Cart::orderBy('id')->get();
        $checkout = Checkout::orderBy('id')->get();
        $user = User::orderBy('id')->get();
        $game = Game::orderBy('id')->get();
        return view('backend.v_checkout.index', [
            'judul' => 'Order Data',
            'index' => $index,
            'payment' => $payment,
            'cart' => $cart,
            'checkout' => $checkout,
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
            return back()->with('error', 'Checkout page can only be accessed by Admin.');
        }

        $user = User::orderBy('id')->get();
        $game = Game::orderBy('id')->get();
        $cart = Cart::where('checkouts_id', Null)->orderBy('users_id')->get();
        $payment = Payment::orderBy('id')->get();
        return view('backend.v_checkout.create', [
            'judul' => 'Add Order',
            'carts' => $cart,
            'payments' => $payment,
            'users' => $user,
            'games' => $game
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_checkout' => 'required|date:Y-m-d',
            'total_harga' => 'required|numeric',
            'payments_id' => 'required|exists:payments,id'
        ]);
        $validatedData['id'] = Null;

        $checkout = Checkout::create($validatedData);

        $cart = $request->input('carts');
        foreach ($cart as $cart_id) {
            Cart::where('id', $cart_id)->update(['checkouts_id' => $checkout->id]);
        }
        return redirect()->route('backend.checkout.index')->with('success', 'Data successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        // $checkout = Checkout::findOrFail($checkout->id);
        // $cart = Cart::where('checkouts_id', $checkout->id)->get();
        // foreach ($cart as $cart_id) {
        //     Cart::where('checkouts_id', $cart_id->id)->update(['checkouts_id' => Null]);
        // }
        // $checkout->delete();
        // return redirect()->route('backend.checkout.index')->with('success', 'Data successfully deleted');

        $checkout = Checkout::findOrFail($checkout->id);
        Cart::where('checkouts_id', $checkout->id)->update(['checkouts_id' => null]); // Correct the where clause
        $checkout->delete();
        return redirect()->route('backend.checkout.index')->with('success', 'Data successfully deleted');
    }
}
