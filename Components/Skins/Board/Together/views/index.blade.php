{{ XeFrontend::js('assets/core/xe-ui-component/js/xe-page.js')->appendTo('body')->load() }}

{{-- 공지사항 --}}
@include($_skin::view('_notice'))

<!-- board-header-tfc -->
<div class="board-header-tfc">
    <div class="box-manage reset-button">
        <div class="xe-form-inline xe-hidden-xs board-sorting-area __xe-forms">
            {{-- 게시글 관리 --}}
            <button type="button" class="xe-btn xe-btn-primary-outline bd_manage __xe-bd-manage btn-manage">{{ xe_trans('xe::manage') }}</button>

            {{-- 카테고리 --}}
            @if($config->get('category') == true)
            {!! uio('uiobject/board@select', [
                'name' => 'category_item_id',
                'label' => xe_trans('xe::category'),
                'value' => Request::get('category_item_id'),
                'items' => $categories,
            ]) !!}
            @endif

            {{-- 정렬 --}}
            {!! uio('uiobject/board@select', [
                'name' => 'order_type',
                'label' => xe_trans('xe::order'),
                'value' => Request::get('order_type'),
                'items' => $handler->getOrders(),
            ]) !!}
        </div>
    </div>

    <div class="box-tool">
        <!-- @TODO 검색 -->
        <a href="#" class="link-search bd_search __xe-bd-search"><span class="xe-sr-only">{{ xe_trans('xe::search') }}</span><i class="xi-search"></i></a>
        <a href="{{ $urlHandler->get('create') }}" class="link-write"><span class="xe-sr-only">{{ xe_trans('board::newPost') }}</span><i class="xi-pen-o"></i></a>
        <a href="{{ $urlHandler->managerUrl('config', ['boardId'=>$instanceId]) }}" class="link-set"><span class="xe-sr-only">{{ xe_trans('xe::manage') }}</span><i class="xi-cog"></i></a>
    </div>

    <!-- 게시글 관리 -->
    @if ($isManager === true)
    <div class="bd_manage_detail">
        <div class="xe-row">
            <div class="xe-col-sm-6">
                <div class="xe-row __xe_copy">
                    <div class="xe-col-sm-3">
                        <label class="xe-control-label">{{ xe_trans('xe::copy') }}</label>
                    </div>
                    <div class="xe-col-sm-9">
                        <div class="xe-form-inline">
                            {!! uio('uiobject/board@select', [
                                'name' => 'copyTo',
                                'label' => xe_trans('xe::select'),
                                'items' => $boardList,
                            ]) !!}
                            <button type="button" class="xe-btn xe-btn-primary-outline __xe_btn_submit" data-url="{{ $urlHandler->managerUrl('copy') }}">{{ xe_trans('xe::copy') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xe-row">
            <div class="xe-col-sm-6">
                <div class="xe-row __xe_move">
                    <div class="xe-col-sm-3">
                        <label class="xe-control-label">{{ xe_trans('xe::move') }}</label>
                    </div>
                    <div class="xe-col-sm-9">
                        <div class="xe-form-inline">
                            {!! uio('uiobject/board@select', [
                                'name' => 'moveTo',
                                'label' => xe_trans('xe::select'),
                                'items' => $boardList,
                            ]) !!}
                            <button type="button" class="xe-btn xe-btn-primary-outline __xe_btn_submit" data-url="{{ $urlHandler->managerUrl('move') }}">{{ xe_trans('xe::move') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xe-row">
            <div class="xe-col-sm-6">
                <div class="xe-row __xe_to_trash">
                    <div class="xe-col-sm-3">
                        <label class="xe-control-label">{{ xe_trans('xe::trash') }}</label>
                    </div>
                    <div class="xe-col-sm-9">
                        <a href="#" data-url="{{ $urlHandler->managerUrl('trash') }}" class="xe-btn-link __xe_btn_submit">{{ xe_trans('board::postsMoveToTrash') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="xe-row">
            <div class="xe-col-sm-6">
                <div class="xe-row __xe_delete">
                    <div class="xe-col-sm-3">
                        <label class="xe-control-label">{{ xe_trans('xe::delete') }}</label>
                    </div>
                    <div class="xe-col-sm-9">
                        <a href="#" data-url="{{ $urlHandler->managerUrl('destroy') }}" class="xe-btn-link __xe_btn_submit">{{ xe_trans('board::postsDelete') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- /게시글 관리 -->
</div>
<!-- // board-header-tfc -->

<!-- 타입별 class - type-gallery-tfc / type-thumbnail-tfc / type-text-tfc -->
@php
    $listType = ($skinConfig['listType']) ? $skinConfig['listType'] : 'text';
@endphp

<ul class="type-{{ $listType }}-tfc list-board-tfc reset-list">
    @foreach($paginate as $item)
        <li class="item-board">
            <a href="{{$urlHandler->getShow($item, Request::all())}}" class="link-board">
                <span class="thumbnail" @if($item->board_thumbnail_path && $item->display !== $item::DISPLAY_SECRET) style="background-image:url('{{ $item->board_thumbnail_path }}')" @endif></span>
                <div class="box-board">
                    <strong class="title-board">{!! $item->title !!}</strong>
                    <p class="text-board">{!! mb_substr($item->pure_content, 0, 100) !!}</p>
                </div>
            </a>

            <div class="box-meta reset-button">
                @if ($isManager === true)
                    <div class="select">
                        <label class="xe-label">
                            <input type="checkbox" title="{{xe_trans('xe::select')}}" class="bd_manage_check" value="{{ $item->id }}">
                            <span class="xe-input-helper"></span>
                            <span class="xe-label-text xe-sr-only">{{xe_trans('xe::select')}}</span>
                        </label>
                    </div>
                @endif

                @if ($item->display == $item::DISPLAY_SECRET)
                    <span class="item-meta column-lock"><i class="xi-lock"></i> <span class="blind-mobile">비밀글</span></span>
                @endif
                @if(count($item->files) > 0)
                    <span class="item-meta column-file"><i class="xi-paperclip"></i> <span class="blind-mobile">첨부파일</span></span>
                @endif

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
                                {!! $item->writer !!}
                            @endif
                        </span>
                    @elseif ($columnName == 'favorite')
                        {{-- 즐겨찾기 --}}
                        @if(Auth::check() === true)
                            <span class="{{ $columnClassName }}"><button type="button" data-url="{{$urlHandler->get('favorite', ['id' => $item->id])}}" class="@if($item->favorite !== null) active @endif __xe-bd-favorite" title="{{xe_trans('board::favorite')}}"><i class="xi-star-o"></i> <span class="blind-mobile">{{ xe_trans('board::favorite') }}</span></button></span>
                            {{-- <span class="{{ $columnClassName }}">
                                <button type="button" data-url="{{$urlHandler->get('favorite', ['id' => $item->id])}}" @if($item->favorite !== null) on @endif __xe-bd-favorite" title="{{xe_trans('board::favorite')}}">
                                    <i class="xi-star"></i><span class="xe-sr-only">{{xe_trans('board::favorite')}}</span>
                                </button>
                            </span> --}}
                        @endif
                    @elseif ($columnName == 'read_count')
                        {{-- 조회수 --}}
                        <span class="{{ $columnClassName }}">조회 {{ number_format($item->read_count) }}</span>
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
        </li>
    @endforeach
</ul>

{!! $paginate->render('together::components.Skins.Board.Together.views._paging') !!}

<div class="bd_dimmed"></div>
