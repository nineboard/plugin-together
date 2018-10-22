<div id="wrap">
    @include($theme::view('_sidebar'))

    <div id="container">
        @include($theme::view('_header'))

        <main class="main-tfc">
            {{-- 테마 옵션 --}}
            <!-- section-theme-basic-tfc -->
            <section class="section-theme-basic-tfc" style="background-image:url('https://www.fillmurray.com/640/360')">
                <div class="inner-section-theme-basic">
                    <a class="link-basic">
                        <h2 class="title-basic">Red Velvet Summer Mini Album ‘Summer Magic’ 세줄 한정으로 나오게 하기</h2>
                        <p class="text-basic">‘여름 지배자’ 레드벨벳, 여름 미니앨범 ‘Summer Magic’ 8월 6일 공개! 초강력 서머송 ‘Power Up’으로 또 한번 두줄까지 나오게 만들어야지</p>
                    </a>
                </div>
            </section>
            <!-- // section-theme-basic-tfc -->

            {!! $content !!}
        </main>
    </div>

    @include($theme::view('_footer'))
</div>
