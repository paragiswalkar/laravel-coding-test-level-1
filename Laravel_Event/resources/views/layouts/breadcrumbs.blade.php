<section class="content-header">
    @php $route = Route::currentRouteName() @endphp
    @php $index = substr($route, 0, strrpos($route, '.') + 1) . 'index' @endphp
    <div class="container-fluid" aria-label="breadcrumbs">
        <ul class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard') }}</a></li>
            @if (strpos($route, 'root') === false && Route::has($index))
                @php $isIndex = strpos($route, 'index') !== false @endphp
                @php $parent_text= __($isIndex ? $route : $index) @endphp
                <li class="breadcrumb-item {{ $isIndex ? 'is-active' : '' }}">
                    @if($isIndex)
                        <a href="#" aria-current="page">{{ empty($t) ? $parent_text : $t }}</a>
                    @else
                        <a href="{{ route($index) }}">{{ $parent_text }}</a>
                    @endif
                </li>
                @if(!$isIndex)<li class="breadcrumb-item is-active"><a href="#" aria-current="page">{{ empty($t) ? __($route) : $t }}</a></li>@endif
            @endif
        </ul>
    </div>
</section>