<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.index');
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
        //
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
}
