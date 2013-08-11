<?php
	if (isset($_POST['masotb']))
	{
		$con = mysql_connect("localhost","root","");
		if (!$con)
  		{
     		die('Could not connect: ' . mysql_error());
  		} else 
		{
			mysql_select_db("projbaotri", $con);
			mysql_query("SET NAMES 'utf8'");
			$sql = "select * from danhsachthietbi where masotb = '".$_POST['masotb']."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$r_vitri = mysql_query("select * from vitri where vitri='".$row['vitri']."'");
			$vitri = mysql_fetch_array($r_vitri); 
			$r_loaibt = mysql_query("select * from danhsachdathuchienbaotri where masotb='".$_POST['masotb']."' order by ngaybaotri desc");
			$loaibt = mysql_fetch_array($r_loaibt);
			$r_ngbt = mysql_query("select * from nhanvien where INSTR('".$loaibt['nguoibaotri']."',manv)>0");
			$tennvbt = "";
			while ($ngbt = mysql_fetch_array($r_ngbt))
			{
				$tennvbt = $tennvbt.$ngbt['tennv'].",";
			}
			$tennvbt = substr_replace($tennvbt ,"",-1);
			$r_lbt = mysql_query("select * from loaibaotri where loaibaotri = '".$loaibt['loaibaotri']."'");
			$lbt = mysql_fetch_array($r_lbt);
			$array = array('ten' => $row['tentb'], 'vitri' => $vitri['mota'], 'tinhtrang' => $row['tinhtranghoatdong'],
			'loaibt' => $lbt['mota'],'ngaybaotri' => date('d/m/Y',strtotime($loaibt['ngaybaotri'])), 'nguoibaotri'=> $tennvbt);
			echo json_encode($array);
			mysql_close($con);
		}
	} 
?>