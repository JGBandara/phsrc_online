
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

$searchId = (isset($_REQUEST['id']))?isset($_REQUEST['id']):'';
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\hrm\masterData\classes\cls_hrm_division;
use presentation\hrm\masterData\classes\cls_hrm_designation;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
$modelStatus = new cls_sys_status($db);
//$model = new cls_sys_users($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>User</title>
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
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/system/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frmsys_users">
              <div class="card">
                <div class="card-header">
                  User
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
      
                    <div class="form-group row">
                      <label for="txtUserName" class="col-sm-2 col-form-label-sm">User Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtUserName" name="txtUserName" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtPassword" class="col-sm-2 col-form-label-sm">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control form-control-sm" id="txtPassword" name="txtPassword" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtFullName" class="col-sm-2 col-form-label-sm">Full Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtFullName" name="txtFullName" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboDivisionId" class="col-sm-2 col-form-label-sm">Division</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboDivisionId" name="cboDivisionId" placeholder="">
                          <?php 
                          $modelDivision = new cls_hrm_division($db);
                          $modelDivision->div_status = 1;
                          $modelDivision->div_is_deleted = 0;
                          $modelDivision->div_company_id = $userCompanyId;
                          echo $modelDivision->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtContactNo" class="col-sm-2 col-form-label-sm">Contact No</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtContactNo" name="txtContactNo" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboDesignationId" class="col-sm-2 col-form-label-sm">Designation</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboDesignationId" name="cboDesignationId" placeholder="">
                          <?php 
                          $modelDesignation = new cls_hrm_designation($db);
                          $modelDesignation->dsg_status = 1;
                          $modelDesignation->dsg_is_deleted = 0;
                          $modelDesignation->dsg_company_id = $userCompanyId;
                          echo $modelDesignation->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
<!--                    <div class="form-group row">
                      <label for="txtGender" class="col-sm-2 col-form-label-sm">Gender</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtGender" name="txtGender" placeholder="">
                      </div>
                    </div>
      -->
                    <div class="form-group row">
                      <label for="txtEmail" class="col-sm-2 col-form-label-sm">Email</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtEmail" name="txtEmail" placeholder="">
                      </div>
                    </div>
            
                    <div class="form-group row">
                      <label for="cboEmployeeId" class="col-sm-2 col-form-label-sm">Employee</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboEmployeeId" name="cboEmployeeId" placeholder="">
                          <?php 
                          $modelEmployee = new cls_hrm_employee_information($db);
                          $modelEmployee->emi_status = 1;
                          $modelEmployee->emi_is_deleted = 0;
                          $modelEmployee->emi_company_id = $userCompanyId;
                          echo $modelEmployee->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm">Remarks</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm">Status</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboStatus" name="cboStatus" placeholder="">
                          <?php 
                          $modelStatus->stat_id = [1,21];
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="button" class="btn btn-outline-secondary" id="btnClose" style="width: 100px; margin: 5px;">Close</button>
                      <button type="button" class="btn btn-outline-info" id="btnNew" style="width: 100px; margin: 5px;">New</button>
                      <button type="button" class="btn btn-outline-primary" id="btnList" style="width: 100px; margin: 5px;">List</button>
                      <button type="button" class="btn btn-outline-success" id="btnSave" style="width: 100px; margin: 5px;">Save</button>
                      <button type="button" class="btn btn-outline-info" id="btnPrint" style="width: 100px; margin: 5px;">Print</button>
                      <button type="button" class="btn btn-outline-primary" id="btnApprove" style="width: 100px; margin: 5px;">Approve</button>
                      <button type="button" class="btn btn-outline-warning" id="btnReject" style="width: 100px; margin: 5px;">Reject</button>
                      <button type="button" class="btn btn-outline-danger" id="btnDelete" style="width: 100px; margin: 5px;">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="user.js"></script>    
  </body>
</html>



