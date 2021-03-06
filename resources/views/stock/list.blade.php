
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
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert-warning error_info alert">{{ $error }}</div>
                @endforeach
            @endif
            <h2 class="page-header">商品列表
                <a href="/stock/create">
                    <button type="button" class="btn btn-info add-store">添加商品</button>
                </a>
                <div class="search" >
                <form class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword3">店铺</label>
                        <select class="form-control" name="store_id" name="store_id">
                            <option value="0">所有店铺</option>
                            @foreach ($stores as $store)
                                <option value="{{$store->id}}" {{isset($search['store_id']) && $search['store_id'] == $store->id ?'selected':'' }}>{{$store->store_name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail3">货号</label>
                        <input type="text" value="{{isset($search['sku']) ? $search['sku'] : ''}}" name="sku" class="form-control" id="exampleInputEmail3" placeholder="货号">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword3">颜色</label>
                        <input type="text" value="{{isset($search['color']) ? $search['color'] : ''}}" name="color" class="form-control" id="exampleInputPassword3" placeholder="颜色">
                    </div>

                    <button type="submit" class="btn btn-default sumbit-search">搜索</button>
                </form>
                </div>
            </h2>

            @if (count($goods) && count($stores))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>名称</th>
                            <th>店铺</th>
                            <th>货号</th>
                            <th>颜色</th>
                            <th>库存</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($goods as $good)
                                <tr>
                                    <td id="{{$good->id}}"><img width="60px" src = {{$good->thumb}}></td>
                                    <td id="">{{$good->name}}</td>
                                    <td id="">{{$good->store->store_name}}</td>
                                    <td>{{$good->sku}}</td>
                                    <td>{{$good->color}}</td>
                                    <td>{{$good->qty}}</td>
                                    <td>{{$good->created_at}}</td>
                                    <td>
                            <span href="" class="do_del" style="text-decoration:none;">
                                <span class="label label-info qty-stock">出库</span>
                                <span class="label label-info">编辑</span>
                                <span class="label label-danger">删除</span>
                            </span>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                    {!! $goods->links() !!}
                </div>
            @else
                <h3>暂无数据</h3>
            @endif
        </div>

    </div>

@endsection

@section('js')
    <script src="/alert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/alert/dist/sweetalert.css">
    <script>
        $(function () {
            $('.submit-search').click(function () {
                $wheres = $('.search form').serialize();
                window.location.href ='/stock?'+$wheres;
            })

            var csrf = '{{csrf_token()}}'
            swalDel('.do_del .label-danger','/stock/',csrf);

            $('.do_del .label-info').click(function () {
                var tr = $(this).parents('tr')
                var id = tr.find('td:first').attr('id')
                window.location.href = '/stock/'+id+'/edit';
            })

            $('.do_del .qty-stock').click(function () {
                var tr = $(this).parents('tr')
                var id = tr.find('td:first').attr('id')
                window.location.href = '/qty/stock/'+id;
            })
        })
    </script>
@endsection