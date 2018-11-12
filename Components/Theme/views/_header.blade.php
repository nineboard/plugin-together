<header class="header-tfc @if($layoutType === 'sub') header-sub-tfc @endif">
    <button type="button" class="btn-menu" title="메뉴"><span class="icon_menu"></span><span class="blind">메뉴</span></button>
    <h1 class="logo">
        {{-- 로고 --}}
        @if($config->get('logoType', 'text') === 'text')
            <a href="{{ url('/') }}" class="link-logo text" >{{ xe_trans($config->get('logoText', '')) }}</a>
        @else
            <a href="{{ url('/') }}" class="link-logo image"><img src="{{ $config->get('logoImage.path') }}" alt="{{ xe_trans($config->get('logoText', '')) }}"></a>
        @endif

        {{-- slogan --}}
        @if($config->get('slogan'))
            <span class="greet">{{ xe_trans($config->get('slogan')) }}</span>
        @endif
    </h1>
    <button type="button" class="btn-login" title="로그인"><span class="icon_login"></span><span class="text_login">로그인</span></button>
</header>
