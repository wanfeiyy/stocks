<div class="container-fluid">
<div style="margin: 40px 0 0;"></div>
<div class="row">
    <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
        <h2 class="page-header">@yield('h2_content')</h2>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert-warning error_info alert">{{ $error }}</div>
            @endforeach
        @endif
        @yield('form')
    </div>
</div>
</div>
@yield('notice_js')