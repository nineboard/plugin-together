{{ XeFrontend::css('plugins/together/assets/css/board.css')->load() }}

<!-- section-board-tfc -->
<section class="section-board-tfc">
    <!-- board-notice-tfc -->
        @section('content')
            {!! isset($content) ? $content : '' !!}
        @show
</section>
