<section class="section-latest-tfcw">
    <ul class="list-latest-tfc reset-list">
        @foreach ($list as $idx => $item)
            <li class="item-latest">
                <a href="{{ $urlHandler->getShow($item) }}" class="link-latest">
                    <span class="thumbnail" @if($item->getAuthor()->getProfileImage())style="background-image:url('{{ $item->getAuthor()->getProfileImage() }}')"@endif></span>
                    <div class="box-latest">
                        <strong class="title-latest">{{ $item->title }}</strong>
                        <span class="id">{{ $item->getAuthor()->getDisplayName() }}</span>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</section>
