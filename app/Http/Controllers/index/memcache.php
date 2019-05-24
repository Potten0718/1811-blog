<?php
header('content-type:text/html;charset=utf-8');
$link=mysqli_connect('127.0.0.1','root','root','1811_laravel') or die('deatebase connect fail');
// var_dump($link);die;
// $id=$_GET['id']??1;
// var_dump($id);
$mem=new Memcache();
$a=$mem->connect('127.0.0.1',11211) or die('memcache connect fail');
// var_dump($a);die;
$data=$mem->get('data_');
// var_dump($b);die;
if(!$data){
	echo 'db';
	$sql="select * from 1811_ncate";
	$res=mysqli_query($link,$sql);
	// var_dump($res);
	$data=mysqli_fetch_all($res);
	// var_dump($data);die;
	$mem->set('data_',$data,0,1*6);
}


?>
<table border="1" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>名称</th>
    </tr>
    <?php
    if($data){
        foreach($data as $v){?>
    <tr>
        <td><?php echo $v['cnate_id']; ?></td>
        <td><?php echo $v['cnate_name']; ?></td>
    </tr>
    <?php } }?>
</table>