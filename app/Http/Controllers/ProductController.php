<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Image;
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
        $categories = Category::all();
        $data = [];
        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $dataProduk = [];
            foreach ($products as $product) {
                $images = Image::where('product_id', $product->id)->get();
                $dataImage = [];
                foreach ($images as $image) {
                    $dataImage[] = $image->name;
                }
                $dataProduk[] = ['produk' => $product, 'imageProduct' => $dataImage];
            }
            $data["$category->name"] = $dataProduk;
        }
        return view('product.index', compact('data'));
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
        $this->authorize('crud-permission');

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
        $images = Image::where('product_id', $product->id)->get();
        $categories = Category::all();
        $data['images'] = $images;
        $data['product'] = $product;
        $data['categories'] = $categories;
        return view('product.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $images = Image::where('product_id', $product->id)->get();
        $data['images'] = $images;
        $data['product'] = $product;
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('product.edit', compact('data'));
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
        $this->authorize('crud-permission');
        // dd($request->get('spek'));
        $specs = $request->get('spek');
        if(count($specs)>1){
            $spec = implode(';', $specs);

        }
        else{
            $spec = $specs[0];
        }

        $nama = $request->get('name');
        $stok = $request->get('stock');
        $price = $request->get('price');
        $brand = $request->get('brand');
        $category = $request->get('category');
        
        $product->name = $nama;
        $product->stock = $stok;
        $product->price = $price;
        $product->spec = $spec;
        $product->brand_id = $brand;
        $product->category_id = $category;
        $product->save();
        return redirect()->route('product.edit',$product->id)->with('status', 'Data product succesfully changed');
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

    public function getProductPerCategory($id)
    {
        $data = [];
        $products = Product::where('category_id', $id)->get();
        foreach ($products as $product) {
            $images = Image::where('product_id', $product->id)->get();
            $data[] = ['products' => $product, 'images' => $images];
        }
        return view('product.showProductCategory', compact('data'));
    }

    public function addToCart(Request $request)
    {
        $this->authorize('checkmember');
        $id = $request->get('id');
        $qty = $request->get('quantity');
        $p = Product::find($id);
        $cart = session()->get('cart');
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'productId' => $p->id,
                'name' => $p->name,
                'quantity' => $qty,
                'price' => $p->price,
            ];
        } else {
            $cart[$id]['quantity'] += $qty;
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'product add to cart succesfully');
    }

    public function cart()
    {
        $this->authorize('checkmember');

        return view('transaction.cart');
    }

    public function compareProduct()
    {
        $this->authorize('checklogin');

        return view('product.compare');
    }

    public function kumpulanLaptop(Request $request)
    {
        $this->authorize('checklogin');

        $name = $request->get('name');
        $data = Product::where('name', 'like', "%$name%")->where('category_id', 1)->get();
        return response()->json(array(
            'msg' => view('product.kumpulanlaptop', compact('data'))->render()
        ), 200);
    }

    public function getLaptop(Request $request)
    {
        $this->authorize('checklogin');

        $id = $request->get('id');
        // $id = 1;
        $product = Product::find($id);
        $image = Image::where('product_id', $id)->get();
        return response()->json(array(
            'msg' => view('product.cardLaptop', compact(['product', 'image']))->render()
        ), 200);
    }

    public function showSpec(Request $request)
    {
        $data = $request->get('spec');
        $name = $request->get('name');
        return response()->json(array(
            'msg' => view('product.modal', compact('data'), compact('name'))->render()
        ), 200);
    }

    public function getLaptopData(Request $request)
    {
        $this->authorize('checklogin');

        $id = $request->get('id');
        $image = Image::where('product_id', $id)->get();
        $data = Product::find($id);
        return response()->json(['product' => $data, 'img' => $image]);
    }
}
