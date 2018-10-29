{{ XeFrontend::js('assets/core/xe-ui-component/js/xe-page.js')->appendTo('body')->load() }}

{{-- 공지사항 --}}
@include($_skin::view('_notice'))

<!-- board-header-tfc -->
<div class="board-header-tfc">
    <div class="box-manage reset-button">
        <!-- @TODO 게시글 관리 -->
        <button type="button" class="btn-manage">%게시글 관리</button>
        <button type="button" class="btn-align __xe-bd-mobile-sorting"><span class="icon_sort"></span><span class="text-align">{{xe_trans('xe::order')}} <span class="xi-caret-down-min"></span></span></button>
    </div>

    <div class="box-tool">
        <!-- @TODO 검색 -->
        <a href="#" class="link-search"><span class="xe-sr-only">%검색</span><i class="xi-search"></i></a>
        <a href="{{ $urlHandler->get('create') }}" class="link-write"><span class="xe-sr-only">{{ xe_trans('board::newPost') }}</span><i class="xi-pen-o"></i></a>
        <a href="{{ $urlHandler->managerUrl('config', ['boardId'=>$instanceId]) }}" class="link-set"><span class="xe-sr-only">{{ xe_trans('xe::manage') }}</span><i class="xi-cog"></i></a>
    </div>
</div>
<!-- // board-header-tfc -->

<!-- 타입별 class - type-gallery-tfc / type-thumbnail-tfc / type-text-tfc -->
<ul class="type-gallery-tfc list-board-tfc reset-list">
    @foreach($paginate as $item)
        <li class="item-board">
            <a href="{{$urlHandler->getShow($item, Request::all())}}" class="link-board">
                <span class="thumbnail" style="background-image:url('{{ $item->board_thumbnail_path }}')"></span>
                <div class="box-board">
                    <strong class="title-board">{!! $item->title !!}</strong>
                    <p class="text-board">{!! mb_substr($item->pure_content, 0, 100) !!}</p>
                    <div class="box-meta">
                        @if ($isManager === true)
                            <label class="xe-label">
                                <input type="checkbox" title="{{xe_trans('xe::select')}}" class="bd_manage_check" value="{{ $item->id }}">
                                <span class="xe-input-helper"></span>
                                <span class="xe-label-text xe-sr-only">{{xe_trans('xe::select')}}</span>
                            </label>
                        @endif

                        @foreach ($skinConfig['listColumns'] as $columnName)
                            @php $columnClassName = 'column-' . str_replace(['_at', '_'], ['', '-'], $columnName) @endphp
                            @if ($columnName == 'title')
                            @elseif ($columnName == 'writer')
                                {{-- 작성자 --}}
                                @if ($item->hasAuthor() && $config->get('anonymity') === false)
                                <button type="button" class="{{ $columnClassName }}"
                                    data-toggle="xe-page-toggle-menu"
                                    data-url="{{ route('toggleMenuPage') }}"
                                    data-data='{!! json_encode(['id'=>$item->getUserId(), 'type'=>'user']) !!}'>{!! $item->writer !!}</button>
                                @else
                                    <button type="button" class="{{ $columnClassName }}">{!! $item->writer !!}</button>
                                @endif
                                {{-- // 작성자 --}}
                            @elseif ($columnName == 'favorite')
                                @if(Auth::check() === true)
                                    <a href="#" data-url="{{$urlHandler->get('favorite', ['id' => $item->id])}}" class="{{ $columnClassName }} @if($item->favorite !== null) on @endif __xe-bd-favorite" title="{{xe_trans('board::favorite')}}"><i class="xi-star"></i><span class="xe-sr-only">{{xe_trans('board::favorite')}}</span></a>
                                @endif
                            @elseif ($columnName == 'read_count')
                                <span class="{{ $columnClassName }}">조회 {{ $item->read_count }}</span>
                            @elseif (in_array($columnName, ['created_at', 'updated_at', 'deleted_at']))
                                <span class="{{ $columnClassName }}" title="{{ $item->{$columnName} }}" @if($item->{$columnName}->getTimestamp() > strtotime('-1 month')) data-xe-timeago="{{ $item->{$columnName} }}" @endif >{{ $item->{$columnName}->toDateString() }}</span>
                            @elseif (($fieldType = XeDynamicField::get($config->get('documentGroup'), $columnName)) != null)
                                <span class="{{ $columnClassName }}">{!! $fieldType->getSkin()->output($columnName, $item->getAttributes()) !!}</span>
                            @else
                                <span class="{{ $columnClassName }}">{!! $item->{$columnName} !!}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>

{!! $paginate->render('together::components.Skins.Board.Together.views._paging') !!}

<div class="bd_dimmed"></div>
