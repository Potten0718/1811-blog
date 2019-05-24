<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>分类添加</span>
				</div>
				<form action="/cate/add_do" method="post">
				<div class="baBody">
					@csrf
					<div class="bbD">
						分类名称：<input type="text" name="cate_name" class="input1" />
					</div>
					<div class="bbD">
						是否显示：<label><input type="radio" name="cate_show" value="是"  />是</label> <label><input
							type="radio" value="否" />否</label>
					</div>
					<div class="bbD">
						导航显示：<label>
							<input type="radio" name="is_show" value="是" />是
						</label> 
							<label>
								<input type="radio" name="is_show" value="否" />否
						</label>
					</div>
					<div class="bbD">
						父级分类：<select name="cate_pid" class="input1">
									<option value="0">顶级分类</option>
									@if($cate)
									@foreach($cate as $v)
									<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
									@endforeach
									@endif
								 </select>
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
<script type="text/javascript">

</script>