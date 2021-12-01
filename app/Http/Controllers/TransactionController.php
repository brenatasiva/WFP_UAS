<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Product;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::all();
        return view('transaction.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Transaction();

        $data->status = $request->get('status');
        $data->total = $request->get('total');
        $data->user_id = $request->get('userId');
        $data->save();
        return redirect()->route('transaction.index')->with('status', 'Transaction is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('checkpegawai');

        $data = $transaction::all();
        return view('transaction.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $data = $transaction;
        return view("transaction.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->status = $request->get('status');
        $transaction->total = $request->get('total');
        $transaction->user_id = $request->get('userId');
        $transaction->save();
        return redirect()->route('transaction.index')->with('status', 'Data transaction succesfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete-permission', $transaction);

        try {
            $transaction->delete();
            return redirect()->route('transaction.index')->with('status', 'Data transaction succesfully deleted');
        } catch (\PDOException $e) {
            $msg =  $this->handleAllRemoveChild($transaction);
            return redirect()->route('transaction.index')->with('error', $msg);
        }
    }

    public function formSubmit()
    {
        $this->authorize('checkmember');
        return view('transaction.checkout');
    }

    public function submitCheckout()
    {
        $this->authorize('checkmember');

        $cart = session()->get('cart');
        $user = Auth::user();
        $t = new Transaction;
        $t->user_id = $user->id;
        $t->created_at = Carbon::now()->toDateTimeString();
        $t->save();

        $totalHarga = $t->insertProduct($cart, $user);
        $t->total = $totalHarga;
        $t->save();

        $this->subtractQuantity($cart);

        session()->forget('cart');
        return redirect('home');
    }

    public function subtractQuantity($cart)
    {
        foreach ($cart as $id => $detail) {
            $p = Product::find($detail['productId']);
            $p->stock = $p->stock - $detail['quantity'];
            $p->save();
        }
    }

    public function forgetSession()
    {
        session()->forget('cart');
    }

    public function showDetail(Request $request)
    {
        $id = $request->get('transactionId');
        $data = Transaction::find($id);
        return response()->json(array(
            'msg' => view('transaction.modal', compact('data'))->render()
        ), 200);
    }

    public function showHistory()
    {
        $data = Transaction::where('user_id', Auth::user()->id)->get();
        return view('transaction.index', compact('data'));
    }
}
