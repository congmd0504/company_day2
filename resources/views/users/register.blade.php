@extends('layout')
@section('title')
    Đăng ký tài khoản
@endsection
@section('content')
    <form action="{{ route('postRegister') }}" method="POST">
        @csrf
        <label for="">Tên đăng nhập</label>
        <input type="text" class="form-control" value="{{old('name')}}" name="name">
        <label for="">Mật khẩu</label>
        <input type="password" class="form-control"  name="password">
        <label for="">Số điện thoại</label>
        <input type="text" class="form-control"  value="{{old('phone_number')}}" name="phone_number">
        <button class="btn btn-success mt-3" type="submit">Dang ký</button>
    <a href="{{route('login')}}" class="btn btn-info mt-3">Đã có tài khoản</a>

    </form>
@endsection
