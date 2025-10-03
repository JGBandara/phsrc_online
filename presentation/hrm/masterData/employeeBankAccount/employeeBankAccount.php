
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

$employeeId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
$searchId = (isset($_REQUEST['rec_id']))?$_REQUEST['rec_id']:'';
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\masterData\classes\cls_hrm_employee_bank_account;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\system\masterData\classes\cls_sys_bank;
$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_employee_bank_account($db);
$modelEmployeeInfomation = new cls_hrm_employee_information($db);
$modelBank = new cls_sys_bank($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Bank Account</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>    <!-- Bootstrap Color Picker 3.1.2-->
    <link href="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">   
    <script type="application/javascript" >
      var searchId = '<?php echo $searchId ?>';
      var employeeId = '<?php echo $employeeId ?>';
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
            <form class="needs-validation" novalidate id="frmhrm_employee_bank_account">
              <div class="card">
                <div class="card-header">
                  Employee Bank Account Information
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
                  <table class="table table-hover table-bordered small" id="tblEmpExistingBankAcc">
                    <thead class="">
                      <tr>
                        <th>Action</th>
                        <th style="width: 20%;"><?php echo $model->attributeLabels()['ema_bank_id'];?></th>
                        <th style="width: 20%;"><?php echo $model->attributeLabels()['ema_branch_id'];?></th>
                        <th style="width: 20%;"><?php echo $model->attributeLabels()['ema_account_no'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['ema_amount'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['ema_status'];?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cloneRow" style="display: none;">
                        <td align='center' class="p-1">
                          <a href="./employeeBankAccount.php?id=" class="action" target="_parent"><span class="fas fa-pencil-alt actionView"></span></a>
                        </td>
                        <td class="bank p-1"></td>
                        <td class="branch p-1"></td>
                        <td class="account p-1"></td>
                        <td class="amount p-1"></td>
                        <td class="status p-1"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="cboEmployeeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['ema_employee_id'];?></label>
                        <select class="form-control form-control-sm" id="cboEmployeeId" name="cboEmployeeId" placeholder="">
                          <?php 
                          $modelEmployeeInfomation->emi_status = 1;
                          $modelEmployeeInfomation->emi_is_deleted = 0;
                          $modelEmployeeInfomation->emi_company_id = $userCompanyId;
                          echo $modelEmployeeInfomation->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboBankId" class="col-form-label-sm"><?php echo $model->attributeLabels()['ema_bank_id'];?></label>
                        <select class="form-control form-control-sm" id="cboBankId" name="cboBankId" placeholder="">
                          <?php 
                          $modelBank->sye_status = 1;
                          $modelBank->sye_is_deleted = 0;
                          echo $modelBank->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboBranchId" class="col-form-label-sm"><?php echo $model->attributeLabels()['ema_branch_id'];?></label>
                        <select class="form-control form-control-sm" id="cboBranchId" name="cboBranchId" placeholder="">
                          <?php 
                          $modelStatus->stat_id = [1,21];
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
                  
                    <div class="form-row">                  
                      <div class="form-group col-sm-8">
                        <label for="txtAccountNo" class="col-form-label-sm"><?php echo $model->attributeLabels()['ema_account_no'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtAccountNo" name="txtAccountNo" placeholder="">
                      </div>
                      <fieldset class="form-group col-sm-4">
                          <legend class="col-form-label-sm pt-0"><?php echo $model->attributeLabels()['ema_account_type'];?></legend>
                          <div class="form-check form-control-sm form-check-inline">
                            <input class="form-check-input" type="radio" name="optAccountType" id="optAccountType_1" value="1" checked>
                            <label class="form-check-label" for="optAccountType_1">Current</label>
                          </div>
                          <div class="form-check form-control-sm form-check-inline">
                            <input class="form-check-input" type="radio" name="optAccountType" id="optAccountType_2" value="2">
                            <label class="form-check-label" for="optAccountType_2">Saving</label>
                          </div>
                      </fieldset>      
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-8">
                        <label for="txtAccountHolder" class="col-form-label-sm"><?php echo $model->attributeLabels()['ema_account_holder'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtAccountHolder" name="txtAccountHolder" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtAmount" class="col-form-label-sm"><?php echo $model->attributeLabels()['ema_amount'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtAmount" name="txtAmount" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['ema_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['ema_status'];?></label>
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
            </form>
          </div>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="employeeBankAccount.js"></script>    
  </body>
</html>



