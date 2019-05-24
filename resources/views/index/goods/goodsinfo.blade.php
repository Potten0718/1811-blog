<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />

    <!-- Bootstrap -->
    <link href="/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/index/css/style.css" rel="stylesheet">
    <link href="{{asset('css/page.css')}}" rel="stylesheet">
    <link href="/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl">
            <span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>产品详情</h1>
        </div>
    </header>

        <img src="{{config('app.img_url')}}{{$data->goods_logo}}" />

        <!--sliderA/-->
        <table class="jia-len">
            <tr>
                <th><strong class="orange">{{$data->goods_price}}</strong></th>
                <td>
                    <!-- <input type="button"   class="spinnerExample" id="add"/> -->

                    <!-- <button id="less">-</button> -->
                    <input type="button" id="less" value="-">
                    <input type="hidden" name="" id="goods_number" value="{{$data->goods_num}}">
                    <input type="text" id="buy_number" style="width:30px;" value="1"/>
                    <!-- <button id="add" >+</button> -->
                    <input type="button" id="add" value="+">


                    <!-- <input type="button" class="spinnerExample" id="less"/>   -->
                </td>
            </tr>
            <tr>
                <td>
                    <strong>{{$data->goods_name}}</strong>
                </td>
                <td align="right">
                    <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
                </td>
            </tr>
            <input type="hidden" id="goods_id" value="{{$data->goods_id}}">
           
        </table>
        <div class="height2"></div>
        <table border="1" cellspacing="0">
            <tr>
                <th colspan="3" width="100">用户评论</th>
            </tr>
            @if($res)
                @foreach($res as $v)
            <tr>
                <td colspan="2" align="left">{{$v->u_name}}</td><td align="right">{{$v->level}}</td>
            </tr>
            <tr>
                <td colspan="3">{{$v->content}}</td>
            </tr>
                @endforeach
                @endif
        </table>
                {{$res->appends(['goods_id'=>$goods_id])->links()}}
        <!--guige/-->
        <div class="height2"></div>
        <table >
            <tr>
                <td>
                    用户名：
                </td>
                <td>
                    <input type="text" name="u_name" id="u_name">
                </td>
            </tr>

            <tr>
                <td>
                    E-mail：
                </td>
                <td>
                    <input type="email" name="email" id="email">
                </td>
            </tr>
            <tr>
                <td>评价等级：</td>
                <td>
                    <input type="radio" name="level" value="1级" class="level">&nbsp;&nbsp;1级&nbsp;&nbsp;
                    <input type="radio" name="level" value="2级" class="level">&nbsp;&nbsp;2级&nbsp;&nbsp;
                    <input type="radio" name="level" value="3级" class="level">&nbsp;&nbsp;3级&nbsp;&nbsp;
                    <input type="radio" name="level" value="4级" class="level">&nbsp;&nbsp;4级&nbsp;&nbsp;
                    <input type="radio" name="level" value="5级" class="level">&nbsp;&nbsp;5级&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td>评论内容：</td>
                <td>
                    <textarea name="content" id="content" cols="30" rows="2"></textarea>
                </td>
            </tr>
            <tr>
                <td width="700" colspan="2" align="right"><button id="padd">提交评论</button></td>
            </tr>
        </table>

        <table class="jrgwc">


            <ul class="reg-login-click">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="javascript:void(0);" class="rlbg" id="addCart">加入购物车</a></li>
                <div class="clearfix"></div>
            </ul><!--reg-login-click/-->
        </table>

</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/index/js/bootstrap.min.js"></script>
<script src="/index/js/style.js"></script>
<!--焦点轮换-->
<script src="/index/js/jquery.excoloSlider.js"></script>
<script>
    $(function () {
        $("#sliderA").excoloSlider();
    });
</script>

<script src="/index/js/jquery.spinner.js"></script>
<script>
    $('.spinnerExample').spinner({});
</script>
</body>
</html>
<script>
    $(function(){
        //点击加号
        $("#add").click(function(){
            var goods_number = $("#goods_number").val();
            var buy_number = parseInt($("#buy_number").val());

            if(buy_number>=goods_number){
                $("#buy_number").val(goods_number);
                //加号按钮失效
                $(this).prop('disabled',true);
            }else{
                buy_number = buy_number+1;
                $("#buy_number").val(buy_number);
                //减号生效
                $('#less').prop('disabled',false);
            }
        });
        //点击减号
        $("#less").click(function(){
            var buy_number = parseInt($("#buy_number").val());
            if(buy_number<=1){
                $("#buy_number").val();
                //按钮减号失效
                $(this).prop('disabled',true);
            }else{
                buy_number = buy_number-1;
                $("#buy_number").val(buy_number);
                //加号生效
                $('#add').prop('disabled',false);
            }
        });
        //点击加入购物车
        $("#addCart").click(function(){
            // alert(666);
            //获取商品id 购买数量
            var goods_id = $("#goods_id").val();
            var buy_number = $("#buy_number").val();
            if(goods_id ==""){
                alert('请选择一件商品');
            }
            if(buy_number==""){
                alert('请选择购买数量');
            }
            // alert(goods_id);
            // alert(buy_number);
            // console.log(goods_id);
            // console.log(buy_number);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "/index/cat/store",
                {goods_id:goods_id,buy_number:buy_number},
                function(res){
                    alert(res.content);
                    if(res.code==1){
                        window.location.href="{{url('index/cat/index')}}";
                    }
                },
                'json'
            );
        })
        //失去焦点
        $("#buy_number").blur(function(){
            var _this = $(this);
            var buy_number = _this.val();
            var goods_number = $("#goods_number").val();
            var reg = /^\d+$/;

            if(buy_number==''||buy_number<=1||!reg.test(buy_number)){
                _this.val(1);
            }else if(parseInt(buy_number)>=parseInt(goods_number)){
                _this.val(goods_number);
            }else{
                buy_number = parseInt(buy_number);
                _this.val(buy_number);
            }
        });
        //提交评论
        $('#padd').click(function(){
            var u_name=$('#u_name').val();
            var email=$('#email').val();
            var level=$('input:checked').val();
            var content=$('#content').val();
            $.get(
                "{{url('index/goods/pinglun')}}",
                {u_name:u_name,email:email,level:level,content:content},
                function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }
                }
            );
        });
        $('.page-link').click(function () {
            var link=$(this).prop('href');
            // alert(link);
            // return false;
        });
    })

</script>