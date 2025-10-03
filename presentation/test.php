
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
$backwardSeparator="";

include  "../dataAccess/misconnector.php";


$sql="select intId from menus";
$result=$conn->query($sql);
while($row=mysqli_fetch_array($result)){
	
	echo $row['intId'];
	}
?>

