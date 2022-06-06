<div id="menu-respon">
    <a href="?page=home" title="" class="logo">YOLO SHOP</a>
    <div id="menu-respon-wp">
        <ul class="" id="main-menu-respon">
            <li>
                <a href="{{ route('user.index') }}" title>Trang chủ</a>
            </li>
            @foreach ($categoryProductParent as $item)
                <li>
                    <a href="{{ route('user.category', $item->slug) }}" title="">{{ $item->name }}</a>
                    @if ($item->catProductChild->count() > 0)
                        @include('user.components.categoryProductChild', [
                            'categoryProductChild' => $item->catProductChild,
                        ])
                    @endif
                </li>
            @endforeach
            <li>
                <a href="?page=blog" title>Blog</a>
            </li>
            <li>
                <a href="#" title>Liên hệ</a>
            </li>
        </ul>
    </div>
</div>
