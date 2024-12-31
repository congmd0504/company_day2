@extends('layout')
@section('title')
    Dang nhap
@endsection
@section('content')
    <form action="{{ route('postLogin') }}" method="POST">
        @csrf
        <label for="">Ten dang nhap</label>
        <input type="text" class="form-control" name="name">
        <label for="">Mat khau</label>
        <input type="password" class="form-control" name="password">
        <button class="btn btn-success" type="submit">Đăng nhập</button>
        <a href="{{route('register')}}" class="btn btn-danger">Đăng ký</a>
    </form>
   
@endsection
