<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = session()->get('cart', []);
        return view('carts.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $found = false;
        $product = Product::find($request->product_id);
        if ($product->stock == 0) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm đã hết hàng');
        }
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại.');
        }
        $cart = session()->get('cart', []);
        foreach ($cart as &$item) {
            if ($item['product_id'] == $product->id) {
                $newQuantity = $item['quantity'] + 1;
                if ($newQuantity > $product->stock) {
                    return redirect()->route('products.index')->with('error', 'Số lượng trong giỏ hàng lớn hơn số lượng tồn kho.');
                }
                $item['quantity'] = $newQuantity;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $cart[] = [
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'quantity' => 1,
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->stock,
                'discount' => $product->discount,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($request->product_id);
        if ($request->quantity > $product->stock) {
            return redirect()->route('carts.index')->with('error', 'Số lượng mua lớn hơn số lượng tồn kho');
        }
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);
        $cart = session()->get('cart', []);

        $cart[$id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        return redirect()->route('carts.index')->with('success', 'Cập nhật số lượng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('carts.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
        }
    }
}
