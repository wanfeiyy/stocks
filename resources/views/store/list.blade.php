@section('title')
    {{'店铺列表'}}
@endsection

@extends('layouts.stocks')

@section('css')
    <link href="/css/store.css" rel="stylesheet">
@endsection

@section('content')

<div class="row list_store">
    <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
        <h2 class="page-header">店铺列表</h2>
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
    </div>

</div>

@endsection

@section('js')
<script src="/alert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="/alert/dist/sweetalert.css">
<script>
    $(function () {
        $('.do_del .label-danger').click(function () {
            var tr = $(this).parents('tr')
            var id = tr.find('td:first').attr('id')
            var csrf = '{{csrf_token()}}'
            swal({
                        title: "确定要删除?",
                        text: "删除将不能恢复!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定！",
                        cancelButtonText:'取消！',
                        closeOnConfirm: false
                    },
                    function(){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "/store/"+id,
                            global: false,
                            type: "POST"
                        });
                        $.ajax({
                            data:'_method=delete&_token='+csrf,
                            success: function(msg){
                                if (msg.code == 0000) {
                                    swal("删除成功", "", "success");
                                    setTimeout('swal.close()',800);
                                    tr.remove();
                                } else {
                                    swal("删除失败", "", "error");
                                    setTimeout('swal.close()',800);
                                }
                            }
                        });

                    });
            });

    })

</script>

@endsection