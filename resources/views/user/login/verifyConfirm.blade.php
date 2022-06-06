@extends('layouts.user')
@section('title', 'Xác thực tài khoản')
{{-- @section('main_class', 'complete-page') --}}
@section('content')

    @if ($status)
        <div class="alert alert-success">
            {{ $status }}
        </div>
    @endif
    <div>

    </div>
    <form action="" method="POST" style="    text-align: center;
    font-size: large;
    color: blueviolet;
}">
        @csrf
        <label for="" style="margin-bottom:10px">Nhập mã xác thực</label><br>
        <input type="text" name="code">
        <button type="submit" name="">Nhập mã</button>
    </form>
@endsection
