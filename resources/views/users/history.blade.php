@extends('layout')
@section('title')
    Lịch sử đặt hàng
@endsection
@section('content')
    <a href="{{ route('products.index') }}" class="btn btn-primary">Danh sách</a>
    <a href="{{ route('carts.index') }}" class="btn btn-success">giỏ hàng của bạn</a>
    <table class="table table-border">
        <thead>
            <tr class="text-center">
                <th>Mã đơn hàng</th>
                <th>Tên</th>
                <th>Số điện thoại</th>
                <th>Tổng giá tiền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
                <tr class="text-center">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name_user }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ number_format($order->total) }} VNĐ</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop{{ $index }}">
                            Chi tiết
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $index }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Chi tiết sản phẩm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-border">
                                            <thead>
                                                <tr>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Tổng giá</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detailOrders as $item)
                                                    @if ($item->order_id != $order->id)
                                                        @continue
                                                    @endif
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>
                                                            {{ number_format($item->quantity * $item->price - ($item->quantity * $item->price * ($item->discount * 0.01))) }}
                                                            VNĐ
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                        Tổng đơn : <b class="text-danger">{{ number_format($order->total) }} </b> VNĐ
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
