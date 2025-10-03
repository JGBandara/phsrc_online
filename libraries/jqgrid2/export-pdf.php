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
#error_reporting(E_ALL & ~E_NOTICE);
#ini_set("display_errors","on");

$conn = mysql_connect("localhost", "root", "");
mysql_select_db("griddemo");

include("inc/jqgrid_dist.php");

$g = new jqgrid();

$col = array();
$col["title"] = "Id"; // caption of column
$col["name"] = "client_id"; 
$col["width"] = "10";
$col["export"] = false; // this column is not exported
$cols[] = $col;		

		
$col = array();
$col["title"] = "Client";
$col["name"] = "name";
$col["width"] = "100";
$col["align"] = "center"; // this column is not editable
$cols[] = $col;

$grid["sortname"] = 'client_id'; // by default sort grid by this field
$grid["sortorder"] = "desc"; // ASC or DESC
$grid["caption"] = "Client Data"; // caption of grid
$grid["autowidth"] = true; // expand grid to screen width
$grid["multiselect"] = false; // allow you to multi-select through checkboxes

// export PDF file
// paper sizes: 4a0,2a0,a0,a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,b0,b1,b2,b3,b4,b5,b6,b7,b8,b9,b10,c0,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,ra0,ra1,ra2,ra3,ra4,sra0,sra1,sra2,sra3,sra4,letter,legal,ledger,tabloid,executive,folio,commercial #10 envelope,catalog #10 1/2 envelope,8.5x11,8.5x14,11x17
$grid["export"] = array("format"=>"pdf", "filename"=>"my-file", "heading"=>"Invoice Details", "orientation"=>"landscape", "paper"=>"a4");

// export filtered data or all data
$grid["export"]["range"] = "filtered"; // or "all"
$g->set_options($grid);

// params are array(<function-name>,<class-object> or <null-if-global-func>,<continue-default-operation>)
$e["on_render_pdf"] = array("set_pdf_format", null);
$g->set_events($e);

function set_pdf_format($arr)
{
	/**
	 * The pdf standard "Base 14 fonts" are:
	 * Courier, Courier-Bold, Courier-BoldOblique, Courier-Oblique,
	 * Helvetica, Helvetica-Bold, Helvetica-BoldOblique, Helvetica-Oblique,
	 * Times-Roman, Times-Bold, Times-BoldItalic, Times-Italic,
	 */
	 
	$grid = $arr["grid"];
	$data = $arr["data"];
	
	$html .= "<style>td{font-size:15px; font-family:Helvetica}</style>";
	$html .= "<h1 style='border-bottom:1px solid black'>".$grid->options["export"]["heading"]."</h1>";
	$html .= "<table border='0' cellpadding='2' cellspacing='2'>";
	
	$i = 0;
	foreach($data as $v)
	{
		$shade = ($i++ % 2) ? "bgcolor='aliceblue'" : "";
		$html .= "<tr>";
		foreach($v as $d)
			$html .= "<td $shade>$d</td>";
		$html .= "</tr>";
	}
	$html .= "<table>";	

	return $html;
}


$g->set_actions(array(	
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"rowactions"=>true, // show/hide row wise edit/del/save option
						"export"=>true, // show/hide export to excel option
						"autofilter" => true, // show/hide autofilter for search
						"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
					) 
				);

// this db table will be used for add,edit,delete
$g->table = "clients";


// you can provide custom SQL query to display data
$g->select_command = "SELECT * FROM clients";

// pass the cooked columns to grid
$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="js/themes/smoothness/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
	<div style="margin:10px">
	<br>
	<?php echo $out?>
	</div>
</body>
</html>