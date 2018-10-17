@extends($theme::view('frame'))

TOGETHER.theme

{{-- meta(viewport) --}}
{{ app('xe.frontend')->meta()->name('viewport')->content(
    'width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no'
)->load() }}

{{-- stylesheet --}}
{{ app('xe.frontend')->css([
    asset('plugins/the_next_magazine/assets/tnm.css'),
    asset('plugins/the_next_magazine/assets/tnm-widget.css'),
    // asset('plugins/the_next_magazine/assets/style.css'),
    // asset('plugins/the_next_magazine/assets/postBtn.css'),
])->load() }}

{{-- script --}}
{{ app('xe.frontend')->js([
    asset('plugins/the_next_magazine/assets/common.js'),
])->appendTo('head')->load() }}

@if($config->get('logoImageWithBg.path'))
    {{ app('xe.frontend')->preload()
        ->href($config->get('logoImageWithBg.path'))
        ->as('image')
        ->load()
    }}
@endif
