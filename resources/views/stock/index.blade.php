
@section('title')
    {{'商品添加 '}}
@endsection

@extends('layouts.header')

@section('css')
    <link href="//cdn.bootcss.com/bootstrap-fileinput/4.3.3/css/fileinput.min.css" rel="stylesheet">

@endsection

@section('content')
    @extends('layouts.notice')
    @section('h2_content')
        {{'商品添加'}}
    @endsection
    @section('form')
        <form class="form-horizontal add-pro" action="/stock" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">鞋子名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name"  id="inputEmail3" placeholder="鞋子名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">鞋子编码</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="sku" id="inputPassword3" placeholder="鞋子编码">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">价格</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" name="price" id="inputPassword3" placeholder="价格">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">店铺选择</label>
                <div class="col-xs-3">
                    <select class="form-control" name="store_id">
                        @foreach ($stores as $store)
                        <option value="{{$store->id}}">{{$store->store_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">图片上传</label>
                <div class="col-xs-4">
                   <input id="input-1" name="file" type="file" value="" class="file file-input">
                   <input id="input-2"  name="thumb" type="hidden" value="" class="file">
                   <input id="input-3"  name="image" type="hidden" value="" class="file">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">鞋子颜色</label>

                <div class="col-xs-2">
                    <input type="text" class="form-control"  name="color" id="inputPassword3" placeholder="鞋子颜色">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">库存</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control"  name="qty" value="1" placeholder="1">
                </div>
            </div>




            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 ">
                    <button type="submit" class="btn btn-primary col-xs-2 save-pro">保存</button>
                </div>
            </div>
        </form>
    @endsection
@endsection
@section('js')
    <script src="//cdn.bootcss.com/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap-fileinput/4.3.3/js/fileinput.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap-fileinput/4.3.3/js/locales/zh.min.js"></script>
    <script>
        $(function () {
            $('.add-pro').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        message: '用户名验证失败',
                        validators: {
                            notEmpty: {
                                message: '鞋子名称不能为空'
                            }
                        }
                    },
                    sku: {
                        message: '鞋子编码验证失败',
                        validators: {
                            notEmpty: {
                                message: '鞋子编码不能为空'
                            }
                        }
                    },
                    price: {
                        message: '价格验证失败',
                        validators: {
                            notEmpty: {
                                message: '价格不能为空'
                            },
                            numeric: {
                                message: '价格只能为数字'
                            }
                        },
                    },
                    qty: {
                        message: '库存验证失败',
                        validators: {
                            notEmpty: {
                                message: '库存不能为空'
                            },
                            numeric: {
                                message: '库存只能为数字'
                            }
                        },
                    },
                    store: {
                        message: '店铺验证失败',
                        validators: {
                            notEmpty: {
                                message: '店铺不能为空'
                            }
                        }
                    }
                }
            });

            $('.save-pro').click(function () {
                $('.add-pro').submit();
            })
        });
        var fileInput = initFileInput("input-1", "/file");
        fileInput.on("filebatchselected", function(event, files) {
           // $(this).fileinput("upload");
        }).on("fileuploaded", function(event, data) {
            var response = data.response;
            if (response.state == 0) {
                $('#input-3').val(response.data.imageName);
                $('#input-2').val(response.data.thumb);
            }

        });

    </script>
@endsection