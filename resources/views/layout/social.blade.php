<ul class="social">
    @foreach(\App\Classes\Helpers::setting('general_social', []) as $item)
        <li><a href="{{ $item['url'] }}" target="_blank" title="{{ $item['name'] }}"><i class="{{ $item['icon'] }}"></i></a></li>
    @endforeach
</ul>
