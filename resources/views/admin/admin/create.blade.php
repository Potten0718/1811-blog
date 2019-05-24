<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
 <script type="text/javascript" src="/admin/js/jquery-3.3.1.js"></script>
 <meta name="csrf-token" content="{{csrf_token()}}">
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;-</span>&nbsp;管理员管理
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
		            @if ($errors->any())     
		            <div class="alert alert-danger">         
		            <ul>             
		            @foreach ($errors->all() as $error)                 
		            <li>{{ $error }}</li>            
		            @endforeach         
		            </ul>     
		            </div> 
		            @endif 
					<form action="/admin/add_do" method="post" >
						<div class="cfD">
							{{csrf_field()}}
							<input class="userinput" type="text" name="admin_name" placeholder="输入用户名" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							<input class="userinput vpr" type="text" name="admin_pwd" placeholder="输入用户密码" />
							<input type="button" id="btn" submit value="添加">
							<!-- <button class="userbtn">添加</button> -->
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="400px" class="tdColor">用户名</td>
							<td width="630px" class="tdColor">添加时间</td>
							<td width="630px" class="tdColor">修改时间</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@if($data)
						@foreach($data as $v)
						<tr height="40px">
							<td>{{$v->admin_id}}</td>
							<td>{{$v->admin_name}}</td>
							<td>{{$v->create_time}}</td>
							<td>{{$v->update_time}}</td>
							<td><a href="connoisseuradd.html"><img class="operation"
									src="img/update.png"></a> <img class="operation delban"
								src="img/delete.png"></td>
						</tr>
						@endforeach
						@endif
					</table>
					<div class="paging">此处是分页</div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
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
	//_token
	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    //验证管理员名
	$('input[name=admin_name]').blur(function(){
		var admin_name=$(this).val();
		if(admin_name==''){
			alert("管理员名不能为空");
			return;
		}
		var reg=/^[/u4e00-\u9fa5\w]{2,30}$/;
		if(!reg.test(admin_name)){
			alert('管理员名必须是汉字开头的2—30位数字、字母、下划线组成');
			return;
		}
		//唯一性验证
		$.post('/admin/checkName',{admin_name:admin_name},function(msg){
			if(msg.count){
				alert('管理员名已存在！');
				return;
			}
		},'json');	
	});

	//ajax提交
	$('#btn').click(function(){

		var admin_name=$('input[name=admin_name]').val();
		if(admin_name==''){
			alert("管理员名不能为空");
		}
		var reg=/^[/u4e00-\u9fa5\w]{2,30}$/;
		if(!reg.test(admin_name)){
			alert('管理员名必须是汉字开头的2—30位数字、字母、下划线组成');
		}
		//唯一性验证
		$.post('/admin/checkName',{admin_name:admin_name},function(msg){
			if(msg.count){
				alert('管理员名已存在！');
			}
		},'json');	
	});
</script>
</html>