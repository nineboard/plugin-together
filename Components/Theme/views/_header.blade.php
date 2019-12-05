<header class="header-tfc @if($layoutType === 'sub') header-sub-tfc @endif">
    <button type="button" class="btn-menu" title="메뉴"><span class="icon_menu"></span><span class="blind">메뉴</span></button>
    <h1 class="logo">
        {{-- 로고 --}}
        @if($config->get('logoType', 'text') === 'text')
            <a href="{{ url('/') }}" class="link-logo text" >{{ xe_trans($config->get('logoText', '')) }}</a>
        @else
            <a href="{{ url('/') }}" class="link-logo image"><img src="{{ \Xpressengine\Media\Models\Image::find($config->get('logoImage.id'))->url() }}" alt="{{ xe_trans($config->get('logoText', '')) }}"></a>
        @endif

        {{-- slogan --}}
        @if($config->get('slogan'))
            <span class="greet">{{ xe_trans($config->get('slogan')) }}</span>
        @endif
    </h1>

    <div class="user-menu-dropdown">
        <button type="button" class="btn-login" title="{{ xe_trans('xe::user') }}"><span class="icon_login"></span></button>
        <ul class="user-menu">
            @if(Auth::check())
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('settings') }}" class="plugin"><i class="xi-cog"></i> {{ xe_trans('xe::settings') }}</a></li>
                @endif
                <li><a href="{{ route('user.profile', ['user' => auth()->id()]) }}">{{ xe_trans('xe::myProfile') }}</a></li>
                <li><a href="{{ route('user.settings') }}">{{ xe_trans('xe::mySettings') }}</a></li>
                <li><a href="{{ route('logout') }}">{{ xe_trans('xe::logout') }}</a></li>
            @else
                <li><a href="{{ route('login') }}">{{ xe_trans('xe::login') }}</a></li>
            @endif
        </ul>
    </div>
</header>
