
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-06
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
use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_country;
use presentation\system\masterData\classes\cls_sys_currency;

$modelStatus = new cls_sys_status($db);
$modelCountry = new cls_sys_country($db);
$modelCurrency = new cls_sys_currency($db);
//$model = new cls_sys_companies($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Company</title>
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
            <form class="needs-validation" novalidate id="frmsys_companies">
              <div class="card">
                <div class="card-header">
                  Company
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
                      <label for="txtCode" class="col-sm-2 col-form-label-sm">Code</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtCode" name="txtCode" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtName" class="col-sm-2 col-form-label-sm">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtName" name="txtName" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboCountryId" class="col-sm-2 col-form-label-sm">Country</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboCountryId" name="cboCountryId" placeholder="">
                          <?php 
                          $modelCountry->syt_status = 1;
                          echo $modelCountry->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtWebSite" class="col-sm-2 col-form-label-sm">Web Site</label>
                      <div class="col-sm-10">
                        <input type="url" class="form-control form-control-sm" id="txtWebSite" name="txtWebSite" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm">Remarks</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-inline form-group row">
                      <label for="txtAccountNo" class="col-sm-2 col-form-label-sm float-sm-left">Account No</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="txtAccountNo" name="txtAccountNo" placeholder="">
                      </div>
                      <label for="txtRegistrationNo" class="col-sm-2 col-form-label-sm">Registration No</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="txtRegistrationNo" name="txtRegistrationNo" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-inline form-group row">
                      <label for="txtVatNo" class="col-sm-2 col-form-label-sm">Vat No</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="txtVatNo" name="txtVatNo" placeholder="">
                      </div>
                      <label for="txtSvatNo" class="col-sm-2 col-form-label-sm">Svat No</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="txtSvatNo" name="txtSvatNo" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-inline form-group row">
                      <label for="txtWorkingDayType" class="col-sm-2 col-form-label-sm">Working Day Type</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="txtWorkingDayType" name="txtWorkingDayType" placeholder="">
                      </div>
                      <label for="cboBaseCurrencyId" class="col-sm-2 col-form-label-sm">Base Currency</label>
                      <div class="col-sm-4">
                        <select class="form-control form-control-sm" id="cboBaseCurrencyId" name="cboBaseCurrencyId" placeholder="">
                          <?php 
                          $modelCurrency->syy_status = 1;
                          echo $modelCurrency->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-inline form-group row">
                      <div class="col-sm-2 col-form-label-sm">Tax Applicable</div>
                      <div class="col-sm-4">
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optTaxApplicable" name="optTaxApplicable" value="1">
                          <!-- <label class="form-check-label" for="optTaxApplicable">Tax Applicable</label>-->
                        </div>
                      </div>
                      <div class="col-sm-2 col-form-label-sm">Nopay Consider</div>
                      <div class="col-sm-4">
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optNopayConsider" name="optNopayConsider" value="1">
                          <!-- <label class="form-check-label" for="optNopayConsider">Nopay Consider</label>-->
                        </div>
                      </div>
                    </div>
        
                    <div class="form-group row">
                      <label for="txtMenuOrder" class="col-sm-2 col-form-label-sm">Menu Order</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtMenuOrder" name="txtMenuOrder" placeholder="">
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
    
    <!-- Common Script -->
    <script src="<?php echo $backwardSeparator;?>js/common.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="company.js"></script>    
  </body>
</html>



