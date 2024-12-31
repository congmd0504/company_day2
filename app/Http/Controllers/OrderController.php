<?php

namespace App\Http\Controllers;

use App\Http\Requests\orders\StoreOrderRequest;
use App\Models\Cart;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = session()->get('cart', []);
        return view('orders.index', compact('carts'));
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
    public function store(StoreOrderRequest $request)
    {
        try {
            $order = order::create($request->all());
            $carts = session()->get('cart', []);

            foreach ($carts as $item) {
                $chitiet[] = [
                    'user_id'       => Auth::id(),
                    'product_id'    => $item['product_id'],
                    'quantity'      => $item['quantity'],
                    'order_id'      => $order->id,
                ];
                $product = Product::find($item['product_id']);
                $product->update([
                    'stock' => $product->stock - $item['quantity'],
                    'sold'  => $product->sold + $item['quantity']
                ]);
                DetailOrder::insert($chitiet);
            }
            session()->forget('cart');
            return redirect()->route('products.index')->with('success', 'Bạn đã đặt hàng thành công !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
