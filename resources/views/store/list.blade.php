@section('title')
    {{'店铺列表'}}
@endsection

@extends('layouts.header')

@section('css')
    <link href="/css/store.css" rel="stylesheet">
@endsection

@section('content')

<div class="row list_store">
    <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
        <h2 class="page-header">店铺列表 <a href="/store"><button type="button" class="btn btn-info add-store">添加店铺</button></a></h2>
        @if (count($stores))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>店铺名称</th>
                    <th>店铺地址</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($stores as $key => $store)
                <tr>
                    <td id="{{$store->id}}">{{$key + 1}}</td>
                    <td>{{$store->store_name}}</td>
                    <td>{{$store->store_address}}</td>
                    <td>{{$store->created_at}}</td>
                    <td>
                        <span href="" class="do_del" style="text-decoration:none;">
                            <span class="label label-info">编辑</span>
                            <span class="label label-danger">删除</span>
                        </span>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $stores->links() !!}
        </div>
        @else
        <h3>
            暂无店铺数据
        </h3>
        @endif
    </div>

</div>

@endsection

@section('js')
<script src="/alert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="/alert/dist/sweetalert.css">
<script>
    $(function () {
        var csrf = '{{csrf_token()}}'
        swalDel('.do_del .label-danger','/store/',csrf);
        $('.do_del .label-info').click(function () {
            var tr = $(this).parents('tr')
            var id = tr.find('td:first').attr('id')
            $.get('/store/'+id,function (msg) {
                var name = msg.store_name;
                var address = msg.store_address;
                var store_id = msg.id;
                swal({
                    title:"店铺编辑",
                    html:true,
                    showConfirmButton:false,
                    text:' <form  class="edit-store"  action="'+store_id+'" method="POST">\
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">\
                    <input type="hidden" name="_method" value="put">\
                        <div class="form-group">\
                            <label for="inputEmail3" class="">店铺名称</label>\
                            <input value='+name+' type="text" class="" name="name" id="inputEmail3" placeholder="">\
                        </div>\
                        <div class="form-group">\
                            <label for="inputPassword3" class="">店铺地址</label>\
                            <input value='+address+' type="text" class="" name="address" id="inputPassword3" placeholder="">\
                        </div>\
                        <div class="button">\
                        <span type="button" class="btn btn-primary edit-store">保存</span>\
                        </div>\
                        </form>'
                })
            })
        })
        $('body').on('click','.edit-store .edit-store',function (event) {
          var url = "/store/"+$('.edit-store').attr('action');
          ajax(url);
          $.ajax({
              data:$('.edit-store').serialize(),
              success: function(msg){
                  if (msg.code == '0000') {
                      swal("修改成功", "", "success");
                      setTimeout('swal.close()',800);
                      window.location.reload(true);
                  } else {
                      swal("修改失败", "", "error");
                      setTimeout('swal.close()',800);
                  }
              }
          });
      })


    })

</script>

@endsection