<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactionDetail.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactionDetail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TransactionDetail();

        $data->quantity = $request->get('quantity');
        $data->price = $request->get('price');
        $data->subtotal = $request->get('subtotal');
        $data->product_id = $request->get('productId');
        $data->transaction_id = $request->get('transactionId');
        $data->save();
        return redirect()->route('transaction.index')->with('status', 'Transaction is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        $data = $transactionDetail;
        return view("transactionDetail.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        $transactionDetail->quantity = $request->get('quantity');
        $transactionDetail->price = $request->get('price');
        $transactionDetail->subtotal = $request->get('subtotal');
        $transactionDetail->product_id = $request->get('productId');
        $transactionDetail->transaction_id = $request->get('transactionId');
        $transactionDetail->save();
        return redirect()->route('transactionDetail.index')->with('status', 'Data transaction detail succesfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        $this->authorize('delete-permission', $transactionDetail);

        try {
            $transactionDetail->delete();
            return redirect()->route('transactionDetail.index')->with('status', 'Data transaction detail succesfully deleted');
        } catch (\PDOException $e) {
            $msg =  $this->handleAllRemoveChild($transactionDetail);
            return redirect()->route('transactionDetail.index')->with('error', $msg);
        }
    }
}
