@extends($theme::view('frame'))

@php
    $layoutType = ($config['layoutType']) ? $config['layoutType'] : 'sub';
@endphp

{{-- meta(viewport) --}}
{{ app('xe.frontend')->meta()->name('viewport')->content(
    'width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no'
)->load() }}

{{-- stylesheet --}}
{{ app('xe.frontend')->css([
    $_theme::asset('../../../assets/css/style.css'),
    $_theme::asset('../../../assets/css/style_icon.css'),
    $_theme::asset('../../../assets/libs/slick/slick.css')
])->load() }}

{{-- script --}}
{{ app('xe.frontend')->js([
    $_theme::asset('../../../assets/libs/slick/slick.min.js'),
    $_theme::asset('../../../assets/js/common.js'),
])->appendTo('head')->load() }}
