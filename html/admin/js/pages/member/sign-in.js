$(document).ready(function() {
    // body class
    $('body').addClass('login-page');
    
    var loginChk = LoginCheck();
    if(loginChk) {
        pageMove('../main/main.php');
    }

    $('#sign_in').validate({
        highlight: function (input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
})

 // Login
function Login() {
    var email = $('input[name=email]').val();
    var password = $('input[name=password]').val();

    if(email == '') {
        showBasicMessage('Please input your email.');
        $('input[name=email]').focus();
    } else if(password == '') {
        showBasicMessage('Please input your password.');
        $('input[name=password]').focus();
    } else {
        $.ajax({
            url: '../../ajax/ajax.member.php',
            type:'post',
            dataType:'json',
            data:{
            type:"login_user",
            email:email,
            password:password,
            table:'member'
            }, success: function(data) {
                if(data.result == "true") {
                    setCookie('m_no', bUrl(data.m_no), 1);
                    setCookie('m_id', bUrl(data.m_id), 1);
                    setSession('m_no', bUrl(data.m_no));
                    setSession('m_id', bUrl(data.m_id));
                    pageMove('../../modules/main/main.php');
                } else {
                    showBasicMessage(data.message);
                }
            }, error:function(request,status,error) {
                // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
        });
    }
}