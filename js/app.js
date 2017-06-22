/**
 * Created by wwt on 2017/6/18.
 */

(function() {
    var host = 'http://127.0.0.1:4480';
    function isLogin(ele) {
        $.ajax({
            url: host + '/is_login',
            success: function (data) {
                if ('name' in data) {
                    ele.text(data.name);
                }
            }
        });
    }
    isLogin($('#li_user'));
    // $('.navbar .dropdown a').on('mouseenter', function () {
    //     $(this).next().show();
    // });
    // $('.navbar .dropdown a').on('mouseout', function () {
    //     $(this).next().hide();
    // });
    $('#form_login #bt_submit').click(function() {
        var user = $('#form_login input[name=username]').val();
        var pwd = $('#form_login input[name=password]').val();
        $.ajax({
            url: host + '/login',
            type: 'POST',
            data: {username: user, password: pwd},
            success: function (data) {
                console.log(data);
                if ('name' in data) {
                    $('#li_user').text(data.name);
                }
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