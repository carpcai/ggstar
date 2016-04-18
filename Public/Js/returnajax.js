$(function() {
    $('#submit').bind('click', function() {

        var formData = $('#ajaxForm').serialize();
        //.serialize() 方法创建以标准 URL 编码表示的文本字符串

        $.ajax({
            type : "POST",
            url  : "{:U(\'Index/voting\')}",  
            cache : false,
            data : formData,
            success : onSuccess,
            error : onError
        });
        return false;
    });
});

function onSuccess(data,status){
    data = $.trim(data); //去掉前后空格
    $('#notification').text(data);
}

function onError(data,status){
    //进行错误处理
}
