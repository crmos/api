<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    @if(isset($bread_crums))
        @foreach($bread_crums as $bread_name => $bread_link)
            <li class="breadcrumb-item">
                <a href="{{$bread_link}}">
                    {{$bread_name}}
                </a>
            </li>
        @endforeach
    @endif

    @if(isset($active_page))
        <li class="breadcrumb-item active">{{$active_page}}</li>
    @endif
</ol>
