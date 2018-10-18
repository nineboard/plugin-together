<div id="wrap">
    @include($theme::view('_header'))

    <div id="container">
        @include($theme::view('_sidebar'))

        <main class="main-tfc">
            {!! $content !!}
        </main>
    </div>

    @include($theme::view('_sidebar'))
</div>
