<?php

session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include "{$backwardSeparator}dataAccess/accessController.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salary Scale Listing</title>

<?php include "{$backwardSeparator}headerListing.php";?>




<style>
body {
    margin: 0;
    text-align: center;
}
.ui-jqgrid td, .ui-jqgrid div{
  font-size: 11px;
}
</style>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/hrm/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frmhrm_salary_scaleListing">
            <div class="card">
                
              <div class="card">
                <div class="card-header">
                   Institute Listing&nbsp;
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      
<!--jQGrid-->
<script type="application/ecmascript" src="<?php echo $backwardSeparator?>vendor/jqGrid/jquery-1.11.0.min.js"></script>
<script type="application/ecmascript" src="<?php echo $backwardSeparator?>vendor/jqGrid/jquery.jqGrid.min.js"></script>
<script type="application/javascript" src="<?php echo $backwardSeparator?>vendor/jqGrid/src/i18n/grid.locale-en.js"></script>
<script type="application/javascript" src="<?php echo $backwardSeparator?>vendor/jqGrid/jszip.min.js"></script>
<script type="application/javascript" src="<?php echo $backwardSeparator?>vendor/jqGrid/pdfmakeMaster/build/pdfmake.min.js"></script>
<script type="application/javascript" src="<?php echo $backwardSeparator?>vendor/jqGrid/pdfmakeMaster/build/vfs_fonts.js"></script>
<link href="<?php echo $backwardSeparator?>vendor/jqGrid/src/css/ui.jqgrid-bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $backwardSeparator?>vendor/jqGrid/src/css/ui.jqgrid-bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $backwardSeparator?>vendor/jqGrid/src/css/ui.jqgrid-bootstrap-ui.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $backwardSeparator?>vendor/jqGrid/src/css/ui.jqgrid.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $backwardSeparator?>vendor/jqGrid/src/css/smoothness/jquery-ui.custom.css" rel="stylesheet" type="text/css" />




<div class="container">
 
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Institute Name</th>
        <th>Owner Name</th>
        <th>The relationship with the institution</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="myTable">
  <?php   $sql = "SELECT
institute_registration.ins_application_id,
institute_registration.ins_type_id,
institute_registration.ins_owner_name,
institute_registration.ins_owner_relationship,
institute_registration.ins_institute_name,
institute_registration.ins_institute_address,
institute_registration.ins_province_id,
institute_registration.ins_district_id
FROM
institute_registration
        ";

$result = $db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){?>

<tr>
        <td><?php echo $row['ins_institute_name']; ?></td>
        <td><?php echo $row['ins_owner_name']; ?></td>
        <td><?php echo $row['ins_owner_relationship']; ?></td>
        <td><button type="button" class="btn btn-info" id="<?php echo $row['ins_application_id']; ?>" style="width: 100px;" data-toggle='modal'  data-target='#myModal'>View</button></td>
      </tr>
	
<?php	
	}
?>

    </tbody>
  </table>
  
 
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<!------------------------------------------------------------------------------------------------------------>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          
          <h4 class="modal-title">Institute Details</h4>
          <button type="button" class="close" id="btnClose" data-dismiss="modal">&times;</button>
        </div>
        <div class="btn-group btn-group-justified">
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butBasicInfo'>Institute Basic Information</a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butStaffInfo'>Staff Information</a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butInstituteInfo'>Institution Information</a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butFacilityInfo'>Institute Facilities </a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butDocInfo'>Institute Document Files </a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butPaymentInfo'>Payments </a>
  </div>
        <div class="modal-body" style="margin-top:20px">
        <div id="basicInfo">
        <input type="hidden" id="txtId" name="txtId"/>
          <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-user-circle" aria-hidden="true" style="color:#F00"></i>
&nbsp;Name of the person who is operating or maintaining the institution</div><div class="form-group col-md-9">:&nbsp;<label class="textStyle" id="lblName"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-window-minimize" aria-hidden="true" style="color:#6C6"></i>
&nbsp;The relationship with the institution </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblRelationship"></label></div><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-book" aria-hidden="true" style="color:#090"></i>

&nbsp;Address</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblAddress"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-card" aria-hidden="true" style="color:#FC0"></i>&nbsp;
Name of the institution</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsName"></label></div><div class="form-group col-md-3 textMainTxtStyle">
<i class="fa fa-telegram" aria-hidden="true" style="color:#F63"></i>
&nbsp;Institute Address </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsAddress"></label></div></div>

<div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Telephone</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblProvince"></label></div><div class="form-group col-md-3 textMainTxtStyle">
Email </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblDistrict"></label></div></div>

<div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Province</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblProvince"></label></div><div class="form-group col-md-3 textMainTxtStyle">
District </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblDistrict"></label></div></div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="staffInfo">
          <div class="form-row"><div class="form-group col-md-12 textMainTxtStyle">The details of the medical staff including Doctors, Consultants engaged in the profession under this institution</div></div>
        
        <div class="form-row"><div class="form-group col-md-12"><table width="100%" ><tr><td bgcolor="#99FFFF">Name</td><td bgcolor="#99FFFF">Qulifications</td><td bgcolor="#99FFFF">Institute</td><td bgcolor="#99FFFF">Country</td><td bgcolor="#99FFFF">PostGraduate</td><td bgcolor="#99FFFF">Speciality</td><td bgcolor="#99FFFF">SLMC No</td></tr></table></div></div>
        
        <div class="form-row"><div class="form-group col-md-12 textMainTxtStyle">Managment Information</div></div>
        
        <div class="form-row"><div class="form-group col-md-12"><table width="100%" ><tr><td bgcolor="#99FFFF">Position</td><td bgcolor="#99FFFF">Name</td><td bgcolor="#99FFFF">Contact detail</td><td bgcolor="#99FFFF">Other Information</td></tr></table></div></div>

        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Government officer or not (If yes name of the institution and the post held by the officer currently)</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsGovOfficer"></label></div><div class="form-group col-md-3 textMainTxtStyle">
Government officer or not (If yes name of the institution and the post held by the officer currently)</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsname"></label></div></div>
        
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Hours of practice</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPracHoure"></label></div></div>
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      
        <div id="instituteInfo">
          <div class="form-row"><div class="form-group col-md-3">Method of record keeping</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textRecKeep"></label></div><div class="form-group col-md-3">
 Availability of visiting specialists </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textVisitSpeciality"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3">Dental laboratory facilities</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textLabFacility"></label></div><div class="form-group col-md-3">
X-ray facilities(The number of licence issued by the Atomic Energy Authority) </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textXrayFacility"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3">Emergency kit available or not</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textEmargancyKit"></label></div><div class="form-group col-md-3">
Any other facilities (specify): </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textOtherFacility"></label></div></div>

<div class="form-row"><div class="form-group col-md-3">Ownership:</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textOwnership"></label></div><div class="form-group col-md-3">
&nbsp; </div><div class="form-group col-md-3">&nbsp;</div></div>

<div class="form-row"><div class="form-group col-md-3">Practicing as a,</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPracticeType"></label></div><div class="form-group col-md-3">
If so, what is your speciality? </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textSpeciality"></label></div></div>

<div class="form-row"><div class="form-group col-md-3">Clinical waste disposal method</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textOwnership"></label></div><div class="form-group col-md-3">
Method of sterilization of instruments & dressings</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textInstrumantDressing"></label></div></div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="facilityInfo">
          <div class="form-row"><div class="form-group col-md-12">Equipment and Facilities available to provide service</div></div>
        
        <div class="form-row"><div class="form-group col-md-12"><table width="100%" ><tr><td bgcolor="#99FFFF">Facility</td><td bgcolor="#99FFFF">Value</td><td bgcolor="#99FFFF">Discription</td></tr></table></div></div>
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="documentList">
           <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments">
                    <thead class="">
                      <tr>
                        <th>Action</th>
                        <th style="width: 20%;">Category</th>
                        <th style="width: 25%;">Name</th>
                        <th style="width: 25%;">Reference No</th>
                        <th style="width: 20%;">version</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cloneRow" style="display: none;">
                        <td align='center' class="p-1">
                          <a href="#" class="action" target="_blank"><span class="fas fa-download actionView"></span></a>
                        </td>
                        <td class="category p-1"></td>
                        <td class="name p-1"></td>
                        <td class="reference p-1"></td>
                        <td class="version p-1"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>              
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="paymentInfo">
          <div class="form-row"><div class="form-group col-md-3">Payment Amount</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textAmount"></label></div><div class="form-group col-md-3">
 Payment Date </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPayDate"></label></div></div>
        
         <div class="form-row"><div class="form-group col-md-3">Payment Branch</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textBranch"></label></div><div class="form-group col-md-3">
 Payment Type </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPayType"></label></div></div>
 
<!-- <div class="form-row"><div class="form-group col-md-4">&nbsp;</div><div class="form-group col-md-4"><img src="" class="avatar1-pic" alt="Bank Slip" height="20px"></div><div class="form-group col-md-4">&nbsp;</div></div>-->
        
        </div>
<!-- -------------------------------------------------------------------------------------------------------->
       

        
        </div>
       
        <div class="modal-footer">
         <div style=""><b><label id="lblAcction" style="font-size:36px;"></label></b></div><div class="col-md-5">&nbsp;</div> <center><button type="button" class="btn btn-success" id="btnApprove">Approve</button>&nbsp;<button type="button" class="btn btn-danger" id="btnReject">Reject</button>&nbsp;<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnClose">Close</button></center>
        </div>
      </div>
      
    </div>
  </div>

<!------------------------------------------------------------------------------------------------------------>

                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <a href="<?php echo $backwardSeparator?>main.php"><button type="button" class="btn btn-warning" id="btnClose" style="width: 100px; margin: 5px;">Close</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include "{$backwardSeparator}footerListing.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Common Script -->
    <script src="<?php echo $backwardSeparator;?>js/common.js"></script>
    <script>

$(document).ready(function(){

$('#btnProceed').click(function(){
	
	var id=$('#cboatYear').val();
	requestType = 'attendanceProceed';
		var url = "leaveBalance-db-set.php";
		var obj = $.ajax({
			url:url,
			dataType: "json",  	
			data:'&id='+id+'&requestType='+requestType,
			
			success:function(json){
				//window.location.reload();
				//$('#frmApproval #+rowObject.aid_id+'+aid_id).validationEngine('showPrompt', json.msg,json.type /*'pass'*/);
				$response['type'] = 'pass';
				if(json.type=='pass')
				{					
					location.reload();
					$('#frmApproval').get(0).reset();					
					var t=setTimeout("alertx()",1000);
					return;
				}
				var t=setTimeout("alertx()",3000);
			},
			error:function(xhr,status){
				//window.location.reload();
				$('#frmApproval #+rowObject.aid_id+'+aid_id).validationEngine('showPrompt', errormsg(xhr.status), 'fail');
				var t=setTimeout("alertx()",3000);
			}		
		});
	
	
	
	
	});

	}	);
	
	/*$(document).ready(function(){

$('#btnProceed').click(function(){
	

	}	);
});*/
</script>

          <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><img src="images/logo.png" height="28px" width="45px" /> &nbsp;&nbsp;&nbsp;<span style="color:#260334"><b>More Details</b></span></h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12 row"><div class="col-md-2"><label>FAC-No</label></div>
          <div class="col-md-4">:&nbsp;<label id="lblFacNo">&nbsp;</label></div>
          <div class="col-md-2"><label>Date</label></div>
          <div class="col-md-4">:&nbsp;<label id="lblDate">&nbsp;</label></div></div>
          
          <div class="col-md-12 row"><div class="col-md-2"><label>Branch</label></div>
          <div class="col-md-4">:&nbsp;<label id="lblBranch">&nbsp;</label></div>
          <div class="col-md-2"><label>EPF No</label></div>
          <div class="col-md-4">:&nbsp;<label id="lblEpfNo">&nbsp;</label></div></div>
          
          <div class="col-md-12 row"><div class="col-md-2"><label>Recirpt No</label></div>
          <div class="col-md-4">:&nbsp;<label id="lblRecieptNo">&nbsp;</label></div>
          <div class="col-md-2"><label>Remaining Amount</label></div>
          <div class="col-md-4">:&nbsp;<label id="lblAmount">&nbsp;</label></div></div>
          
         <div class="col-md-12 row"> 
       	  <hr>
          </div>
          
           <div class="col-md-12 row"><div class="col-md-2"><label style="color:#393"><b>Next Payment Date</b></label></div>
          <div class="col-md-4">:&nbsp;<label id="lblNextPayment" style="color:#393">&nbsp;</label></div>
          <div class="col-md-2"><label style="color:#393"><b>Remark</b></label></div>
          <div class="col-md-4">:&nbsp;<label id="lblRemark" style="color:#393">&nbsp;</label></div></div>
          
          <div class="col-md-12 row"> 
       	  <hr>
          </div>
          
        </div>
        <div class="modal-footer">
        <img src="images/close_btn_n.jpg" height="10%" data-dismiss="modal">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
      
    </div>
  </div>
  <!--------------------------------------------------->   
 <script  src="list.js"></script>

</body>
</html>
