<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
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
use presentation\hrm\masterData\classes\cls_hrm_employee_residential;
use presentation\system\masterData\classes\cls_sys_country;
$modelStatus = new cls_sys_status($db);
$modelCountry = new cls_sys_country($db);
//$model = new cls_hrm_employee_residential($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Residential</title>
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
            <form class="needs-validation" novalidate id="frmhrm_employee_residential">
              <div class="card">
                <div class="card-header">
                  Employee Residential Information
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
        
                    <div class="row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Permanent Residential Information</div>
                        <div class="col text-info"><hr></div>
                    </div>
                  
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentAddress" class="col-form-label-sm">Address</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentAddress" name="txtPermanentAddress" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentStreet" class="col-form-label-sm">Street</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentStreet" name="txtPermanentStreet" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentCity" class="col-form-label-sm">City</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentCity" name="txtPermanentCity" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentPostalCode" class="col-form-label-sm">Postal Code</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentPostalCode" name="txtPermanentPostalCode" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentTelephone" class="col-form-label-sm">Telephone</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentTelephone" name="txtPermanentTelephone" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentMobileNo" class="col-form-label-sm">Mobile No</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentMobileNo" name="txtPermanentMobileNo" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentEmail" class="col-form-label-sm">Email</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentEmail" name="txtPermanentEmail" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboPermanentCountryId" class="col-form-label-sm">Country</label>
                        <select class="form-control form-control-sm" id="cboPermanentCountryId" name="cboPermanentCountryId" placeholder="">
                          <?php 
                          $modelCountry->syt_status = 1;
                          echo $modelCountry->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboPermanentProvinceId" class="col-form-label-sm">Province</label>
                        <select class="form-control form-control-sm" id="cboPermanentProvinceId" name="cboPermanentProvinceId" placeholder="">
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="cboPermanentDistrictId" class="col-form-label-sm">District</label>
                        <select class="form-control form-control-sm" id="cboPermanentDistrictId" name="cboPermanentDistrictId" placeholder="">
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboPermanentDsDivisionId" class="col-form-label-sm">DS Division</label>
                        <select class="form-control form-control-sm" id="cboPermanentDsDivisionId" name="cboPermanentDsDivisionId" placeholder="">
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtPermanentElectorate" class="col-form-label-sm">Electorate</label>
                        <input type="text" class="form-control form-control-sm" id="txtPermanentElectorate" name="txtPermanentElectorate" placeholder="">
                      </div>
                    </div>
      
                    <div class="row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Current / Address During Working Days / Residence</div>
                        <div class="col text-info"><hr></div>
                    </div>
                  
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentAddress" class="col-form-label-sm">Address</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentAddress" name="txtCurrentAddress" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentStreet" class="col-form-label-sm">Street</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentStreet" name="txtCurrentStreet" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentCity" class="col-form-label-sm">City</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentCity" name="txtCurrentCity" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentPostalCode" class="col-form-label-sm">Postal Code</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentPostalCode" name="txtCurrentPostalCode" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentTelephoneGeneralLine" class="col-form-label-sm">Telephone General Line</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentTelephoneGeneralLine" name="txtCurrentTelephoneGeneralLine" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentTelephoneDirectLine" class="col-form-label-sm">Telephone Direct Line</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentTelephoneDirectLine" name="txtCurrentTelephoneDirectLine" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentMobileNo" class="col-form-label-sm">Mobile No</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentMobileNo" name="txtCurrentMobileNo" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentFax" class="col-form-label-sm">Fax</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentFax" name="txtCurrentFax" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtCurrentEmail" class="col-form-label-sm">Email</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentEmail" name="txtCurrentEmail" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="cboCurrentCountryId" class="col-form-label-sm">Country</label>
                        <select class="form-control form-control-sm" id="cboCurrentCountryId" name="cboCurrentCountryId" placeholder="">
                          <?php 
                          $modelCountry->syt_status = 1;
                          echo $modelCountry->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboCurrentProvinceId" class="col-form-label-sm">Province</label>
                        <select class="form-control form-control-sm" id="cboCurrentProvinceId" name="cboCurrentProvinceId" placeholder="">
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboCurrentDistrictId" class="col-form-label-sm">District</label>
                        <select class="form-control form-control-sm" id="cboCurrentDistrictId" name="cboCurrentDistrictId" placeholder="">
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="cboCurrentDsDivisionId" class="col-form-label-sm">DS Division</label>
                        <select class="form-control form-control-sm" id="cboCurrentDsDivisionId" name="cboCurrentDsDivisionId" placeholder="">
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="txtCurrentElectorate" class="col-form-label-sm">Electorate</label>
                        <input type="text" class="form-control form-control-sm" id="txtCurrentElectorate" name="txtCurrentElectorate" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm">Remarks</label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm">Status</label>
                      <div class="form-group col-sm-10">
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
    <script src="employeeResidential.js"></script>    
  </body>
</html>



