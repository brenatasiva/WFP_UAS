<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Product();

        if ($request->get('ram') != null)
            $spec = $request->get('ram') . ";" . $request->get('camera') . ";" . $request->get('screen') . ";" . $request->get('battery');
        else
            $spec = $request->get('spec');

        $data->name = $request->get('name');
        $data->spec = $spec;
        $data->stock = $request->get('stock');
        $data->price = $request->get('price');
        $data->category_id = $request->get('categoryId');
        $data->brand_id = $request->get('brandId');
        $data->save();
        return redirect()->route('product.index')->with('status', 'Product is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = $product;
        return view("product.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->get('ram') != null)
            $spec = $request->get('ram') . ";" . $request->get('camera') . ";" . $request->get('screen') . ";" . $request->get('battery');
        else
            $spec = $request->get('spec');

        $product->name = $request->get('name');
        $product->spec = $spec;
        $product->stock = $request->get('stock');
        $product->price = $request->get('price');
        $product->category_id = $request->get('categoryId');
        $product->brand_id = $request->get('brandId');
        $product->save();
        return redirect()->route('product.index')->with('status', 'Data product succesfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete-permission', $product);

        try {
            $product->delete();
            return redirect()->route('product.index')->with('status', 'Data product succesfully deleted');
        } catch (\PDOException $e) {
            $msg =  $this->handleAllRemoveChild($product);
            return redirect()->route('product.index')->with('error', $msg);
        }
    }
}
