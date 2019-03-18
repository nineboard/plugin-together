<footer class="footer-tfc">
    <div class="inner-footer">
        @if($config->get('useCopyright') !== 'N')
            @if(trim($config->get('copyrightContent')))
                <small>{!! $config->get('copyrightContent') !!}</small>
            @else
                Powered by <a href="https://www.xpressengine.io/" target="_blank">XpressEngine</a>.
            @endif
        @endif
    </div>
</footer>
