<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品添加</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;话题添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>商品添加</span>
				</div>
				<form action="/goods/add_do" method="post" enctype="multipart/form-data">
					@csrf
				<div class="baBody">
					<div class="bbD">
						商品名称：<input type="text" name="goods_name" class="input3" />
					</div>
					<div class="bbD">
						商品价格：<input type="text" name="goods_price" class="input3" />
					</div>
					<div class="bbD">
						市场价格：<input type="text" name="goods_mprice" class="input3" />
					</div>
					<div class="bbD">
						商品库存：<input type="text" name="goods_num" class="input3" />
					</div>
					<div class="bbD">
						商品图片：<input type="file" name="goods_logo" />
					</div>
					<div class="bbD">
						是否上架：<label><input type="radio" checked="checked" name="goods_on" />&nbsp;是</label>
							<label><input type="radio" checked="checked" name="goods_on" />&nbsp;否</label>
					</div>
					<div class="bbD">
						商品属性：<label><input type="checkbox" name="goods_new" />&nbsp;新品</label> 
							<label><input type="checkbox" name="goods_best" />&nbsp;热卖</label> 
							<label class="lar"><input type="checkbox" name="goods_hot" />&nbsp;精品</label>
					</div>
					<div class="bbD">
						所属分类：<select class="input3" name="cate_name">
							<option>请选择...</option>
							@foreach($cate as $c)
							<option value="{{$c->cate_id}}">{{$c->cate_name}}</option>
							@endforeach	 
								 </select>
					</div>
					<div class="bbD">
						所属品牌：<select class="input3" name="brandd_name">
							<option>请选择...</option>
							@foreach($brandd as $b)
							<option value="{{$b->brandd_id}}">{{$b->brandd_name}}</option>
							@endforeach
								 </select>
					</div>
					<div class="bbD">
						请填写商品描述：
						<div class="btext">
							<textarea class="text2"></textarea>
						</div>
					</div>

								<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
				</div>
			</form>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>