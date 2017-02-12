<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="臻益家-库存管理系统">
    <meta name="author" content="wanfeiyy">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico">
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/app.css" rel="stylesheet">
    @yield('css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" style="color: #f7f3f3;">臻益家-库存管理系统</span>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @foreach ($navs as $nav)
                <li class="{{count($nav['children']) ? 'dropdown' : ''}}">
                    <a href="{{$nav['url']}}" {{count($nav['children']) ? "class=dropdown-toggle data-toggle=dropdown role=button aria-haspopup=true aria-expanded=false" :''}}>{{$nav['name']}}
                    @if (count($nav['children']))
                            <span class="caret"></span>
                    @endif
                    </a>
                    @if (count($nav['children']))
                    @foreach ($nav['children'] as $child)
                            <ul class="dropdown-menu">
                                <li><a href="{{$child['url']}}">{{$child['name']}}</a></li>
                            </ul>
                    @endforeach
                    @endif
                </li>
                @endforeach

            </ul>
            <!-- <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search..." />
            </form> -->
        </div>
    </div>
</nav>
@yield('content')
<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
@yield('js')
</body>
</html>