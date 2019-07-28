<ul>
    <li><a class="{{ Route::currentRouteName() == 'projects' ? 'active' : '' }}" href="{{ route('projects') }}">Projects</a></li>
    <li><a class="{{ Str::startsWith(Route::currentRouteName(), 'blog.') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
    <li><a class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
</ul>