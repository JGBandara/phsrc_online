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

$conn = mysql_connect("localhost", "root", "soft");
mysql_select_db("griddemo");

include("inc/jqgrid_dist.php");

$grid = new jqgrid();

$opt["caption"] = "Clients Data";
$grid->set_options($opt);

// params are array(<function-name>,<class-object> or <null-if-global-func>,<continue-default-operation>)
// if you pass last argument as true, functions will act as a data filter, and insert/update will be performed by grid
$e["on_insert"] = array("add_client", null, false);
$e["on_update"] = array("update_client", null, false);
$e["on_delete"] = array("delete_client", null, true);
# $e["on_after_insert"] = array("after_insert", null, true); // return last inserted id for further working
$e["on_data_display"] = array("filter_display", null, true);
$grid->set_events($e);

function update_client($data)
{
/*
	$data => Array
	(
		[client_id] => 2
		[params] => Array
			(
				[client_id] => 2
				[name] => Client 2
				[gender] => male
				[company] => Client 2 Company
			)

	)
*/

	$str = "UPDATE clients SET name='My custom {$data["params"]["name"]}',
					WHERE client_id = {$data["client_id"]}";
	mysql_query($str);
}

function delete_client($data)
{
/*
	$data => Array
	(
		[client_id] => 2
	)
*/
}

function add_client($data)
{
	mysql_query("INSERT INTO clients VALUES (null,'{$data["params"]["name"]}','{$data["params"]["gender"]}','{$data["params"]["company"]}')");
/*
	$data => Array
		(
			[params] => Array
				(
					[client_id] => 
					[name] => Test
					[gender] => male
					[company] => Comp
				)

		)

*/
}

/**
 * Just update the passed argument, as it is passed by reference
 * Changes will be reflected in grid
 */
function filter_display($data)
{
/*
Array
(
    [params] => Array
        (
            [0] => Array
                (
                    [client_id] => 1
                    [name] => Client 1
                    [gender] => My custom malea
                    [company] => My custom Client 1 Company 1
                )

            [1] => Array
                (
                    [client_id] => 2
                    [name] => Client 2
                    [gender] => male
                    [company] => Client 2 Com2pany 11
                )
			
			.......
*/
	foreach($data["params"] as &$d)
	{
		$d["gender"] = ucwords($d["gender"]);
	}
}


$grid->table = "clients";
$out = $grid->render("list1");
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
	<div style="margin:10px">
	Custom events example ... 
	<br>
	<br>
	<?php echo $out?>
	</div>
</body>
</html>