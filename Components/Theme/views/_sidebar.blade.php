<aside class="area-sidebar">

    <div class="inner-sidebar">

        <nav>
            <ul class="list-gnb reset-list">
                {{-- 1st menu --}}
                @foreach(menu_list($config->get('mainMenu')) as $menu1st)
                    <li>
                        <a href="{{ url($menu1st['url']) }}" @if($menu1st['target'] !== '_self') target="{{ $menu1st['target'] }}" @endif class="link-gnb">{{ $menu1st['link'] }}</a>

                        {{-- 2nd menu --}}
                        @if(count($menu1st['children']))
                            <ul class="list-gnb reset-list">
                                @foreach($menu1st['children'] as $menu2nd)
                                    <li>
                                        <a  href="{{ url($menu2nd['url']) }}" @if($menu2nd['target'] !== '_self') target="{{ $menu2nd['target'] }}" @endif class="link-gnb">{{ $menu2nd['link'] }}</a>

                                        {{-- 3rd menu --}}
                                        @if(count($menu2nd['children']))
                                            <ul class="list-gnb-depth reset-list">
                                                @foreach($menu2nd['children'] as $menu3rd)
                                                    <li><a href="{{ url($menu3rd['url']) }}" @if($menu3rd['target'] !== '_self') target="{{ $menu3rd['target'] }}" @endif class="link-gnb-depth">{{ $menu3rd['link'] }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- SNB --}}
        @if($config->get('useSnb', 'N') === 'Y')
            <ul class="list-tool reset-list">
                @foreach(menu_list($config->get('sidebarMenu')) as $menu)
                    <li><a href="{{ url($menu['url']) }}" @if($menu['target'] !== '_self') target="{{ $menu['target'] }}" @endif class="link-tool">{{ $menu['link'] }}</a></li>
                @endforeach
            </ul>
        @endif
        {{-- // SNB --}}

        <ul class="list-sns reset-list">
            @if($config->get('socialTwitter')) <li class="item-sns"><a href="{{ $config->get('socialTwitter') }}" target="_blank" class="link-sns"><span class="blind">twitter</span><span class="icon_sns_twitter"></span></a></li> @endif
            @if($config->get('socialYoutube')) <li class="item-sns"><a href="{{ $config->get('socialYoutube') }}" target="_blank" class="link-sns"><span class="blind">youtube</span><span class="icon_sns_youtube"></span></a></li> @endif
            @if($config->get('socialInstagram')) <li class="item-sns"><a href="{{ $config->get('socialInstagram') }}" target="_blank" class="link-sns"><span class="blind">instagram</span><span class="icon_sns_instagram"></span></a></li> @endif
            @if($config->get('socialFacebook')) <li class="item-sns"><a href="{{ $config->get('socialFacebook') }}" target="_blank" class="link-sns"><span class="blind">facebook</span><span class="icon_sns_facebook"></span></a></li> @endif
        </ul>
    </div>
    <span class="bg-sidebar"></span>
</aside>
