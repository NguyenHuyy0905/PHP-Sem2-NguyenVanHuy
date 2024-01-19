<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //paging
        $products = product::latest()->paginate(5);
        return view('products.index', compact('products'))->with('i',
            (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required'
        ]);

        product::create($request->all());
        return redirect()->route('products.index')->with('success',
        'Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required'
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success',
        'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success',
        'Student deleted successfully.');
    }
}
