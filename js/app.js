/**
 * Created by wwt on 2017/6/18.
 */

(function() {
    $('#form_login #bt_submit').click(function() {
        var user = $('#form_login input[name=username]').val();
        var pwd = $('#form_login input[name=password]').val();
        $.ajax({
            url: 'http://127.0.0.1/login',
            type: 'POST',
            data: {username: user, password: pwd},
            success: function (data) {
                console.log(data);
            },
            error: function (e) {
                if (e.responseJSON) {
                    var msg = e.responseJSON.error;
                } else {
                    var msg = '服务器错误';
                }
                alert(msg);
            }
        })
    });
}());