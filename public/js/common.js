/**
 * Created by wy on 2017/2/10.
 */
$(function () {
    if ($('.error_info').hasClass('alert')) {
        $('.error_info').fadeOut(5000);
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