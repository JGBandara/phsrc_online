<?php
session_start();
$backwardseperator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$mainPath = $_SESSION['mainPath'];
include		"{$backwardseperator}dataAccess/Connector.php";
include_once	"{$backwardseperator}libraries/jqgrid2/inc/jqgrid_dist.php";

$prov_id=$_GET['pId'];
$f_date=$_GET['fDt'];	
$t_date=$_GET['tDt'];

if( $f_date!= '' ){		
		$sql = "SELECT
pay_recept_print.recipt_id,
pay_recept_print.reg_no AS reg_no,
pay_recept_print.reg_year AS reg_year,
pay_recept_print.reg_date AS reg_date,
pay_recept_print.recipt_no AS recipt_no,
pay_recept_print.our_ref AS our_ref,
pay_recept_print.pay_type AS pay_type,
pay_recept_print.cheque_no AS cheque_no,
pay_recept_print.reg_amount AS reg_amount,
pay_recept_print.stamp_amount AS stamp_amount,
pay_recept_print.amount AS amount,
pay_recept_print.created_date AS created_date
FROM
pay_recept_print
WHERE pay_recept_print.reg_date >= '$f_date' and pay_recept_print.reg_date <= '$t_date'
";
	$sql = "SELECT
pay_recept_print.recipt_id,
pay_recept_print.reg_no AS reg_no,
pay_recept_print.reg_year AS reg_year,
pay_recept_print.reg_date AS reg_date,
pay_recept_print.recipt_no AS recipt_no,
pay_recept_print.our_ref AS our_ref,
pay_recept_print.pay_type AS pay_type,
pay_recept_print.cheque_no AS cheque_no,
pay_recept_print.reg_amount AS reg_amount,
pay_recept_print.stamp_amount AS stamp_amount,
pay_recept_print.amount AS amount,
pay_recept_print.created_date AS created_date
FROM
pay_recept_print
WHERE pay_recept_print.reg_date >= '$f_date' and pay_recept_print.reg_date <= '$t_date'";

$result=$db->runQuery($sql);
while($row=mysql_fetch_array($result)){
	$regl+= $row['reg_amount'];
	$reg= number_format($regl,2,".",",");
	
	$stampl+= $row['stamp_amount'];
	$stamp= number_format($stampl,2,".",",");
	
	$suml+= $row['amount'];
	$sum= number_format($suml,2,".",",");
	
	
	
	}			
		
		
		}else{
			
					$sql = "SELECT
pay_recept_print.recipt_id,
pay_recept_print.reg_no AS reg_no,
pay_recept_print.reg_year AS reg_year,
pay_recept_print.reg_date AS reg_date,
pay_recept_print.recipt_no AS recipt_no,
pay_recept_print.our_ref AS our_ref,
pay_recept_print.pay_type AS pay_type,
pay_recept_print.cheque_no AS cheque_no,
pay_recept_print.reg_amount AS reg_amount,
pay_recept_print.stamp_amount AS stamp_amount,
pay_recept_print.amount AS amount,
pay_recept_print.created_date AS created_date
FROM
pay_recept_print";
				
	$sql = "SELECT
pay_recept_print.recipt_id,
pay_recept_print.reg_no AS reg_no,
pay_recept_print.reg_year AS reg_year,
pay_recept_print.reg_date AS reg_date,
pay_recept_print.recipt_no AS recipt_no,
pay_recept_print.our_ref AS our_ref,
pay_recept_print.pay_type AS pay_type,
pay_recept_print.cheque_no AS cheque_no,
pay_recept_print.reg_amount AS reg_amount,
pay_recept_print.stamp_amount AS stamp_amount,
pay_recept_print.amount AS amount,
pay_recept_print.created_date AS created_date
FROM
pay_recept_print";

$result=$db->runQuery($sql);
while($row=mysql_fetch_array($result)){
	
	$regl+= $row['reg_amount'];
	$reg= number_format($regl,2,".",",");
	
	$stampl+= $row['stamp_amount'];
	$stamp= number_format($stampl,2,".",",");
	
	$suml+= $row['amount'];
	$sum= number_format($suml,2,".",",");
	
	
	
	}	
			
			}
		

	
	



//ins_id
/*$col["title"] = "ID"; // caption of column
$col["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "1";
$col["align"] = "center";
$col["search"] = false;
$cols[] = $col;	$col=NULL;*/

			
	
		

//ins_id
$col["title"] = "ID"; // caption of column
$col["name"] = "recipt_id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "3";
$col["align"] = "center";
$col["search"] = false;
$cols[] = $col;	$col=NULL;


//ins_name
$col["title"] = "Type of Registration"; // caption of column
$col["name"] = "reg_no"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "4";
$col["align"] = "left";
$cols[] = $col;	$col=NULL;

//Reg_no
$col["title"] 	= "Reg Year"; // caption of column
$col["name"] 	= "reg_year"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "4";
$col["align"] 	= "center";
$cols[] = $col;	$col=NULL;



//main_cat
$col["title"] 	= "Date"; // caption of column
$col["name"] 	= "reg_date"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "4";
$col["align"] 	= "right";
$cols[] = $col;	$col=NULL;

//Address
$col["title"] = "Recept No"; // caption of column
$col["name"] = "recipt_no"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "4";
$col["align"] = "right";
$cols[] = $col;	$col=NULL;


//Email
$col["title"] 	= "Reference"; // caption of column
$col["name"] 	= "our_ref"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "4";
$col["align"] 	= "right";
$col["search"] = false;
$cols[] = $col;	$col=NULL;


// tel_no 
$col["title"] 	= "Payment Type"; // caption of column
$col["name"] 	= "pay_type"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "5";
$col["align"] 	= "center";
$cols[] = $col;	$col=NULL;


//Fax
$col["title"] = "Cheque No"; // caption of column
$col["name"] = "cheque_no"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "4";
$col["align"] = "right";
$cols[] = $col;	$col=NULL;

//Email
$col["title"] 	= "Reg. Fee"; // caption of column
$col["name"] 	= "reg_amount"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "4";
$col["align"] 	= "right";
$col["search"] = true;
$cols[] = $col;	$col=NULL;

//Email
$col["title"] 	= "Stamp Fee"; // caption of column
$col["name"] 	= "stamp_amount"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "4";
$col["align"] 	= "right";
$col["search"] = true;
$cols[] = $col;	$col=NULL;

//Email
$col["title"] 	= "Amount"; // caption of column
$col["name"] 	= "amount"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "4";
$col["align"] 	= "right";
$col["search"] = true;
$cols[] = $col;	$col=NULL;

//Email
$col["title"] 	= "Printed Date"; // caption of column
$col["name"] 	= "created_date"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] 	= "3";
$col["align"] 	= "left";
$cols[] = $col;	$col=NULL;

$jq = new jqgrid('',$db);

$grid["caption"] 		= "Pyment Recipt Details";
$grid["multiselect"] 	= false;
// $grid["url"] = ""; // your paramterized URL -- defaults to REQUEST_URI
$grid["rowNum"] 		= 100; // by default 20
$grid["sortname"] 		= 'pay_recept_print.recipt_id'; // by default sort grid by this field
$grid["sortorder"] 		= "ASC"; // ASC or DESC
$grid["autowidth"] 		= true; // expand grid to screen width
$grid["multiselect"] 	= false; // allow you to multi-select through checkboxes

//<><><><><><>======================Compulsory Code==============================<><><><><><>
	$jq->set_options($grid);
	$jq->select_command = $sql;
	$jq->set_columns($cols);
	$jq->set_actions(array(	
		"add"=>false, // allow/disallow add
		"edit"=>false, // allow/disallow edit
		"delete"=>false, // allow/disallow delete
		"rowactions"=>false, // show/hide row wise edit/del/save option
		"search" => "advance", // show single/multi field search condition (e.g. simple or advance)
		"export"=>true
	) 
	);

$out = $jq->render("list1");
//<><><><><><>======================Compulsory Code==============================<><><><><><>

//---------------------------------------------New Grid-----------------------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Listing</title>
<link rel="stylesheet" href="../../../../navMenu/headerIndex/css/style.css" type="text/css" />
</head>

<body>
<form id="frmInsList" name="frmInsList" method="post" action="" autocomplete="off">
<table width="100%" border="0" align="center" bgcolor="#FFFFFF">
	<tr>
		<td height="6" colspan="2" id="td_comDetHeader"><div style="float:right"><?php include  $backwardseperator.'Header.php'; ?></div></td>
	</tr> 
</table>
<table width="100%" border="0" align="center" bgcolor="#FFFFFF">
	
	<tr >
    <img src="../../../../images/home.jpg" height="100px" width="100%" /> 
    <?php include  $backwardseperator.'navMenu/headerIndex/index.php'; ?>
    </tr> 
</table>
<div align="center" style="margin-top:50px">
<!-------------------------------------------New Grid---------------------------------------------------->
<link rel="stylesheet" type="text/css" media="screen" href="../../../../libraries/jqdrid/js/themes/smoothness/jquery-ui.custom.css"></link>	
<link rel="stylesheet" type="text/css" media="screen" href="../../../../libraries/jqdrid/js/jqgrid/css/ui.jqgrid.css"></link>	

<script src="../../../../libraries/jqdrid/js/jquery.min.js" type="text/javascript"></script>
<script src="../../../../libraries/jqdrid/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="../../../../libraries/jqdrid/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
<script src="../../../../libraries/jqdrid/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
<script src="../../../../libraries/javascript/script.js" type="text/javascript"></script>
<!-------------------------------------------New Grid---------------------------------------------------->
<tr >
      <table width="97%" class="tableBorder_allRound">
     <tr>
    	<td colspan="2" align="left" height="25"></td>
     </tr>
    <tr>
      
      <td>&nbsp;</td>
      
      <td><span class="normalfnt">Province<span class="compulsoryRed">*</span></span></td>
      <td><select   name="cboprov" class="txtbox" id="cboprov" style="width:201px">
      <?php  if($prov_id){ ?> <?php echo'<option value="'.$prov_id.'"> '; $sql1 = "SELECT
						pro_id,
						pro_name
						FROM
						tbl_province
						where pro_id=$prov_id
						";
						$result1 = $db->RunQuery($sql1);
						while($row1=mysql_fetch_array($result1)){ echo $row1['pro_name'];}}else{ echo'All';} ;echo'</option>'?>
                 <option value="0">All</option>
                 <?php   $sql = "SELECT
						pro_id,
						pro_name
						FROM
						tbl_province
						ORDER BY pro_id DESC
						";
						$result = $db->RunQuery($sql);
						while($row=mysql_fetch_array($result))
						{
							echo "<option value=\"".$row['pro_id']."\">".$row['pro_name']."</option>";
						}
          ?>
                  </select></td>
      
        <td><span class="normalfnt">To Date</span></td>
      <td><input name="txtDateStart" class="date txtDate" type="text" value="<?php if($f_date){ echo $f_date;}else{ echo date("Y-m-d");} ?>" id="txtDateStart" style="width:60%;" onKeyPress="return ControlableKeyAccess(event);"  onclick="return showCalendar(this.id, '%Y-%m-%d');" /><input type="reset" value=""  class="txtbox" style="visibility:hidden;"   onclick="return showCalendar(this.id, '%Y-%m-%');" /></td>
      <td>&nbsp;</td>
      
      <td><span class="normalfnt">From Date</span></td>
      <td><input name="txtDateEnd" class="date txtDateEnd" type="text" value="<?php if($t_date){ echo $t_date;}else{ echo date("Y-m-d");} ?>" id="txtDateEnd" style="width:60%;" onKeyPress="return ControlableKeyAccess(event);"  onclick="return showCalendar(this.id, '%Y-%m-%d');" /><input type="reset" value=""  class="txtbox" style="visibility:hidden;"   onclick="return showCalendar(this.id, '%Y-%m-%');" /></td>
      <td>&nbsp;</td>

    <td><a  href="#"><img src="../../../../images/search.png" width="20" height="20"   id="btnSearch"  class="mouseover" onclick="pageSubmit();"/></a></td>
    </tr>
   
    
    </table></tr>

       <tr>
       
        <td>
        <div align="center" style="margin:20px;margin-top:10px">
			<?php echo $out?>
        </div>
        
        </td>
      </tr>
      <tr>
       
        <td>
        <table width="100%" style="padding:20px;"><tr><td align="center" bgcolor="#99FFFF"><b>Registration Fee</b></td><td align="right"><b><?php echo $reg?></b></td><td align="center" bgcolor="#99FFFF"><b>Stamp Fee</b></td><td align="right"><b><?php echo $stamp ?></b></td><td align="center" bgcolor="#99FFFF"><b>Total</b></td><td align="right"><b><?php echo $sum?></b></td></tr></table>
        <!--<div  style="margin:20px;margin-top:10px">
			<b><span>Total&nbsp;</span><span style="color:#F00"><?php echo $sum?></span></b>
        </div>-->

        </td>
        
      </tr>
      <tr>
        <td align="center" class="tableBorder_allRound"><a href="../../../../main.php"><img  src="../../../../images/Tclose.jpg" alt="Close" name="butClose" width="92" height="24" border="0"  class="mouseover" id="butClose" tabindex="27"/></a></td>
      </tr>
    </table>
    </td>
    </tr>
  </table>
  </div>
</form>
<script>

function pageSubmit()
{
	
	var str_date=document.getElementById('txtDateStart').value;
	var end_date=document.getElementById('txtDateEnd').value;
	var province=document.getElementById('cboprov').value;
	document.getElementById('frmInsList').submit();	
	window.location.href = 'list.php?fDt='+str_date+'&tDt='+end_date+'&pId='+province;
}
</script>
<script src="../../../../libraries/calendar/calendar.js" type="text/javascript"></script>
<script src="../../../../libraries/calendar/calendar-en.js" type="text/javascript"></script>
<script src="../../../../libraries/calendar/runCalender.js" type="text/javascript"></script>
</body>
</html>

