@extends('layouts.user')
@section('title', 'Xác thực tài khoản')
{{-- @section('main_class', 'complete-page') --}}
@section('content')
         @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @if (Auth::guard('account')->user()->verify_account == 1)
            <p style='text-align: center;
            font-size: large;
            color: cornflowerblue;'>Tài khoản này đã được xác thực</p>
        @else
     
            <form action="{{ route('user.verify-sendmail', ['id' => Auth::guard('account')->user()->id]) }}" method="get" style="    text-align: center;
                font-size: large;
                color: blueviolet;
            }">
                @csrf
                <label for="" style="margin-bottom:10px">Nhận mã xác thực</label><br>
                <button type="submit">Nhận mã</button>
            </form>
        @endif


    @endsection
