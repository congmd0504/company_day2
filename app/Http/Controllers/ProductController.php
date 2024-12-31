<?php

namespace App\Http\Controllers;

use App\Http\Requests\products\StoreProductRequest;
use App\Http\Requests\products\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('products.*', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'updated_by')
            ->latest('id')
            ->paginate(5);
        return view('products.index', compact('products'));
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
    public function store(StoreProductRequest $request)
    {
        try {
            Product::create($request->all());
            return redirect()->route('products.index')->with('success', 'Thêm mới thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
        }
        return view('products.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->update($request->all());
            return redirect()->route('products.index')->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
            }
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
