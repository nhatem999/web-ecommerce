@extends('layouts.user')
@section('title', 'Yolo Store')
@section('main_class', 'home-page')
@section('content')
    <div class="main-content fl-right">
        {{-- slider --}}
        @include('user.components.slider')
        {{-- endslider --}}
        <div class="section" id="support-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <div class="thumb">
                            <img src="public/users/images/icon-1.png">
                        </div>
                        <h3 class="title">Miễn phí vận chuyển</h3>
                        <p class="desc">Tới tận tay khách hàng</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public/users/images/icon-2.png">
                        </div>
                        <h3 class="title">Tư vấn 24/7</h3>
                        <p class="desc">1900.9999</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public/users/images/icon-3.png">
                        </div>
                        <h3 class="title">Tiết kiệm hơn</h3>
                        <p class="desc">Với nhiều ưu đãi cực lớn</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public/users/images/icon-4.png">
                        </div>
                        <h3 class="title">Thanh toán nhanh</h3>
                        <p class="desc">Hỗ trợ nhiều hình thức</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public/users/images/icon-5.png">
                        </div>
                        <h3 class="title">Đặt hàng online</h3>
                        <p class="desc">Thao tác đơn giản</p>
                    </li>
                </ul>
            </div>
        </div>
        {{-- Sản phẩm nổi bật --}}
        <div class="section" id="feature-product-wp">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm nổi bật</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item">
                    @foreach ($products as $item)
                        <li>
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
                                    {{-- @if ($item->feature_image2)
                                    <img src="{{ asset($item->feature_image2) }}">
                                    @endif --}}
                                </div>

                            </a>
                            <a href="?page=detail_product" title="" class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                @if ($item->discount)
                                    @php
                                        $discount = $item->price - ($item->price * $item->discount) / 100;
                                    @endphp
                                    <span class="new">{{ number_format($discount, 0, '', '.') }}đ</span>
                                    <span class="old">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @else
                                    <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @endif
                            </div>
                            <div class="action clearfix">
                                <a href="{{ route('cart.addProduct', ['id' => $item->id]) }}" title=""
                                    class="add-cart fl-left" data-url="{{ route('cart.add', ['id' => $item->id]) }}" data-account="{{ Auth::guard('account')->check() ? true : false }}" data-quantity="{{ $item->quantity }}" data-verify="{{ Auth::guard('account')->check() && Auth::guard('account')->user()->verify_account == 1 ? 1: 0}}">Thêm
                                    giỏ hàng</a>
                                <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                    title="" class="buy-now fl-right">Xem chi tiết</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- End --}}

        {{-- Điện thoại --}}
        <div class="section" id="list-product-wp">
            <div class="section-head">
                <a href="{{ route('user.category', ['slugCategory' => 'ao-thun']) }}" class="section-title">Áo Thun</a>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @foreach ($productShirt1 as $item)
                        <li>
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
                                    <span class="old">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @else
                                    <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @endif
                            </div>
                            <div class="action clearfix">
                                <a href="{{ route('cart.addProduct', ['id' => $item->id]) }}" title="Thêm giỏ hàng"
                                    class="add-cart fl-left" data-url="{{ route('cart.add', ['id' => $item->id]) }}" data-account="{{ Auth::guard('account')->check() ? true : false }}" data-verify="{{ Auth::guard('account')->check() && Auth::guard('account')->user()->verify_account == 1 ? 1: 0}}" data-quantity="{{ $item->quantity }}">Thêm
                                    giỏ hàng</a>
                                <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                    title="Mua ngay" class="buy-now fl-right">Xem chi tiết</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- end --}}

        {{-- Áo sơ mi --}}
        <div class="section" id="list-product-wp">
            <div class="section-head">
                <a href="{{ route('user.category', ['slugCategory' => 'ao-so-mi']) }}" class="section-title">Áo Sơ
                    Mi</a>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @foreach ($productShirt2 as $item)
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
                                    <span class="old">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @else
                                    <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @endif
                            </div>
                            <div class="action clearfix">
                                <a href="{{ route('cart.addProduct', ['id' => $item->id]) }}" title="Thêm giỏ hàng"
                                    class="add-cart fl-left" data-url="{{ route('cart.add', ['id' => $item->id]) }}" data-account="{{ Auth::guard('account')->check() ? true : false }}" data-verify="{{ Auth::guard('account')->check() && Auth::guard('account')->user()->verify_account == 1 ? 1: 0}}" data-quantity="{{ $item->quantity }}">Thêm
                                    giỏ hàng</a>
                                <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                    title="Mua ngay" class="buy-now fl-right">Xem chi tiết</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- end --}}
        {{-- Quần Jean --}}
        <div class="section" id="list-product-wp">
            <div class="section-head">
                <a href="{{ route('user.category', ['slugCategory' => 'quan-jean']) }}" class="section-title">Quần
                    Jean</a>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @foreach ($productQuanJean as $item)
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
                                    <span class="old">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @else
                                    <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                @endif

                            </div>
                            <div class="action clearfix">
                                <a href="{{ route('cart.addProduct', ['id' => $item->id]) }}" title="Thêm giỏ hàng"
                                    class="add-cart fl-left" data-url="{{ route('cart.add', ['id' => $item->id]) }}" data-account="{{ Auth::guard('account')->check() ? true : false }}" data-verify="{{ Auth::guard('account')->check() && Auth::guard('account')->user()->verify_account == 1 ? 1: 0}}" data-quantity="{{ $item->quantity }}">Thêm
                                    giỏ hàng</a>
                                <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                    title="Mua ngay" class="buy-now fl-right">Xem chi tiết</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- end --}}
    </div>
    @include('user.components.sidebar')


@endsection
@section('js')
    {{-- <script>
        $(document).ready(function() {
            $(".section-detail .list-item .action .add-cart").click(function(event) {
                event.preventDefault();
                var href = $(this).attr("href")
                var hrefCart = $(this).data("url")
                var infoProduct = $('.modal-content .modal-header .info-product')
                var colorProduct = $('.modal-body .choose-color .desc')
                $.ajax({
                    url: href,
                    method: 'GET',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        if (data.code == 200) {
                            var product = data.product; //type json
                            var colors = data.colors;
                            var productColors = data.productColors; //type json

                            // Insert info product
                            $(infoProduct).html(
                                '<h5 class="modal-title">' + product.name + '</h5>' +
                                '<h6 class="modal-price">' + data.priceProduct + 'đ</h6>'
                            )

                            // Insert color product
                            var len = productColors.length;
                            var txt = "";
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var active = "";
                                    var check = ""
                                    if (i == 0) {
                                        active = "active";
                                        check = "checked"
                                    }
                                    txt +=
                                        '<div class="product-color ' + active + '">' +
                                        '<div class="img">' +
                                        '<img src="{{ asset('') }}' + productColors[i]
                                        .image_color_path + '" alt="">' +
                                        '<input type="radio" ' + check +
                                        ' name="check-color" value="' +
                                        productColors[i].id + '" />' +
                                        '<p class="color-name">' + colors[i] + '</p>' +
                                        '</div>' +
                                        '</div>'
                                }
                                if (txt != "") {
                                    $(colorProduct).html(txt);
                                }
                            }
                            //Show modal
                            $('#modal-product-cart').modal('show');


                            //Active color
                            $(".desc .product-color").click(function() {
                                $(".desc .product-color.active").removeClass("active");
                                $(this).find("input[name=check-color]").prop("checked",
                                    true);
                                $(this).addClass("active");
                            });

                            $('.modal-footer .product-cart').attr('href', hrefCart)

                            // addCart()

                        }
                    }
                })
            })


            $('.modal-footer .product-cart').click(function() {
                var productColorId = $("input[name=check-color]:checked")
                    .val(); //Tìm input radio được check
                var num = $("input[name=num-order]").val();
                var href = $(this).attr("href");

                var urlImg = $(".product-color.active").find("img").attr("src");
                $.ajax({
                    url: href,
                    method: "GET",
                    data: {
                        productColorId: productColorId,
                        num: num,
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.code == 200) {
                            $('#modal-product-cart').modal('hide');
                            //Gán urlImg vào src
                            $(".modal-body img.img_product_modal").attr("src", urlImg);

                            //Thiết lập load lại dropdown
                            setInterval(function() {
                                $("#dropdown-cart-wp").load(
                                    location.href + " #dropdown-cart-wp"
                                );
                            }, 2000);
                            $(".num-total").text(data.num);


                            $("#modal-notification").modal("show");
                        }
                    },
                });
            })
        })
    </script> --}}
@endsection
