<?php
header("Content-Type: text/html;charset=utf-8");
  // 允许所有域访问
$mysql_server_name = '127.0.0.1'; //改成自己的mysql数据库服务器

$mysql_username = 'root'; //改成自己的mysql数据库用户名

$mysql_password = 'root'; //改成自己的mysql数据库密码

$mysql_database = 'zfw'; //改成自己的mysql数据库名

$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database); //连接数据库

//连接数据库错误提示

if (mysqli_connect_errno($conn)) { 

    die("连接 MySQL 失败: " . mysqli_connect_error()); 

}

mysqli_query($conn,"set names utf8"); //数据库编码格式

//分页参数
$pagesize=50;
//当前页
$page=isset($_GET['page'])?$_GET['page']:1;
$startrow=($page-1)*$pagesize;
$sql = "select * from users";
$result = mysqli_query($conn,$sql);
$records=mysqli_num_rows($result);
$pages=ceil($records/$pagesize);
$sql.=" order by id desc limit {$startrow},{$pagesize}";
$result=mysqli_query($conn,$sql);
$arras=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		a{
			display: block;
			width: 30px;
			height: 30px;
			line-height: 30px;
			text-align: center;
			color: #000;
			text-decoration: none;
			border: 1px solid #eee;
		}
		a:focus{
			background: #000;
			color: #fff;
		}
		.kangyu{
			margin-left: 400px;
			display: flex;
		}
		span{
			display: block;
			width: 30px;
			height: 30px;
			background: #000;
			color: #fff;
						line-height: 30px;
			text-align: center;
			border: 1px solid #eee;
		}
	</style>
</head>
<body>
	<table border="1">
		<tr>
			<th style="width: 30px">id</th>
			<th>username</th>
			<th>password</th>
			<th>email</th>
			<th>phone</th>
			<th colspan="2">操作</th>
		</tr>
		<?php foreach($arras as $arr){?>
			<tr>
				<td style="width:10%"><?php echo $arr['id']?></td>
				<td><?php echo $arr['username']?></td>
				<td><?php echo $arr['password']?></td>
				<td><?php echo $arr['email']?></td>
				<td><?php echo $arr['phone']?></td>
				<td>
					<a href="">修改</a>
					<a href="">删除</a>
				</td>
			</tr>
		<?php }?>
		<tr>
			<td class="kangyu"><?php  

			//循环的起点和重点
			$start=$page-5;
			$end=$page+4;
			if($page<=6){
				$start=1;
				$end=10;
			}
			if($page>=$pages-4){
				$start=$pages-9;
				$end=$pages;
			}
			if($pages<10){
				$start=1;
				$end=$pages;
			}
			for($i=$start;$i<=$end;$i++){
				if($page==$i){
					echo "<span>$i</span>";	
				}else{
				echo "<a href='?page=$i'>$i</a>";	
				}
				
			}

			?></td>
		</tr>
	</table>
</body>
</html>
