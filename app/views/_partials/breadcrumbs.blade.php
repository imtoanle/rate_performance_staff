@if ($crumbs)
    <ul class="breadcrumb">
        @foreach ($crumbs as $crumb)
            @if (!isset($crumb['last']))
                <li><a href="{{ $crumb['link'] }}">{{ $crumb['title'] }}</a></li>
            @else
                <li class="active">{{ $crumb['title'] }}</li>
            @endif
        @endforeach
    </ul>
@endif