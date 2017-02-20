
@section('title')
    {{'商品出库 '}}
@endsection

@extends('layouts.notice')

@extends('layouts.header')

@section('css')
    <link href="/css/store.css" rel="stylesheet">
@endsection

@section('content')

@section('h2_content')
    {{'商品出库 '}}
@endsection

@section('form')
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (count($goods))
        <form class="form-horizontal add-pro" action="/qty/stock" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{$goods['id']}}">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">鞋子名称</label>
                <div class="col-sm-10">
                    <input type="text" disabled value="{{$goods['name']}}" class="form-control" name="name"  id="inputEmail3" placeholder="鞋子名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">鞋子编码</label>
                <div class="col-sm-10">
                    <input type="text" disabled value="{{$goods['sku']}}"  class="form-control" name="sku" id="inputPassword3" placeholder="鞋子编码">
                </div>
            </div>
            <div class="form-group" id="thumb">
                <label for="inputPassword3" class="col-sm-2 control-label">商品图片</label>
                <div class="col-xs-3">
                    <img src="{{$goods['thumb']}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">价格</label>
                <div class="col-xs-2">
                    <input type="text" disabled value="{{$goods['price']}}" class="form-control" name="price" id="inputPassword3" placeholder="价格">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">店铺</label>
                <div class="col-xs-2">
                    <input type="text" disabled value="{{$goods['store']['store_name']}}" class="form-control" name="price" id="inputPassword3" placeholder="价格">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">鞋子颜色</label>

                <div class="col-xs-2">
                    <input type="text" disabled value="{{$goods['color']}}" class="form-control"  name="color" id="inputPassword3" placeholder="鞋子颜色">
                </div>
            </div>
            <div class="form-group ">
                <label for="inputPassword3" class="col-sm-2 control-label">库存数量</label>
                <div class="col-xs-2">
                    <input type="text" disabled='disabled' value="{{$goods['qty']}}"  class="form-control"  name="qty-db" value="1" placeholder="1">
                </div>
            </div>
            <div class="form-group validate-qty">
                <label for="inputPassword3" class="col-sm-2 control-label">出库数量</label>
                <div class="col-xs-2">
                    <input type="text" value="1"  class="form-control"  name="qty" value="1" placeholder="1">
                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="qty" data-bv-result="INVALID" style=""></small>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 ">
                    <button type="submit"  class="btn btn-primary col-xs-2 save-qty">出库</button>
                </div>
            </div>
        </form>
        @endif
@endsection


@section('notice_js')
    <script>
        $(function(){
            var inputQty = $("input[name='qty']");
            inputQty.blur(function () {
                var qty = '{{$goods["qty"]}}';
                var userQty = inputQty.val();
                var reg = /^[1-9]+$/;
                if (qty < parseInt(userQty) || ! reg.test(userQty)) {
                    $('.validate-qty').addClass('has-error');
                    $('.validate-qty small').html('只能输入数字或输入库存不能大于当前库存');
                    $('.save-qty').attr('disabled','disabled');
                } else {
                    $('.validate-qty').removeClass('has-error');
                    $('.validate-qty small').html('');
                    $('.save-qty').removeAttr('disabled');
                }
            })



        })
    </script>
@endsection