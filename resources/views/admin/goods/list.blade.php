<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行家-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>

		<div class="page">
			<!-- banner页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>
						<div class="cfD">
							工作年限：<select><option>1年以内</option></select> 审核状态：<label><input
								type="radio" checked="checked" name="styleshoice1" />&nbsp;未审核</label> <label><input
								type="radio" name="styleshoice1" />&nbsp;已通过</label> <label class="lar"><input
								type="radio" name="styleshoice1" />&nbsp;不通过</label> 推荐状态：<label><input
								type="radio" checked="checked" name="styleshoice2" />&nbsp;是</label><label><input
								type="radio" name="styleshoice2" />&nbsp;否</label>
						</div>
						<div class="cfD">
							<input class="addUser" type="text" placeholder="输入用户名/ID/手机号/城市" />
							<button class="button">搜索</button>
							<a class="addA addA1" href="connoisseuradd.html">添加行家+</a>
						</div>
					</form>
				</div>
				<!-- banner 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="66px" class="tdColor tdC">商品图片</td>
							<td width="170px" class="tdColor">商品名称</td>
							<td width="135px" class="tdColor">商品价格</td>
							<td width="145px" class="tdColor">市场价格</td>
							<td width="140px" class="tdColor">商品库存</td>
							<td width="140px" class="tdColor">是否上架</td>
<!-- 							<td width="145px" class="tdColor">商品属性</td> -->
							<td width="150px" class="tdColor">所属分类</td>
							<td width="140px" class="tdColor">所属品牌</td>
							<td width="140px" class="tdColor">商品描述</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@if($data)
						@foreach($data as $v)
						<tr>
							<td>{{$v->goods_id}}</td>
							<td><div class="onsImg">
									<img src="{{config('app.img_url')}}{{$v->goods_name}}">
								</div></td>
							<td>{{$v->goods_name}}</td>
							<td>{{$v->goods_price}}</td>
							<td>{{$v->goods_mprice}}</td>
							<td>{{$v->goods_num}}</td>
							<td>{{$v->goods_on}}</td>
							<!-- <td>{{$v->goods_on}}</td> -->
							@foreach($cate as $vv)
							<td>{{$vv->cate_name}}</td>
							@endforeach
							@foreach($brandd as $vvv)
							<td>{{$vvv->brandd_name}}</td>
							@endforeach
							<td>{{$v->goods_desc}}</td>
							<td><a href="connoisseuradd.html"><img class="operation"
									src="img/update.png"></a> <img class="operation delban"
								src="img/delete.png"></td>
						</tr>
						@endif
						@endforeach
					</table>
					<div class="paging">此处是分页</div>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
</script>
</html>