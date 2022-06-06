@extends('layouts.user')
@section('title', 'Tìm kiếm')
@section('main_class', 'category-product-page')
@section('content')
    <div class="secion" id="breadcrumb-wp">
        <div class="secion-detail">
            <p class="results-num">Tìm thấy <b>{{ $countSearch }}</b> kết quả với từ khóa
                <b>"{{ request()->input('search') }}"</b>
            </p>
        </div>
    </div>
    <div class="main-content fl-right">
        <div class="section" id="list-product-wp">
            <div class="section-head clearfix">
                <div class="fl-left">
                    <h3 class="section-title">Search</h3>
                    {{-- @if (!empty($checkBrand) || !empty($checkPrice))
                        <div class="filter-product">
                            <span class="filter-title">Lọc theo: </span>
                            @if (!empty($checkBrand))
                                @foreach ($checkBrand as $item)
                                    <span class="filter-name">{{ $item }}</span>
                                @endforeach
                            @endif
                            @if (!empty($checkPrice))
                                @foreach ($checkPrice as $item)
                                    <span class="filter-name">{{ $item }}</span>
                                @endforeach
                            @endif
                        </div>
                    @endif --}}
                </div>
                <div class="filter-wp fl-right">
                    <div class="form-filter">
                        <form>
                            <select name="sort">
                                <option>Sắp xếp</option>
                                <option {{ request()->sort == 'a-z' ? 'selected' : '' }} value="a-z">Từ A-Z</option>
                                <option {{ request()->sort == 'z-a' ? 'selected' : '' }} value="z-a">Từ Z-A</option>
                                <option {{ request()->sort == 'high-to-low' ? 'selected' : '' }} value="high-to-low">Giá
                                    cao xuống thấp</option>
                                <option {{ request()->sort == 'low-to-high' ? 'selected' : '' }} value="low-to-high">Giá
                                    thấp lên cao</option>
                            </select>
                            <button type="submit">Lọc</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section-detail">
                @if ($products->count() > 0)
                    <ul class="list-item clearfix">
                        @foreach ($products as $item)
                            <li class="">
                                @if ($item->discount > 0)
                                    <div class="sale-off">
                                        <span class="sale-off-percent">{{ $item->discount }}%</span>
                                        <span class="sale-off-label">GIẢM</span>
                                    </div>
                                @endif
                                <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                    title="" class="thumb">
                                    <div class="product_image">
                                        <img src="{{ asset($item->feature_image) }}">
                                        @if ($item->feature_image2)
                                            <img src="{{ asset($item->feature_image2) }}">
                                        @endif
                                    </div>
                                </a>
                                <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                    title="" class="product-name">{{ $item->name }}</a>
                                <div class="price">
                                    @if ($item->discount)
                                        @php
                                            $discount = $item->price - ($item->price * $item->discount) / 100;
                                        @endphp
                                        <span class="new">{{ number_format($discount, 0, '', '.') }}đ</span>
                                        <span
                                            class="old">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                    @else
                                        <span
                                            class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                    @endif
                                </div>
                                <div class="action clearfix">
                                    <a href="{{ route('cart.addProduct', ['id' => $item->id]) }}" title="Thêm giỏ hàng"
                                        class="add-cart fl-left" data-url="{{ route('cart.add', ['id' => $item->id]) }}"
                                        data-account="{{ Auth::guard('account')->check() ? true : false }}"
                                        data-verify="{{ Auth::guard('account')->check() && Auth::guard('account')->user()->verify_account == 1 ? 1 : 0 }}"
                                        data-quantity="{{ $item->quantity }}">Thêm giỏ hàng</a>
                                    <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                        title="" class="buy-now fl-right">Xem chi tiết</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="not-search clearfix">
                        <img src="{{ asset('public/users/images/noti-search.png') }}" alt="">
                        <p>Rất tiếc chúng tôi không tìm thấy kết quả theo yêu cầu của bạn</p>
                        <p>Vui lòng thử lại .</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="section" id="paging-wp">
            <div class="section-detail">
                {{-- ?search="a"&page=2 --}}
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>

        {{-- Modal Add Cart --}}
        @include('user.components.modalProductCart')
        {{-- End Model Add Cart --}}

        {{-- Modal Notitfication --}}
        @include('user.components.modalNotification')
        {{-- endModal Notitfication --}}
    </div>
    @include('user.components.sidebar')
@endsection
@section('js')
    <script src="{{ asset('public/users/js/home.js') }}"></script>
@endsection
