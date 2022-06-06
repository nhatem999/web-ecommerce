@extends('layouts.user')
@section('title', 'Thông tin đơn hàng')
{{-- @section('main_class', 'complete-page') --}}
@section('content')
    <div>
        <h1 style="    font-size: 16px;
        color: brown;margin-bottom:25px">Thông tin đơn hàng</h1>
        <table class="table table-striped table-checkall" id="list-product">
            <thead class="text-center">
                <tr>

                    <th scope="col">STT</th>
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Số sản phẩm</th>
                    <th scope="col">Kích thước</th>
                    <th scope="col">Màu</th>
                    <th scope="col">Tổng giá</th>
                    <th scope="col">Trang thái</th>

                </tr>
            </thead>
            <tbody class="text-center">
                @if ($orderDetail->count() > 0)
                    @php
                        $t = 1;
                    @endphp
                    @foreach ($orderDetail as $item)
                        <tr>
                            <td scope="row">{{ $t++ }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td width="10%"><img src="{{ asset($item->productDetails->feature_image) }}" alt=""> </td>
                            <td>{{ $item->order->customer->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->size }}</td>
                            <td>{{ $item->color }}</td>

                            <td>{{ number_format($item->order->total, 0, ',', '.') }}đ</td>
                            <td>
                                @if ($item->order->status == 0)
                                    <span class="badge badge-warning">Đang xử lý</span>
                                @elseif($item->order->status == 1)
                                    <span class="badge badge-info">Đang giao hàng</span>
                                @else
                                   <span class="badge badge-success"> Hoàn thành</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p style="    text-align: center;
                    padding: 10px;
                    color: red;
                    font-weight: bold;
                    font-size: 20px;">Không có đơn hàng nào</p>
                @endif


            </tbody>
        </table>



    </div>
@endsection
