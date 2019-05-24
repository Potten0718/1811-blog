<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>



<?php
header('connect-type:text/html;charset=utf-8');
$mem=new Memcache();

$mem->connect('127.0.0.1',11211)or die('memcache链接失败');
$link=mysqli_connect('127.0.0.1','root','root','1811_laravel');
// var_dump($link);
$name=$mem->getserverstatus('127.0.0.1');
// var_dump($name);die;
$sql="select * from 1811_ncate";
$res=mysqli_query($link,$sql);
$data=mysqli_fetch_all($res,1);
// var_dump($data);die;
$a=$mem->add('qwe',$data);
var_dump($a);die;
$asd=-$mem->set('data');
var_dump($asd);die;

?>

<table border="1" width="200">
	<tr>
		<td>小说ID</td>
		<td>小说名称</td>
	</tr>
	<?php foreach ($res as $k => $v) { ?>
		<tr>
			<td><?php echo $v['ncate_id'] ?></td>
			<td><?php echo $v['ncate_name'] ?></td>
			<!-- <td><?php echo $qwe ?></td> -->
		</tr>
	<?php } ?>
</table>
</body>
</html>