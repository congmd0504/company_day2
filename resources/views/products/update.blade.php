@extends('layout')
@section('title')
    Cap nhap san pham
@endsection
@section('content')
<a href="{{ route('products.index') }}" class="btn btn-primary">Danh sách</a>
{{-- <a href="{{ route('carts.index') }}" class="btn btn-success">giỏ hàng của bạn</a>
<a href="{{ route('history') }}" class="btn btn-warning">Lịch sử đặt hàng</a> --}}
    <form action="{{ route('products.update',$product) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="">Nha cung cap</label>
        <input type="text" name="supplier" value="{{$product->supplier}}" class="form-control">
        <label for="">Ten san pham</label>
        <input type="text" name="name" value="{{$product->name}}" class="form-control">
        <label for="">So luong kho</label>
        <input type="number" name="stock" value="{{$product->stock}}" class="form-control">
        <label for="">Da ban</label>
        <input type="number" name="sold" value="{{$product->sold}}" class="form-control">
        <label for="">Gia</label>
        <input type="number" name="price" value="{{$product->price}}" class="form-control">
        <label for="">Giam gia</label>
        <input type="number" name="discount" value="{{$product->discount}}" class="form-control">
        <input type="hidden" name="user_id" value="{{Auth::id()}}">
        <button type="submit" class="btn btn-success">Cập nhập</button>
    </form>
@endsection
