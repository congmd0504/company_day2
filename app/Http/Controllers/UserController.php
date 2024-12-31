<?php

namespace App\Http\Controllers;

use App\Http\Requests\users\PostLoginRequest;
use App\Http\Requests\users\PostRegisterRequest;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function postRegister(PostRegisterRequest $request){
        try {
            User::create($request->all());
            return redirect()->route('login')->with('success','Bạn đã đăng ký thành công');
        } catch (\Throwable $th) {
           return redirect()->back()->with('error',$th->getMessage());
        }
    }
    public function postLogin(PostLoginRequest $request){
        if (Auth::attempt($request->only('name','password'))) {
            return redirect()->route('products.index')->with('success', 'Bạn đã đăng nhập thành công');
        } else {
            return back()->with('error', 'Tên tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công !');
    }
    public function history(){
        $orders = Order::with('detailOrders')
        ->latest('id')
        ->where('user_id','=',Auth::id())
        ->paginate(5);

        $detailOrders = DetailOrder::select('detail_orders.quantity','detail_orders.order_id','products.name as name','products.price as price','products.discount')
        ->join('products','products.id','=','detail_orders.product_id')
        ->groupBy('detail_orders.quantity','detail_orders.order_id','products.name','products.price','products.discount')
        ->get();
        return view('users.history',compact('orders','detailOrders'));
    }
}
