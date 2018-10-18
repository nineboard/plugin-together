@foreach ($docs as $doc)
<div>
    Revision NO : {{ $doc->revisionNo }}
    /
    Update date : {{ $doc->updated_at }}
</div>

<div class="board-contents">
    @foreach ($formColumns as $columnName)
        @if ($columnName == 'title')

            <h2 class="page-header">
                <p>[{{ $doc->instance_id }}]</p>
                {!! $doc->title !!}
                <small class="pull-right">Date: {{$doc->updated_at}}</small>
            </h2>
            <div class="content-right">
                <span class="xe-user" data-id="{{$doc->getUserId()}}">{!! $doc->writer !!}</span>
            </div>
        @elseif ($columnName == 'content')
            <div class="content" style="min-height: 300px;">
                {!! $doc->content !!}
            </div>
        @elseif (($fieldType = XeDynamicField::get($config->get('documentGroup'), $columnName)) != null)
            <div>
                {!! $fieldType->getSkin()->show($fieldType->getConfig(), $doc->getAttributes()) !!}
            </div>
        @endif
    @endforeach
</div>
@endforeach