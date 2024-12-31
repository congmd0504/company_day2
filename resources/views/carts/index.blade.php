@extends('layout')
@section('title')
    Danh sách giỏ hàng
@endsection
@section('content')
    <a href="{{ route('products.index') }}" class="btn btn-primary">Danh sách</a>
    {{-- <a href="{{ route('history') }}" class="btn btn-warning">Lịch sử đặt hàng</a> --}}
    <table class="table table-border">
        <thead>
            <tr class="text-center">
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá gốc</th>
                <th>Gía giảm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $index => $cart)
                <tr class="text-center">
                    <td>{{ $cart['name'] }}</td>
                    <td>
                        <form action="{{ route('carts.update', $index) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="product_id" value="{{ $cart['product_id'] }}">
                            <input type="number" min="1" name="quantity" value="{{ $cart['quantity'] }}">
                            <button type="submit">Cập nhập</button>
                        </form>
                    </td>
                    <td>{{ number_format($cart['quantity'] * $cart['price']) }} VNĐ</td>
                    <td>
                        {{ number_format($cart['quantity'] * $cart['price'] -
                                    $cart['quantity'] * $cart['price'] * ($cart['discount'] * 0.01)) }} VNĐ</td>
                    <td>
                        <form action="{{ route('carts.destroy', $index) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger"
                                type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('orders.index') }}" style="width: 100%" class="btn btn-success">Tiến hành đặt hàng</a>
@endsection
