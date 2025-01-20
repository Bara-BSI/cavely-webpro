<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role != 0) { // User is not admin
            return back()->with('error', 'Payment method page can only be accessed by Admin.');
        }

        $payment = Payment::orderBy('id')->get();
        return view('backend.v_payment.index', [
            'judul' => 'Payment Method Data',
            'index' => $payment
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role != 0) { 
            return back()->with('error', 'Payment method page can only be accessed by Admin.');
        }

        return view('backend.v_payment.create', [
            'judul' => 'Add Payment Method',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama_bank' => 'required|max:255|unique:payments',
            'hp' => 'required|min:10|max:13',
        ]);
        $validatedData['id'] = Null;
        Payment::create($validatedData);
        return redirect()->route('backend.payment.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $payment = Payment::findOrFail($payment->id);

        if (Auth::user()->role != 0) {
             return back()->with('error', 'Payment method page can only be accessed by Admin.');
        }

        return view('backend.v_payment.edit', [
            'judul' => 'Edit Payment Method',
            'edit' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $payment = Payment::findOrFail($payment->id);
        $rules = [
            'nama_bank' => 'required|max:255|unique:payments',
            'hp' => 'required|min:10|max:13',
        ];
        $messages = [
            'nama_bank.unique' => 'Region has been registered',
        ];

        $validatedData = $request->validate($rules, $messages);
        $payment->update($validatedData);
        return redirect()->route('backend.payment.index')->with('success', 'Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment = Payment::findOrFail($payment->id);
        $payment->delete();
        return redirect() -> route('backend.payment.index')->with('success', 'Data successfully deleted');
    }
}
