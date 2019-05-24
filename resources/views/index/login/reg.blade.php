<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>铄珠宝</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/index/css/style.css" rel="stylesheet">
    <link href="/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
        <meta name="csrf-token" content="{{csrf_token()}}">
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('login/zhece')}}" method="get" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" id="q" name="l_tel" placeholder="输入手机号码或者邮箱号"id="phone" /></div>
       <div class="lrList2"><input type="text" name="l_yzm" placeholder="输入短信验证码"  /> <input type="button" value="获取验证码" id="yzm"></div>
       <div class="lrList"><input type="text" name="l_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name="l_rpwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="sub" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
  </body>
</html>
<script scr="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
      $('#yzm').click(function(){
          return false;
       });
       var flag=0;
       $('#q').blur(function(){
           var value=$('#q').val();
           if(value==''){
            alert('邮箱或手机号不能为空');
            return false;
           };
          var reg=/^\d{5,11}@qq\.com$/;
          var  peg=/^\d{11}$/;
           if(reg.test(value)){
               flag=1;
           }
           if(peg.test(value)){
            flag=2;
           }
            // $.post(
            //   '/login/zhuce',
            //   {u_email:value},
            //   function(msg){
            //     if(msg==1){
            //       alert('邮箱可用');
            //     }
            //   }
            // );      
       });

    $('#yzm').click(function(){
      var l_tel= $('input[name=l_tel]').val();
      alert(l_tel);
      if(flag==2){
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      // alert(l_tel);
      $.post('/login/zhuce',{l_tel:l_tel},function(msg){
          if(msg.return_code='00000'){
            alert('发送验证码成功！');
          }   
      })
      }else{
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.post('/login/email',{l_tel:l_tel},function(msg){
          if(msg){
            // alert('发送验证码成功！');
          }   
      }) 
      }

    })

    $('#sub').click(function(){
      var l_tel= $('input[name=l_tel]').val();
      var l_pwd=$('input[name=l_pwd]').val();
      var l_rpwd=$('input[name=l_rpwd]').val();
      var l_yzm=$('input[name=l_yzm]').val();

      if(l_pwd=='' ||l_rpwd=='' ){
        alert('密码和确认密码不能为空！');
        return;
      }
      if(l_rpwd != l_pwd ){
        alert('两次密码不一致！');
        return;
      }
      var code=Cookie::get('l_tel');
      if(l_yzm != code){
        alert('验证码错误');
      }
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      $.post('/login/store',{l_tel:l_tel,l_pwd:l_pwd},function(msg){
          if(msg){
            alert(msg);
          }
      })
    })
</script>