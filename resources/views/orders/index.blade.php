@extends('layout')
@section('title')
    Tiến hàng đặt hàng
@endsection
@section('content')
    @php
        $tong = 0;
    @endphp
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <h5>Thông tin</h5>
                <input type="hidden" name="user_id"value="{{ Auth::id() }}">
                <label for="">Tên </label>
                <input type="text" name="name_user" class="form-control" value="{{ Auth::user()->name }}">
                <label for="">Số điện thoại </label>
                <input type="text" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">
            </div>
            <div class="col-6">
                <h5>Danh sách đơn hàng</h5>
                <table class="table table-border">
                    <thead>
                        <tr class="text-center">
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Gía</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $index => $cart)
                            <tr class="text-center">
                                <td>{{ $cart['name'] }}</td>
                                <td>
                                    {{ $cart['quantity'] }}
                                </td>
                                <td>
                                    {{ number_format($cart['quantity'] * $cart['price'] - $cart['quantity'] * $cart['price'] * ($cart['discount'] * 0.01)) }}
                                    VNĐ</td>
                            </tr>
                            @php
                                $tong +=
                                    $cart['quantity'] * $cart['price'] -
                                    $cart['quantity'] * $cart['price'] * ($cart['discount'] * 0.01);
                            @endphp
                        @endforeach
                    </tbody>

                </table>
                <div class="text-end">
                    Tổng đơn : <b class="text-danger">{{ number_format($tong) }} </b> VNĐ
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ $tong }}" name="total">
        <button class="btn btn-success mt-4" style="width: 100%" type="submit">Đặt hàng</button>
    </form>
    <a href="{{ route('carts.index') }}" class="btn btn-info mt-2">Quay lại giỏ hàng</a>
@endsection
