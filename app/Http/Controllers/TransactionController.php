<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Product;
use App\TransactionDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('crud-permission');

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('checkmember');
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
        $this->authorize('checkmember');

        $data = Transaction::where('user_id', Auth::user()->id)->get();
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
        $this->authorize('crud-permission');

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
        $this->authorize('crud-permission');

        $status = $request->get('status');

        if ($status == 'ditolak') {
            $td = TransactionDetail::where('transaction_id', $transaction->id)->get();
            $this->addStock($td);
        }

        $transaction->status = $status;
        $transaction->save();
        return redirect()->route('transaction.index')->with('status', 'Data Transaction succesfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
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

        foreach ($cart as $id => $detail) {
            $p = Product::find($detail['productId']);
            $p->stock = $p->stock - $detail['quantity'];
            $p->save();
        }

        session()->forget('cart');
        return redirect('home');
    }

    public function subtractStock($data)
    {
        foreach ($data as $d) {
            $p = Product::find($d->product_id);
            $p->stock = $p->stock - $d->quantity;
            $p->save();
        }
    }

    public function addStock($data)
    {
        foreach ($data as $d) {
            $p = Product::find($d->product_id);
            $p->stock = $p->stock + $d->quantity;
            $p->save();
        }
    }

    public function forgetSession()
    {
        session()->forget('cart');
    }

    public function showDetail(Request $request)
    {
        $this->authorize('checklogin');

        $id = $request->get('transactionId');
        $data = Transaction::find($id);
        return response()->json(array(
            'msg' => view('transaction.modal', compact('data'))->render()
        ), 200);
    }
}
