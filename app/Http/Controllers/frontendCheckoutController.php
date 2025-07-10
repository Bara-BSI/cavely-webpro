<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Game;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

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
        // Mendapatkan customer yang login
        $customer = Auth::user();


        if ($cart->isEmpty()) {
            return redirect()->route('frontend.beranda')->with('error', 'You have no items in cart.');
        }

        // Hitung total harga produk
        $totalHarga = 0;
        foreach ($cart as $carts) {
            $totalHarga += $game->where('id', $carts->games_id)->value('harga') * $carts->jumlah;
        }


        // Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Generate unique order_id
        $orderId = 'cavely-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $totalHarga, // Pastikan gross_amount adalah integer
            ],
            'customer_details' => [
                'first_name' => $customer->nama,
                'email' => $customer->email,
                'phone' => $customer->hp,
            ],
        ];
        
        $snapToken = Snap::getSnapToken($params);
        return view('frontend.v_cart.create', [
            'judul' => 'My Cart',
            'cart' => $cart,
            'payment' => $payment,
            'user' => $user,
            'game' => $game,
            'snapToken' => $snapToken
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'total_harga' => 'required|numeric',
        //     'payments_id' => 'required|exists:payments,id'
        // ]);
        // $validatedData['id'] = Null;
        // $validatedData['tanggal_checkout'] = $request->input('tanggal_checkout');

        // $checkout = Checkout::create($validatedData);

        // $cart = $request->input('carts');
        // $cartID = json_decode($cart, true);
        // foreach ($cartID as $cart_id) {
        //     Cart::where('id', $cart_id)->update(['checkouts_id' => $checkout->id]);
        // }
        // return redirect()->route('frontend.beranda')->with('success', 'Data successfully saved');

        $user = Auth::user();
        // Use a database transaction to ensure data integrity
        return \Illuminate\Support\Facades\DB::transaction(function () use ($request, $user) {
            // 1. Get cart items for the authenticated user directly from the database.
            $cart = Cart::where('users_id', Auth::user()->id)->where('checkouts_id', Null)->orderBy('id')->get();
            $game = Game::orderBy('id')->get();
            $cartID = $cart->pluck('id')->toArray();


            // 2. Calculate the total price on the server.
            $totalHarga = 0;
            foreach ($cart as $carts) {
                $totalHarga += $game->where('id', $carts->games_id)->value('harga') * $carts->jumlah;
            }

            // 3. Create the checkout record with server-validated data.
            $checkout = Checkout::create([
                'tanggal_checkout' => now(),
                'total_harga' => $totalHarga,
                'payments_id' => 1, // placeholder
            ]);

            // 4. Associate cart items with the new checkout in a single query.
            foreach ($cartID as $carts) {
                Cart::where('id', $carts)->update(['checkouts_id' => $checkout->id]);
            }

            return redirect()->route('frontend.beranda')->with('success', 'Your order has been placed successfully!');
        });
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
