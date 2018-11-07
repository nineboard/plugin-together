<div id="wrap" class="@if($layoutType === 'main') wrap-main @endif @if($config->get('useMainHeader', 'Y') === 'Y') wrap-main-header @endif">
    @include($theme::view('_sidebar'))

    <div id="container">
        @include($theme::view('_header'))

        @if($config->get('useMainHeader', 'Y') === 'Y')
            <!-- section-theme-basic-tfc -->
            <section class="section-theme-basic-tfc" @if($config->get('headerImage.path')) style="background-image:url('{{ $config->get('headerImage.path') }}')" @endif>
                <div class="inner-section-theme-basic">
                    <a class="link-basic">
                        <h2 class="title-basic">{{ xe_trans($config->get('headerTitle', '')) }}</h2>
                        <p class="text-basic">{{ xe_trans($config->get('headerDescription', '')) }}</p>
                    </a>
                </div>
            </section>
            <!-- // section-theme-basic-tfc -->
        @endif

        <div class="parallax-overlay"></div>

        <main class="main-tfc">
            <div class="theme_container">
                {!! $content !!}
            </div>
        </main>
    </div>

    @include($theme::view('_footer'))
</div>
