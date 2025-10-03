
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';

use presentation\system\masterData\classes\cls_sys_province;
use presentation\system\masterData\classes\cls_sys_district;
use presentation\system\masterData\classes\cls_sys_record_keeping;
use presentation\system\masterData\classes\cls_ins_owner;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$modelStatus = new cls_sys_status($db);
$modelProvince = new cls_sys_province($db);
$modelDistrict = new cls_sys_district($db);
$modelRecordKeeping= new cls_sys_record_keeping($db);
$modelOwner= new cls_ins_owner($db);
//$model = new cls_hrm_employee_information($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Information</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>    <!-- Bootstrap Color Picker 3.1.2-->
    <link href="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">   
    <script type="application/javascript" >
      var searchId = '<?php echo $searchId ?>';
      var backwardSeparator = '<?php echo $backwardSeparator ?>';
    </script>
    <style type="text/css">
      .avatar-pic {
        width: 150px;
      }
      .Profile-input-file{
          height:180px;width:180px;
          position: absolute;
          top: 0px;
          z-index: 999;
          opacity: 0 !important;
      }
    </style>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/fpdm/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frm_payment_information" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  Payments
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select class="form-control form-control-sm" id="cboSearch" name="cboSearch" placeholder="">
                      </select>
                    </div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <?php include '../instituteTabs.php';?>
                 <div id="personal">
                    <div class="form-row" >
                      <div class="col-sm-12">
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <label for="txtName" class="col-form-label-sm">Type of the Payment</label>
                             <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments">
                    <thead class="">
                      <tr>
                        <th style="width:15%"><img src="../../../../img/bank_t.jpg" width="80%" height="80%"></th>
                        <th style="width: 25%;vertical-align:middle">Bank Through</th>
                        <th style="width: 10%;">&nbsp;</th>
                        <th style="width: 25%;"><img src="../../../../img/online_p.jpg" width="45%" height="45%"></th>
                        <th style="width: 20%;vertical-align:middle">Online Payment</th>
                      </tr>
                    </thead>
                   
                  </table>
                      
                          </div>
                        </div>
						<div class="bankPayment">
                        <div class="form-row form-group col-sm-12">
                        <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments">
                    <thead class="">
                      <tr>
                        <th style="background-color:#CCC;color:#000">Bank Through</th>
                      
                    </thead>
                   
                  </table>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtPayAmount" class="col-form-label-sm">Payment Amount</label>
                            <input type="text" class="form-control form-control-sm" id="txtAmount" name="txtAmount" placeholder="">
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtAddress" class=" col-form-label-sm">Payment Date</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--> <input type="text" class="form-control form-control-sm" id="txtPaymentDate" name="txtPaymentDate" placeholder="">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtRelIns" class="col-form-label-sm">Paying Branch</label>
                            <input type="text" class="form-control form-control-sm" id="txtPaymentBranch" name="txtPaymentBranch" placeholder=""list="branchList">
                            <datalist id="branchList" >
                    <?php $sql="SELECT
branch_Name
from tbl_boc_branch";
$result = $db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
	
	echo '<option  value='.$row['branch_Name'].'>';

	}

?>
  
</datalist>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtRelIns" class="col-form-label-sm">Upload Bank Slip</label>
                            <input type="file" class="form-control form-control-sm" id="txtRelIns" name="txtRelIns" placeholder="">
                          </div>
                          
                        </div>

                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <p><input type="checkbox" id="confirm" name="confirm" class=" col-form-label-sm required" value="confirm"><b>I further declare that the information furnished by me found to be incorrect or false at any stage my application or certificate of registration can be cancelled or suspend by the authority.</b></p>
                          </div>
                        </div>
                        
                        </div>
                        
                        
                        
                        

                        
                      </div>
                    
                    </div>

                    
                    </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                       <button type="button" class="btn btn-warning" id="btnNew" style="width: 100px; margin: 5px;"><i class="fas fa-align-justify"></i>&nbsp;New</button>
              		   <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                   	   <button type="button" class="btn btn-danger" id="btnDelete" style="width: 100px; margin: 5px;"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
                      <button type="button" class="btn btn-info" id="btnClose" style="width: 100px; margin: 5px;"><i class="fas fa-times-circle"></i>&nbsp;Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="payments.js"></script>    
    <script>

//    ===================== snippet for profile picture change ============================ //

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar-pic')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

//    =================================== ends here ============================================ //
    </script>
  </body>
</html>



