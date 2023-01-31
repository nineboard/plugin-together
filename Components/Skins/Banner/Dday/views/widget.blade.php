{{ XeFrontend::css('plugins/together/assets/css/widget.css')->load() }}
<section class="section-dday-tfcw">
    @foreach($items as $item)
        <a href="{{ url($item->link) }}" class="link-dday" style="background-image:url('{{ $item->imageUrl() }}')">
            <div class="inner-dday">
                <strong class="title-dday">{{ $item->title }}</strong>
                <div class="box-dday">
                    <span class="text-dday">{!!  nl2br($item->content) !!}</span>
                    <span class="num-dday">{{ $item->etc['diff'] }}</span>
                </div>
            </div>
        </a>
    @endforeach
</section>
