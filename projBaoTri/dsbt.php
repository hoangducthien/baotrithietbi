<?php
		$con = mysql_connect("localhost","root","");
		if (!$con)
  		{
     		die('Could not connect: ' . mysql_error());
  		} else 
		{
			mysql_select_db("projbaotri", $con);
			mysql_query("SET NAMES 'utf8'");
			$sql = "select * from danhsachthietbi order by tinhtranghoatdong asc";
			$result = mysql_query($sql);			
			$dstb = "";
			$first_matb = "";
			$first_masotb = "";
			while ($row = mysql_fetch_array($result))
			{
				if ($first_matb == "" ) $first_matb = $row['matb']; 
				if ($first_masotb == "" ) $first_masotb = $row['masotb'];
				$dstb = $dstb.'<li data-vitri="'.$row['vitri'].'" data-matb="'.$row['matb'].'" data-masotb="'.$row['masotb'].'" class="ui-li ui-li-static ui-btn-up-c">'.$row['tentb'].'</li>';
			}
			$dstb_op1 = '<option value="0">Chọn mã thiết bị</option>';
			$sql = "select * from thietbi";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result))
			{
				$dstb_op1 = $dstb_op1.'<option value="'.$row['matb'].'">'.$row['tentb'].'</option>';
			}
			$dstb_op2 = '<option value="0">Chọn vị trí</option>';
			$sql = "select * from vitri";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result))
			{
				$dstb_op2 = $dstb_op2.'<option value="'.$row['vitri'].'">'.$row['mota'].'</option>';
			}
			$array = array('dstb' => $dstb, 'dstb_op1' => $dstb_op1, 'dstb_op2' => $dstb_op2, 
			'first_matb' => $first_matb, 'first_masotb' => $first_masotb);
			echo json_encode($array);
			mysql_close($con);
		}
?>