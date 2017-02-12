
@section('title')
    {{'商品列表 '}}
@endsection

@section('css')
    <link href="/css/store.css" rel="stylesheet">
@endsection



@extends('layouts.header')


@section('content')
    <div style="margin: 40px 0 0;"></div>
    <div class="row list_store">
        <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
            <h2 class="page-header">店铺列表 <a href="/store"><button type="button" class="btn btn-info add-store">添加商品</button></a></h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>名称</th>
                            <th>店铺</th>
                            <th>货号</th>
                            <th>颜色</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td id="">ddffd</td>
                                <td id="">ddffd</td>
                                <td id="">ddffd</td>
                                <td>dffdfd</td>
                                <td>fdfd</td>
                                <td>fdfd</td>
                                <td>
                        <span href="" class="do_del" style="text-decoration:none;">
                            <span class="label label-info">编辑</span>
                            <span class="label label-danger">删除</span>
                        </span>
                                </td>
                            </tr>

                    </table>

                </div>
        </div>

    </div>

@endsection