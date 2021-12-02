<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('crud-permission');
        $data = Category::all();
        return view('category.index', compact('data'));
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

        $data = new Category();

        $data->name = $request->get('name');
        $data->type = $request->get('type');
        $data->unit = $request->get('unit');
        $data->save();
        return redirect()->route('category.index')->with('status', 'Category is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('crud-permission', $category);

        $category->name = $request->get('name');
        $category->type = $request->get('type');
        $category->unit = $request->get('unit');
        $category->save();
        return redirect()->route('category.index')->with('status', 'Data category succesfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('crud-permission', $category);

        try {
            $category->delete();
            return redirect()->route('category.index')->with('status', 'Data category succesfully deleted');
        } catch (\PDOException $e) {
            $msg =  $this->handleAllRemoveChild($category);
            return redirect()->route('category.index')->with('error', $msg);
        }
    }

    public function showEditModal(Request $request)
    {
        $this->authorize('crud-permission');

        $id = $request->get('categoryId');
        $data = Category::find($id);
        return response()->json(array(
            'msg' => view('category.modal', compact('data'))->render()
        ), 200);
    }

    public function loadNav()
    {
        $data = Category::all();
        return response()->json(array(
            'msg' => view('layout.nav', compact('data'))->render()
        ), 200);
    }
}
