<header class="header-tfc">
    <button type="button" class="btn-menu" title="메뉴"><span class="icon_menu"></span><span class="blind">메뉴</span></button>
    <h1 class="logo">
        <a href="{{ url('/') }}" class="link-logo">
            @if($config->get('logoType', 'text') === 'text')
                {{ xe_trans($config->get('logoText', 'Together')) }}
            @else
                @if($config->get('logoImage.path'))
                    <img src="{{ $config->get('logoImage.path') }}" alt="{{ xe_trans($config->get('logoText', '')) }}" />
                @else
                    {{ xe_trans($config->get('logoText', 'Together')) }}
                @endif
            @endif
        </a>
        @if($config->get('slogan'))
            <span class="greet">{{ xe_trans($config->get('slogan')) }}</span>
        @endif
    </h1>
    <button type="button" class="btn-login" title="로그인"><span class="icon_login"></span><span class="text_login">로그인</span></button>
</header>
