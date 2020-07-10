<?php
class Db{
	private $db_host;
	private $db_user;
	private $db_pass;
	private $db_name;
	private $charset;
	public function __construct($config=array())
	{
		$this->db_host=$config['db_host'];				
		$this->db_user=$config['db_user'];
		$this->db_pass=$config['db_pass'];		
		$this->db_name=$config['db_name'];		
		$this->db_charset=$config['db_charset'];		
		$this->connecDb();
		$this->selectDb();
		$this->setcharset();
	}
	public function connecDb(){
		if(!$this->link=@mysqli_connect($this->db_host,$this->db_user,$this->db_pass)){
			echo "mysql出错";
			die();
		}

	}
	public function selectDb(){
		if(!mysqli_select_db($this->link,$this->db_name)){
			echo "选择{$this->db_name}失败";
			die();
		}
	}
	public function setcharset(){
		mysqli_set_charset($this->link,$this->charset);
	}

	public function __destruct(){
		mysqli_close($this->link);
	} 	
}
$arr=array(
	'db_host'=>'127.0.0.1',
	'db_user'=>'root',
	'db_pass'=>'root',
	'db_name'=>'admin',
	'charset'=>'utf8'
);
$db=new Db($arr);
$sql='select * from admin';
$result=mysqli_query($db->link,$sql);
$info=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php foreach($info as $item){?>
	<table  border="1">
		

<tr>
	<td><?php echo $item['username']?></td>
	<td><?php echo $item['password']?></td>
</tr>
<?php } ?>
	</table>
</body>
</html>