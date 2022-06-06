<div class="sidebar fl-left">
    {{-- categoryProduct --}}
    @include('user.components.categoryProduct')
    {{-- endCategoryProduct --}}
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                
                @foreach ($sellProducts as $item)
               
                    <li class="clearfix">
                        <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                            title="" class="thumb fl-left">
                            <img class="img-product-sell" src="{{ asset($item->feature_image) }}">
                        </a>
                        <div class="info fl-right">
                            <a href="{{ route('product.detail', ['slugCategory' => $item->category->catProductParent->slug, 'slugProduct' => $item->slug]) }}"
                                title="" class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                            </div>
                            <a href="{{ route('cart.addProduct', ['id' => $item->id]) }}" title=""
                                class="add-cart btn btn-outline-dark btn-sm" data-account="{{ Auth::guard('account')->check() ? true : false }}" data-verify="{{ Auth::guard('account')->check() && Auth::guard('account')->user()->verify_account == 1 ? 1: 0}}" data-quantity="10"
                                data-url="{{ route('cart.add', ['id' => $item->id]) }}">Thêm
                                giỏ hàng</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="{{ route('user.index') }}" title="" class="thumb">
                <img src="{{ asset('public/users/images/Banner1.jpg') }}" alt="">
                
            </a>
        </div>
    </div>
</div>
{{-- Modal Add Cart --}}
@include('user.components.modalProductCart')
{{-- End Model Add Cart --}}
@include('user.components.modalAccountCart')
@include('user.components.modalVerifyAccount')
@include('user.components.modalCartNum')
{{-- Modal Notitfication --}}
@include('user.components.modalNotification')
{{-- endModal Notitfication --}}
