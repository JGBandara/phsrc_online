<?php
error_reporting(E_ALL & ~E_NOTICE);

if ($_GET['p']) phpinfo();
// set up DB
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("griddemo");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");

// include and create object
include("inc/jqgrid_dist.php");
$g = new jqgrid();

// set few params
$grid["caption"] = "Sample Grid";
$grid["multiselect"] = true;

$grid["export"]["range"] = "filtered"; // or "all"

# set add/edit dialog width ... to apply css (see below)
$grid["add_options"] = array('width'=>'420');
$grid["edit_options"] = array('width'=>'420');
	
$g->set_options($grid);

// set database table for CRUD operations
$g->table = "clients";


$g->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"rowactions"=>true, // show/hide row wise edit/del/save option
						"export_excel"=>true, // show/hide export to excel option - must set export xlsx params
						"export_pdf"=>true, // show/hide export to pdf option - must set pdf params
						"autofilter" => true, // show/hide autofilter for search
						"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
					) 
				);
			
// render grid
$out = $g->render("list1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
	<?php /* css for add/edit dialog editing */ ?>
	<style>
		.FormGrid .EditTable .FormData
		{
			float: left;
			width: 200px;
		}
	   
		.FormGrid .EditTable .FormData .CaptionTD
		{
			width: 50px;
		}
		.FormGrid .EditTable .FormData .DataTD #closed
		{
			width: 25px;
		}
	</style>
	
	<div style="margin:10px">
	<?php echo $out?>
	</div>
</body>
</html>