@extends('layouts.stocks')

@section('css')
    <link href="css/store.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div style="margin: 40px 0 0;"></div>
        <div class="row">
            <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
                <h2 class="page-header">店铺添加</h2>
                <div class="alert-warning error_info "></div>
                <form class="form-horizontal from_group_my">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺名称</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="店铺名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">店铺地址</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="店铺地址">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-primary">添加</button>
                        </div>
                    </div>
                </form>
                <div style="margin: 25px 0 0;border-bottom: 1px solid #eee;"></div>
            </div>
        </div>
    </div>
@endsection