<div class="tnm-widget-container type-about">
    <h2 class="widget-title"><em>About US</em></h2>
    <div class="tnm-widget">
        <ul>
            @foreach($items as $item)
                <li class="item">
                    <span class="cover-image" style="background-image:url('{{ $item->imageUrl() }}')"></span>
                    <div class="box-content">
                        <strong>{{ $item->title }}</strong>
                        <p>{!!  nl2br($item->content) !!}</p>
                        <a href="{{ url($item->link) }}" target="{{ $item->link_target }}">Read More</a>
                    </div>
                </li>
                @endforeach
        </ul>
    </div>
</div>
