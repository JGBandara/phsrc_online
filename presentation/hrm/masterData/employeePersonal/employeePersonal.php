
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
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\masterData\classes\cls_hrm_employee_personal;
use presentation\system\masterData\classes\cls_sys_marital_status;
use presentation\system\masterData\classes\cls_sys_passport_type;

$modelStatus = new cls_sys_status($db);
$modelMaritalStatus = new cls_sys_marital_status($db);
$modelPassportType = new cls_sys_passport_type($db);
//$model = new cls_hrm_employee_personal($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Personal</title>
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
      <?php include "{$backwardSeparator}presentation/hrm/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frmhrm_employee_personal">
              <div class="card">
                <div class="card-header">
                  Employee Personal Information
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
                  <?php include '../employeeTabs.php';?>                  
      
                    <div class="form-row">
                      <div class=" form-group col-sm-4">
                        <label for="txtInitials" class="col-form-label-sm">Initials</label>
                        <input type="text" class="form-control form-control-sm" id="txtInitials" name="txtInitials" placeholder="">
                      </div>
                      <div class=" form-group col-sm-4">
                        <label for="txtMiddleName" class="col-form-label-sm">Middle Name</label>
                        <input type="text" class="form-control form-control-sm" id="txtMiddleName" name="txtMiddleName" placeholder="">
                      </div>
                      <div class=" form-group col-sm-4">
                        <label for="txtSurname" class="col-form-label-sm">Surname</label>
                        <input type="text" class="form-control form-control-sm" id="txtSurname" name="txtSurname" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="txtNameDenotedByInitials" class="col-form-label-sm">Name Denoted By Initials</label>
                        <input type="text" class="form-control form-control-sm" id="txtNameDenotedByInitials" name="txtNameDenotedByInitials" placeholder="">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="txtFullName" class="col-form-label-sm">Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="txtFullName" name="txtFullName" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtOtherName" class="col-form-label-sm">Other Name</label>
                        <input type="text" class="form-control form-control-sm" id="txtOtherName" name="txtOtherName" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtNicNo" class="col-form-label-sm">NIC No</label>
                        <input type="text" class="form-control form-control-sm" id="txtNicNo" name="txtNicNo" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="dtpNicIssueDate" class="col-form-label-sm">NIC Issue Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpNicIssueDate" name="dtpNicIssueDate" placeholder="">
                      </div>
                    </div>
        
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtNationality" class="col-form-label-sm">Nationality</label>
                        <input type="text" class="form-control form-control-sm" id="txtNationality" name="txtNationality" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtRace" class="col-form-label-sm">Race</label>
                        <input type="text" class="form-control form-control-sm" id="txtRace" name="txtRace" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtReligion" class="col-form-label-sm">Religion</label>
                        <input type="text" class="form-control form-control-sm" id="txtReligion" name="txtReligion" placeholder="">
                      </div>
                    </div>
      
        
                    <div class="form-row">
                      <fieldset class="form-group  col-sm-4">
                        <legend class="col-form-label-sm pt-0">Gender</legend>
                          <div class="form-check form-control-sm form-check-inline">
                            <input class="form-check-input" type="radio" name="optGender" id="optGender_1" value="1" checked>
                            <label class="form-check-label" for="optGender_1">Male</label>
                          </div>
                          <div class="form-check form-control-sm form-check-inline">
                            <input class="form-check-input" type="radio" name="optGender" id="optGender_2" value="0">
                            <label class="form-check-label" for="optGender_2">Female</label>
                          </div>
                      </fieldset>
                      <div class="form-group col-sm-4">
                        <label for="dtpDateOfBirth" class="col-form-label-sm">Date Of Birth</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpDateOfBirth" name="dtpDateOfBirth" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtBloodGroup" class="col-form-label-sm">Blood Group</label>
                        <input type="text" class="form-control form-control-sm" id="txtBloodGroup" name="txtBloodGroup" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="optMaritialStatusId" class="col-form-label-sm">Marital Status</label>
                        <select class="form-control form-control-sm" id="optMaritialStatusId" name="optMaritialStatusId" placeholder="">
                          <?php 
                          $modelMaritalStatus->sya_company_id = $userCompanyId;
                          echo $modelMaritalStatus->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="dtpMarriedDate" class="col-form-label-sm">Married Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpMarriedDate" name="dtpMarriedDate" placeholder="">
                      </div>
                    </div>
        
                    <div class="row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Passport</div>
                        <div class="col text-info"><hr></div>
                    </div>
                  
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtPassportNo" class="col-form-label-sm">Passport No</label>
                        <input type="text" class="form-control form-control-sm" id="txtPassportNo" name="txtPassportNo" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="optPassportType" class="col-form-label-sm">Passport Type</label>
                        <select class="form-control form-control-sm" id="optPassportType" name="optPassportType" placeholder="">
                          <?php 
                          $modelPassportType->syb_company_id = $userCompanyId;
                          echo $modelPassportType->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="dtpPassportIssueDate" class="col-form-label-sm">Passport Issue Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpPassportIssueDate" name="dtpPassportIssueDate" placeholder="">
                      </div>
                    </div>
        
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtPassportIssuePlace" class="col-form-label-sm">Passport Issue Place</label>
                        <input type="text" class="form-control form-control-sm" id="txtPassportIssuePlace" name="txtPassportIssuePlace" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="dtpPassportExpiryDate" class="col-form-label-sm">Passport Expiry Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_future" id="dtpPassportExpiryDate" name="dtpPassportExpiryDate" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtPassportCountries" class="col-form-label-sm">Passport Countries</label>
                        <input type="text" class="form-control form-control-sm" id="txtPassportCountries" name="txtPassportCountries" placeholder="">
                      </div>
                    </div>
      
                    <div class="row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Driving License</div>
                        <div class="col text-info"><hr></div>
                    </div>
                  
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtDrivingLicenseNo" class="col-form-label-sm">Driving License No</label>
                        <input type="text" class="form-control form-control-sm" id="txtDrivingLicenseNo" name="txtDrivingLicenseNo" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="dtpDrivingLicenseIssueDate" class="col-form-label-sm">Driving License Issue Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpDrivingLicenseIssueDate" name="dtpDrivingLicenseIssueDate" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="dtpDrivingLicenseExpiryDate" class="col-form-label-sm">Driving License Expiry Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_future" id="dtpDrivingLicenseExpiryDate" name="dtpDrivingLicenseExpiryDate" placeholder="">
                      </div>
                    </div>
        
                    <div class="form-row">
                      <div class="form-group col-sm-12">
                        <label for="txtDrivingLicenseVehicleClass" class="col-form-label-sm">Driving License Vehicle Class</label>
                        <input type="text" class="form-control form-control-sm" id="txtDrivingLicenseVehicleClass" name="txtDrivingLicenseVehicleClass" placeholder="">
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
    <script src="employeePersonal.js"></script>    
  </body>
</html>



