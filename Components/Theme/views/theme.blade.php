@extends($theme::view('frame'))

{{-- meta(viewport) --}}
{{ app('xe.frontend')->meta()->name('viewport')->content(
    'width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no'
)->load() }}

{{-- stylesheet --}}
{{ app('xe.frontend')->css([
    $_theme::asset('../../../assets/css/style.css'),
])->load() }}

{{-- script --}}
{{ app('xe.frontend')->js([
    $_theme::asset('../../../assets/images/common.js'),
])->appendTo('head')->load() }}
