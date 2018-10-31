{{-- script --}}
{{ app('xe.frontend')->js([
    $_skin::asset('js/together.js'),
])->appendTo('head')->load() }}

<!-- board-notice-tfc -->
<div class="board-notice-tfc">
    <h2 class="title-notice">{{ $config->get('page_title') }}</h2>

    <!-- slide_zone -->
    <div class="area-slide">
        {{-- 공지사항 목록 --}}
        @foreach($notices as $item)
            <div class="item-slide">
                <a href="{{$urlHandler->getShow($item, Request::all())}}" class="link-slide">
                    <span class="thumbnail" @if($item->board_thumbnail_path) style="background-image:url('{{ $item->board_thumbnail_path }}')"@endif></span>
                    <div class="box-board">
                        <strong class="title-board">
                            {{-- 글 제목 --}}
                            {!! $item->title !!}
                            {{-- new 아이콘 --}}
                            @if($item->isNew($config->get('newTime')))
                                <span><i class="xi-new"></i><span class="xe-sr-only">new</span></span>
                            @endif
                        </strong>
                        {{-- 글 요약문 --}}
                        <p class="text-board">{!! mb_substr($item->pure_content, 0, 200) !!}</p>
                    </div>
                </a>

                <div class="box-meta reset-button">
                    @if ($isManager === true)
                        <span>
                            <label class="xe-label">
                                <input type="checkbox" title="{{xe_trans('xe::select')}}" class="bd_manage_check" value="{{ $item->id }}">
                                <span class="xe-input-helper"></span>
                                <span class="xe-label-text xe-sr-only">{{xe_trans('xe::select')}}</span>
                            </label>
                        </span>
                    @endif

                    <span class="item-meta column-lock"><button type="button"><i class="xi-lock"></i> <span class="blind-mobile">비밀글</span></button></span>
                    <span class="item-meta column-file"><button type="button"><i class="xi-paperclip"></i> <span class="blind-mobile">첨부파일</span></button></span>

                    {{-- 게시판 출력 순서 항목 --}}
                    @foreach ($skinConfig['listColumns'] as $columnName)
                        {{-- $columnClassName: class 속성에 사용될 이름 --}}
                        @php $columnClassName = 'item-meta column-' . str_replace(['_at', '_'], ['', '-'], $columnName) @endphp

                        @if ($columnName == 'title')
                            {{-- 글 제목은 별도로 표시하므로 여기에는 표시하지 않음 --}}
                        @elseif ($columnName == 'writer')
                            {{-- 작성자 --}}
                            <span class="{{ $columnClassName }}">
                                @if ($item->hasAuthor() && $config->get('anonymity') === false)
                                <button type="button"
                                    data-toggle="xe-page-toggle-menu"
                                    data-url="{{ route('toggleMenuPage') }}"
                                    data-data='{!! json_encode(['id'=>$item->getUserId(), 'type'=>'user']) !!}'>{!! $item->writer !!}</button>
                                @else
                                    <button type="button" class="{{ $columnClassName }}">{!! $item->writer !!}</button>
                                @endif
                            </span>
                        @elseif ($columnName == 'favorite')
                            {{-- 즐겨찾기 --}}
                            @if(Auth::check() === true)
                                <span class="{{ $columnClassName }}"><button type="button" data-url="{{$urlHandler->get('favorite', ['id' => $item->id])}}" @if($item->favorite !== null) on @endif __xe-bd-favorite" title="{{xe_trans('board::favorite')}}"><i class="xi-star-o"></i> <span class="blind-mobile">{{ xe_trans('board::favorite') }}</span></button></span>
                                {{-- <span class="{{ $columnClassName }}">
                                    <button type="button" data-url="{{$urlHandler->get('favorite', ['id' => $item->id])}}" @if($item->favorite !== null) on @endif __xe-bd-favorite" title="{{xe_trans('board::favorite')}}">
                                        <i class="xi-star"></i><span class="xe-sr-only">{{xe_trans('board::favorite')}}</span>
                                    </button>
                                </span> --}}
                            @endif
                        @elseif ($columnName == 'read_count')
                            {{-- 조회수 --}}
                            <span class="{{ $columnClassName }}">조회 {{ $item->read_count }}</span>
                        @elseif (in_array($columnName, ['created_at', 'updated_at', 'deleted_at']))
                            {{-- 작성일 등 날짜 --}}
                            <span class="{{ $columnClassName }}" title="{{ $item->{$columnName} }}" @if($item->{$columnName}->getTimestamp() > strtotime('-1 month')) data-xe-timeago="{{ $item->{$columnName} }}" @endif >{{ $item->{$columnName}->toDateString() }}</span>
                        @elseif (($fieldType = XeDynamicField::get($config->get('documentGroup'), $columnName)) != null)
                            {{-- Dynamic Fields --}}
                            <span class="{{ $columnClassName }}">{!! $fieldType->getSkin()->output($columnName, $item->getAttributes()) !!}</span>
                        @else
                            {{-- 기타 지정되지 않은 항목 --}}
                            <span class="{{ $columnClassName }}">{!! $item->{$columnName} !!}</span>
                        @endif
                    @endforeach
                    {{-- // 게시판 출력 순서 항목 --}}
                </div>
            </div>
        @endforeach
        {{-- // 공지사항 목록 --}}
    </div>
    <!-- // slide_zone -->
</div>
<!-- // board-notice-tfc -->
