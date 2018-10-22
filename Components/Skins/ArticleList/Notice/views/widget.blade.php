<section class="section-notice-tfcw">
    <h3 class="title-h3"><span>{{ $widgetConfig['@attributes']['title'] }}</span></h3>
    <ul class="list-notice-tfc reset-list">
        @foreach ($list as $idx => $item)
            <li class="item-notice">
                <a href="{{ $urlHandler->getShow($item) }}" class="link-notice">
                    <strong class="title-notice">{{ $item->title }}</strong>
                    <p class="text-notice">{!!  nl2br($item->pure_content) !!}</p>
                    <div class="box-notice">
                        <span class="count">조회수 {{ $item->read_count }}</span>
                        <span class="date" data-xe-timeago="{{ $item->created_at }}" title="{{ $item->created_at }}">{{ $item->created_at }}</span>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</section>
