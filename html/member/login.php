<? 
  include "../outline/_header.php";
  $curl = $_GET['curl'];
?>

<div class="col-lg-12 col-sm-12 col-xs-12 thecenter-l pd-lg-t80 pd-lg-b80 pd-sm-t80 pd-sm-b80 pd-xs-t80 pd-xs-b80 gmarket-l">
   <section class="col-lg-12 col-sm-12 col-xs-12 text-sm-center">
      <img src="../img/sub_title.png" class="width-xs-100 cursor" onclick="pageMove('../')">
   </section>
   <section class="col-lg-4 col-sm-12 col-xs-12 text-lg-right text-sm-center mg-lg-l100 mg-lg-t50 mg-sm-t50 mg-xs-t30">
      <img src="../img/title_login.jpg" class="width-xs-50">
   </section>
   <section class="col-lg-6 col-sm-12 col-xs-12 text-lg-left mg-lg-t50 mg-sm-t50 mg-xs-t30">
        <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">E-mail<br><span class="c4">이메일</span></label>
         <input type="email" name="email" value="" placeholder="" class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 mg-xs-b30">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b">Password<br><span class="c4">비밀번호</span></label>
         <input type="password" name="password" value="" placeholder="" class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 inp_bg">
      </div>
      <div class="layout-body mg-sm-b10 pd-xs-0 pd-sm-0 pd-lg-0">
         <label class="col-lg-2 col-sm-3 col-xs-12 pd-xs-0 c1 text-sm-right text-xs-left gmarket-b hidden-xs"><br><span class="c4"></span></label>
         <div class="col-sm-6 col-xs-12 mg-sm-l10 mg-xs-l0 pd-xs-0 pd-sm-0 pd-lg-0">
            <p class="float-l line-height-1_4">
               <a href="./register.php" class="c1">Create a new account</a><br>
               <!--<span>새 계정 만들기</span>-->
            </p>
            <button class="float-r mg-sm-l10 mg-xs-l10" id="commit" onclick="Login()">Login</button>
            <button class="float-r mg-sm-l10 mg-xs-l0" id="cancel" onclick="pageMove('../')">cancel</button>
        </div>
     </div>
   </section>
</div>

<? include "../outline/_footer.php"; ?>

<script type="text/javascript">
    var curl = '<?=$curl?>';
    var rurl = aUrl(curl);
    
    $(document).ready(function() {
        // Enter Key Event
        $('input[name=password]').keydown(function(event) {
            if(event.keyCode == 13) {
                Login();
            }
        });
    })

    // Login
    function Login() {
      var email = $('input[name=email]').val();
      var password = $('input[name=password]').val();

      if(email == '') {
         open_alert_popup('Please input your email.', '', 2000);
        $('input[name=email]').focus();
      } else if(password == '') {
         open_alert_popup('Please input your password.', '', 2000);
        $('input[name=password]').focus();
      } else {
         $.ajax({
            url: '../ajax/ajax.member.php',
            type:'post',
            dataType:'json',
            data:{
               type:"login_user",
               email:email,
               password:password,
               table:'member'
            },
            success: function(data) {
               if(data.result == "true") {
                  $('.preloader').hide();
                  setCookie('m_no', bUrl(data.m_no), 1);
                  setCookie('m_id', bUrl(data.m_id), 1);
                  setSession('m_no', bUrl(data.m_no));
                  setSession('m_id', bUrl(data.m_id));
                  pageMove(rurl);
               } else {
                  $('.preloader').hide();
                  open_alert_popup(data.message, '', 2000);
                  // console.log(data.message);
               }
            }, error:function(request,status,error) {
               $('.preloader').hide();
                // alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
        });
      }
   }
</script>