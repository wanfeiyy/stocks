
@extends('layouts.notice')


@extends('layouts.header')

@section('css')
    <link href="/css/store.css" rel="stylesheet">
@endsection

@section('content')

    @section('h2_content')
        {{'店铺添加'}}
    @endsection
    @section('form')
        <form class="form-horizontal from_group_my" action="store" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">店铺名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="店铺名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">店铺地址</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" id="inputPassword3" placeholder="店铺地址">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-primary add-store">添加</button>
                </div>
            </div>
        </form>
    @endsection
@endsection

@section('notice_js')
    <script>
        $(function () {

            $('.add-store').click(function () {
                $('.from_group_my').submit();
            })

        })
    </script>
@endsection