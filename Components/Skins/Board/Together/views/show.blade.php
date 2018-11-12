<section class="board-view-tfc section-board-tfc">
    <div class="board-header">
        <h2 class="title-view">
            @if($item->status == $item::STATUS_NOTICE)
                <span class="category">{{ xe_trans('xe::notice') }}</span>
            @endif
            <span class="title">{!! $item->title !!}</span>
        </h2>

        {{-- meta --}}
        <div class="box-meta reset-button">
            <span class="item-meta column-category">{!! $item->boardCategory !== null ? xe_trans($item->boardCategory->categoryItem->word) : '' !!}</span>
            @if ($item->display == $item::DISPLAY_SECRET)
                <span class="item-meta column-lock"><button type="button"><i class="xi-lock"></i> <span class="blind-mobile">비밀글</span></button></span>
            @endif
            <span class="item-meta column-writer">
                <button type="button" data-toggle="xe-page-toggle-menu" data-url="{{ route('toggleMenuPage') }}" data-data='{!! json_encode(['id'=>$item->getUserId(), 'type'=>'user']) !!}'>{{ $item->writer }}</button></span>
            <span class="item-meta column-created" title="{{ $item->created_at }}"><i class="xi-time"></i> <span data-xe-timeago="{{ $item->created_at }}">{{ $item->created_at }}</span></span>
            @if($item->read_count) <span class="item-meta column-comment-count">조회 {{ number_format($item->read_count) }}</span> @endif
            @if($item->comment_count) <span class="item-meta column-reply-count">댓글 {{ number_format($item->comment_count) }}</span> @endif
            @if($item->asscent_count) <span class="item-meta column-assent-count">추천 {{ number_format($item->asscent_count) }}</span> @endif
        </div>
    </div>

    <div class="board-editor">
        {!! compile($item->instance_id, $item->content, $item->format === Xpressengine\Plugins\Board\Models\Board::FORMAT_HTML) !!}
    </div>

    <div class="board-footer">
        @if ($config->get('useTag') == true)
            <div class="board-tag">
                @foreach ($item->tags->toArray() as $tag)
                    <a href="{{ $urlHandler->get('index', ['searchTag' => $tag['word']], $item->instanceId) }}"><span class="link-tag">#{{ $tag['word'] }}</span></a>
                @endforeach
            </div>
        @endif

        @if (count($item->files) > 0)
            <div class="board-file reset-button">
                <div class="box-file">
                    <button type="button" class="btn-file"><i class="xi-paperclip"></i> {{ trans('board::fileAttachedList') }} {{ $item->data->file_count }}개</button>
                </div>
                <ul class="list-file reset-list" style="display: none;">
                    @foreach($item->files as $file)
                        <li class="item-file">
                            <a href="{{ route('editor.file.download', ['instanceId' => $item->instance_id, 'id' => $file->id])}}" class="link-file"><i class="xi-download"></i> {{ $file->clientname }} <span class="file_size">({{ bytes($file->size) }})</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="board-function reset-button">
            <div class="function-left">
                <button type="button" data-url="{{ $urlHandler->get('vote', ['option' => 'assent', 'id' => $item->id]) }}" class="btn-like @if($handler->hasVote($item, Auth::user(), 'assent') === true) active @endif"><i class="xi-heart-o"></i><span class="blind">{{ xe_trans('board::like') }}</span></button>
                <a href="#" data-url="{{ $urlHandler->get('votedUsers', ['option' => 'assent', 'id' => $item->id]) }}" class="xe-sr-only bd_like_num" data-id="{{$item->id}}">{{$item->assent_count}}</a>
                @if (Auth::check() === true)
                    <button type="button" data-url="{{$urlHandler->get('favorite', ['id' => $item->id])}}" class="btn-scrap bd_favorite __xe-bd-favorite @if($item->favorite !== null) active @endif __xe-bd-favorite"><i class="xi-star-o"></i><span class="blind">{{ trans('board::favorite') }}</span></button>
                @endif

                {{-- 공유 --}}
                {!! uio('share', [ 'item' => $item, 'url' => Request::url()]) !!}
            </div>

            <div class="function-right">
                @if($isManager == true || $item->user_id == Auth::user()->getId() || $item->user_type === $item::USER_TYPE_GUEST)
                    <a href="{{ $urlHandler->get('edit', array_merge(Request::all(), ['id' => $item->id])) }}" class="bd_ico bd_modify"><i class="xi-eraser"></i><span class="xe-sr-only">{{ xe_trans('xe::update') }}</span></a>
                    <a href="#" class="bd_ico bd_delete" data-url="{{ $urlHandler->get('destroy', array_merge(Request::all(), ['id' => $item->id])) }}"><i class="xi-trash"></i><span class="xe-sr-only">{{ xe_trans('xe::delete') }}</span></a>
                @endif
                <a href="{{ $urlHandler->get('index', array_merge(Request::all())) }}" class="link-list"><i class="xi-list"></i><span class="blind">목록 보기</span></a>
                <button type="button" class="btn-add" data-toggle="xe-page-toggle-menu" data-url="{{route('toggleMenuPage')}}" data-data='{!! json_encode(['id'=>$item->id,'type'=>'module/board@board','instanceId'=>$item->instance_id]) !!}' data-side="dropdown-menu-right"><i class="xi-ellipsis-v"></i><span class="blind">{{ xe_trans('xe::more') }}</span></button>
            </div>
            <div class="area-like" id="area-like-more{{$item->id}}" data-id="{{$item->id}}">
            </div>
        </div>
    </div>

    <div class="board-footer">
        <!-- 댓글 -->
        @if ($config->get('comment') === true && $item->boardData->allow_comment === 1)
            <div class="__xe_comment board_comment">
                {!! uio('comment', ['target' => $item]) !!}
            </div>
        @endif
        <!-- // 댓글 -->
    </div>
</section>

@if (isset($withoutList) === false || $withoutList === false)
    <!-- 리스트 -->
    @include($_skinPath . '/views/index')
@endif
