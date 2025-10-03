<?php 
/**
 * JqGrid PHP Component
 *
 * @author Afnan Zari <azghanvi@gmail.com> - http://azgtech.wordpress.com
 * @version 1.0
 * @todo: footer summary, grouping
 * @license: see license.txt included in package
 */
?>
<?php
error_reporting(E_ALL & ~E_NOTICE);

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("griddemo");

include("inc/jqgrid_dist.php");

$grid = new jqgrid();

$opt["caption"] = "Clients Data";

// following params will enable subgrid -- by default 'rowid' (PK) of parent is passed
$opt["subGrid"] = true;
$opt["subgridurl"] = "subgrid_detail.php";

// $opt["subgridparams"] = "name,gender,company"; // comma sep. fields. will be POSTED from parent grid to subgrid, can be fetching using $_POST in subgrid
$grid->set_options($opt);

$grid->table = "clients";
$out = $grid->render("list1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="js/themes/start/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
	<div style="margin:10px">
	Subgrid example ... this file will load subgrid defined in 'subgrid_detail.php'
	<br>
	<br>
	<?php echo $out?>
	</div>
</body>
</html>