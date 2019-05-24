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
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/index/images/head.jpg" />
    </div><!--head-top/-->
    <table class="shoucangtab">
        <tr>
            <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
            <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
                <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
            </td>
        </tr>
    </table>

    <div class="dingdanlist">
        <table>
   
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox"class="allbox" name="1" /> 全选</a></td>
            </tr>
            @foreach($data as $v)
            <tr>
                <td width="4%"><input type="checkbox" name="1" class="box"/></td>
                <td class="dingimg" width="15%"><img src="{{config('app.img_url')}}{{$v->goods_logo}}" /></td>
                <td width="50%">
                    <h3>{{$v->goods_name}}</h3>
                    <time>下单时间：{{$v->create_time}}</time>
                </td>
                <input type="hidden" name="" class="goods_number" value="{{$v->goods_num}}">
                <td align="right"> 
                <input type="button" class="less" value="-">
                
                <input type="text" class="buy_number" style="width:30px;" value="{{$v->buy_number}}"/>
                
                <input type="button" class="add" value="+"></td>
            </tr>
            <tr>
                <th colspan="4"><strong class="orange">{{$v->goods_price}}</strong></th>
            </tr>
            <input type="hidden" id="goods_id" value="{{$v->goods_id}}">
            @endforeach
        </table>
    </div><!--dingdanlist/-->

    <div class="dingdanlist">
        <table>
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
            </tr>
        </table>
    </div><!--dingdanlist/-->
    <div class="height1"></div>
    <div class="gwcpiao">
        <table>
            <tr>
                <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                <td width="50%">总计：<strong class="orange">¥69.88</strong></td>
                <td width="40%"><a href="javascript:void(0);" id="confirm" class="jiesuan">去结算</a></td>
            </tr>
        </table>
    </div><!--gwcpiao/-->
</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/index/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/index/js/bootstrap.min.js"></script>
<script src="/index/js/style.js"></script>
<!--jq加减-->
<script src="/index/js/jquery.spinner.js"></script>
<script>
    $('.spinnerExample').spinner({});
</script>
</body>
</html>
<script>
     $(function(){
            //点击加号
            $(".add").click(function(){
                var _this = $(this);
                var goods_number = $(".goods_number").val();
                var buy_number = parseInt(_this.prev('input').val());
                // alert(goods_number);
                // alert(buy_number);
                if(buy_number>=goods_number){
                _this.prev('input').val(goods_number);
            }else{
                buy_number = buy_number+1;
                _this.prev('input').val(buy_number);
            }
            // 2.当前的复选框选中
            checkedTr(_this);

            // 3.重新获取小计
            getTotal(goods_id,_this);

            

            // 4.重新获取总价
            getCount();

            });
            //点击减号
            $(".less").click(function(){
                var _this = $(this);
                var buy_number = parseInt(_this.next('input').val());
                if(buy_number<=1){
                _this.next('input').val(1);
              
            }else{
                buy_number = buy_number-1;
                _this.next('input').val(buy_number);
            }
            // 2.当前的复选框选中
            checkedTr(_this);

            // 3.重新获取小计
            getTotal(goods_id,_this);

            

            // 4.重新获取总价
            getCount();

            });
            //失去焦点
            $(".buy_number").blur(function(){
                var _this = $(this);
                var buy_number = _this.val();
                var goods_number = $(".goods_number").val();
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
        //点击复选框
        $(".box").click(function(){
            //获取总价
            getCount();
        })
        //点击全选
        $(".allbox").click(function(){
            //alert(11);exit;
            var _this=$(this);
            var status=_this.prop('checked');
            $(".box").prop('checked',status);
            //调用总价
            getCount();
        })
        //3、重新获取小计
        function getTotal(goods_id,_this)
        {
            $.post(
                "/index/cat/getTotal",
                {goods_id:goods_id},
                function(res){
                    _this.parents('td').next('td').text("￥"+res);
                    //console.log(res);
                }
            );
        }
        // 给当前行复选框选中
        function checkedTr(_this)
        {
            _this.parents('tr').find("input[class='box']").prop('checked',true);
        }
        // 重新获取总价
        function getCount()
        {
            //获取选中复选框ID
            var goods_id="";
            $(".box:checked").each(function(index){
                goods_id+=$(this).parents('tr').attr('goods_id')+',';
            })
            goods_id=goods_id.substr(0,goods_id.length-1);
            //console.log(goods_id);
            $.post(
                "{:url('Cat/getCount')}",
                {goods_id:goods_id},
                function(res){
                   // _this.parents('td').next('td').text("￥"+res);
                    //console.log(res);
                    $("#count").text("￥"+res);
                }
            );
        }

            //点击确认结算
            $('#confirm').click(function(){
                var len = $('.box:checked').length;
                // console.log(len);
                if(!len){
                    alert('请至少选择一件商品进行结算');
                    return false;
                }

                //获取选中的商品id
                var goods_id = '';
                $('.box:checked').each(function(index){
                    goods_id += $(this).parents('tr').attr('goods_id')+',';
                });
                goods_id = goods_id.substr(0,goods_id.length-1);
                // console.log(goods_id);
                location.href="cat/confirm/"+goods_id;
                
            });

        })
</script>
