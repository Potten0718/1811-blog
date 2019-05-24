@extends('layouts.shop')
@section('title','铄珠宝')
@section('content')
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
     <form action="user.html" method="get" class="reg-login">
      <h3>还没有三级分销账号？点此<a class="orange" href="reg.html">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="l_tel" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="text" name="l_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="sub" value="立即登录" />
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
<script type="text/javascript">
  $('#sub').click(function(){
      var l_tel=$('input[name=l_tel]').val();
      var l_pwd=$('input[name=l_pwd]').val();
      //验证
      if(l_tel=='' || l_pwd==''){
        alert('手机号和邮箱以及密码不能为空');
        return; 
      }
      var reg=/^1[3-8]\d{9}$/i;
      var reg1=/^[1-9]\d{4,10}@qq.com$/i;
      var reg2=/^[a-z1-9]\w{5,11}@163.com$/i;
      if(!reg.test(l_tel)&!reg1.test(l_tel)&!reg2.test(l_tel)){
            alert("请输入正确的手机或邮箱账号");
            return false;
      }

      //ajax提交
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $.post('/login/denglu',{l_tel:l_tel,l_pwd:l_pwd},function(msg){
          if(msg=1){
            alert('登陆成功！');
            window.location.href='/';
          }else{
            alert('登陆失败！');
          }
      })

  })
</script>
@endsection