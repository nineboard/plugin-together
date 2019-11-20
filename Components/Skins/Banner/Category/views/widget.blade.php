{{ XeFrontend::css('plugins/together/assets/css/widget.css')->load() }}
<section class="section-category-tfcw">
    <ul class="list-category-tfc reset-list">
        @foreach($items as $item)
        <li class="item-category">
            <a href="{{ url($item->link) }}" target="{{ $item->link_target }}" class="link-category">
                <span class="thumbnail" style="background-image:url('{{ $item->imageUrl() }}')"></span>
                <strong class="title-category"><span>{{ $item->title }}</span></strong>
                <p class="text-category">{!!  nl2br($item->content) !!}</p>
            </a>
        </li>
        @endforeach
    </ul>
</section>
