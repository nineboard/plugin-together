{{ XeFrontend::css('plugins/together/assets/css/widget.css')->load() }}
<section class="section-gallery-tfcw">
    <h3 class="title-h3"><span>{{ $widgetConfig['@attributes']['title'] }}</span></h3>
    <ul class="list-gallery-tfc reset-list">
        @foreach($list as $item)
            <li class="item-gallery">
                <a href="{{ $urlHandler->getShow($item) }}" class="link-gallery">
                    <span class="thumbnail" @if($item->thumb != null && $item->thumb->board_thumbnail_path) style="background-image:url('{{ $item->thumb->board_thumbnail_path }}')" @endif></span>
                </a>
            </li>
        @endforeach
    </ul>
</section>
