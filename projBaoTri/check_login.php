<?php	
	if ((isset($_POST['username'])) && (isset($_POST['password'])))
	{
		$con = mysql_connect("localhost","root","");
		if (!$con)
  		{
     		die('Could not connect: ' . mysql_error());
  		} else 
		{
			mysql_select_db("projbaotri", $con);
			mysql_query("SET NAMES 'utf8'");
			$sql = "select * from taikhoan where taikhoan = '".$_POST['username']."' and matkhau = '".$_POST['password']."'";
			$result = mysql_query($sql);
			if (mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_array($result);
				$sql = "select * from nhanvien where manv='".$row['manv']."'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				$sql = "select * from quyenhan where chucvu='".$row['chucvu']."'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				$array = array('result' => 1, 'quyenhan' => $row['quyenhan']); 
			} else
			{
				$array = array('result' => 0);  
				
			}
			echo json_encode($array);
			mysql_close($con);
		}
	} else {
		$array = array('result' => 0);  
		echo json_encode($array);
	}
?>