<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />

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
					<span>品牌添加</span>
				</div>

	        @if ($errors->any())     
            <div class="alert alert-danger">         
            <ul>             
            @foreach ($errors->all() as $error)                 
            <li>{{ $error }}</li>            
            @endforeach         
            </ul>     
            </div> 
            @endif 
				<form id="aa" action="/brand/add_do" method="post" enctype="multipart/form-data">
				<div class="baBody">
					{{csrf_field()}}
					<div class="bbD">
						品牌名称：<input type="text" name="brandd_name" id="brandd_name" class="input1" />
					</div>
					<div class="bbD">
						品牌地址：<input type="text" name="brandd_url" id="brandd_url" class="input1" />
					</div>
					<div class="bbD">
						上传图片：
						<div class="bbDd">
							<div class="bbDImg">+</div>
							<input type="file" name="brandd_logo" id="brandd_logo" class="file" /> <a class="bbDDel" href="#">删除</a>
						</div>
					</div>
					<div class="bbD">
						是否显示：<label><input type="radio" name="brandd_show" value="是" checked="checked" />是</label> <label><input
							type="radio" name="brandd_show" value="否" />否</label>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;排序：<input class="input2"
						name="brandd_desc"	type="text" />
					</div>
					<div class="bbD">
						<p class="bbDP">
							<input type="button" value="提交" class="btn_ok btn_yes" id="btn" >
							<!-- <button class="btn_ok btn_yes" id="go" href="#">提交</button> -->
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
<script type="text/javascript" src="/admin/js/jquery-3.3.1.js"></script>
<script type="text/javascript">
	$('#btn').click(function(){
		//var fd = new FormData($('#aa')[0]);
		// 获取页面已有的一个form表单
		//var form = document.getElementById("aa");
		var formData = new FormData($('#aa')[0]);
		// console.log(formData);
		// $.ajax({
		// 	type:"POST",
		// 	url:"/brand/add_do",
		// 	data:formData,
		// 	processDate:false,
		// 	contentType:false,
		// }).done(function(msg){
		// 	alert(msg);
		// });

	$.ajax({
                url:"/brand/add_do",
                type:"post",
                data:formData,
                processData:false,
		    	contentType:false,
                success:function(data){
                    alert(123);
                },
                error:function(e){
                    alert("错误！！");
                    
                }
            }); 
		// $.ajax({
		// 	method:"post",
		// 	url:"/brand/store",
		// 	data:formData,
		// 	processDate:false,
		// 	contentType:false,
		// 	success:function(msg){
		// 		alert(msg);
		// 	},
		// });
	});
</script>