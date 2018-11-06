<a href="#" data-toggle="xe-page-modal" data-url="{{ $urlHandler->get('votedModal', ['option' => $option, 'id' => $item->id]) }}" data-params="{}" data-callback="AssentVirtualGrid.init" class="link-profile">
    @foreach ($logs as $log)
        <span class="thumbnail" style="background-image:url('{{ $log->user->getProfileImage() }}')"></span>
    @endforeach
    좋아요 {{ number_format($item->assent_count) }}명
</a>
