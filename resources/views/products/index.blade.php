@extends('layout')
@section('title')
    Danh sách sản phẩm
@endsection
@section('content')

<a href="{{route('products.create')}}" class="btn btn-primary">Thêm mới</a>
<a href="{{route('carts.index')}}" class="btn btn-success">giỏ hàng của bạn</a>
<a href="{{route('history')}}" class="btn btn-warning">Lịch sử đặt hàng</a>
<a href="{{route('logout')}}" class="btn btn-danger">Đăng xuất</a>
<table class="table table-border">
    <thead>
        <tr class="text-center">
            <th>Nhà cung cấp</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng tồn kho</th>
            <th>Đã bán</th>
            <th>Gía</th>
            <th>Giam gia (%)</th>
            <th>Người cập nhập cuối</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr class="text-center">
            <td>{{$product->supplier}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->sold}}</td>
            <td>{{number_format($product->price)}} vnđ</td>
            <td>{{$product->discount}} %</td>
            <td>{{$product->user_name}}</td>
            <td class="d-flex">
                <form action="{{route('products.destroy',$product)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger m-1" type="submit">Xóa</button>
                </form>
                <a class="btn btn-warning m-1" href="{{route('products.edit',$product)}}">Sửa</a>
                <form action="{{route('carts.store')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$product->id}}" name="product_id">
                    <input type="hidden" value="{{Auth::id()}}" name="user_id">
                    <button type="submit" class="btn btn-info m-1">Thêm cart</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$products->links()}}
@endsection