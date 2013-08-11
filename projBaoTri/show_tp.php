<?php
	if (isset($_POST['matb']))
	{
		$con = mysql_connect("localhost","root","");
		if (!$con)
  		{
     		die('Could not connect: ' . mysql_error());
  		} else 
		{
			mysql_select_db("projbaotri", $con);
			mysql_query("SET NAMES 'utf8'");
			$sql = "select * from thanhphan where matb = '".$_POST['matb']."'";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) {
				echo '<li data-matp="'.$row['matp'].'" data-tpcha="'.$row['tpcha'].'" class="ui-li ui-li-static ui-btn-up-c">'.$row['tentp'].'</li>';
			}
			mysql_close($con);
		}
	} 
?>