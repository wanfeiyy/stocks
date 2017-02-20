/**
 * Created by wy on 2017/2/10.
 */
$(function () {
    if ($('.error_info').hasClass('alert')) {
        $('.error_info').fadeOut(3000);
    }

    if ($('.alert-success').hasClass('alert')) {
        $('.alert-success').fadeOut(3000);
    }
})


function ajax(url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        global: false,
        type: "POST"
    });
}

//初始化fileinput控件（第一次初始化）
function initFileInput(ctrlName, uploadUrl) {
    var control = $('#' + ctrlName);
    control.fileinput({
        showUpload: true,
        language:'zh',
        allowedFileExtensions : ['jpg','png','gif'],
        uploadAsync:true,
        dropZoneEnabled:false,
        uploadUrl:uploadUrl,
        maxFileCount: 1,
        maxImageWidth: 2048,
        maxImageHeight: 1024,
        resizeImage: false,
        showCaption: false,
        showPreview: true,
        browseClass: "btn btn-primary btn-lg",
    });
    return control;
}


function swalDel(el,url,csrf) {
    $(el).click(function () {
        var tr = $(this).parents('tr')
        var id = tr.find('td:first').attr('id')
        swal({
            title: "确定要删除?",
            text: "删除将不能恢复!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定！",
            cancelButtonText:'取消！',
            loseOnConfirm: false
        },function(){
            ajax(url+id);
            $.ajax({
                data:'_method=delete&_token='+csrf,
                success: function(msg){
                    if (msg.code == '0000') {
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
}