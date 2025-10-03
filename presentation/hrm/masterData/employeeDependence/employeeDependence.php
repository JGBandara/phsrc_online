<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
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
use presentation\hrm\masterData\classes\cls_hrm_employee_dependence;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\system\masterData\classes\cls_sys_marital_status;
use presentation\hrm\masterData\classes\cls_hrm_dependence_work_type;

$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_employee_dependence($db);
$modelEmployeeInfomation = new cls_hrm_employee_information($db);
$modelMaritalStatus = new cls_sys_marital_status($db);
$modelWorkType = new cls_hrm_dependence_work_type($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Dependence</title>
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
            <form class="needs-validation" novalidate id="frmhrm_employee_dependence">
              <div class="card">
                <div class="card-header">
                  Employee Dependence Information
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
                  
                  <table class="table table-hover table-bordered small" id="tblEmpExistingDependence">
                    <thead class="">
                      <tr>
                        <th>Action</th>
                        <th style="width: 35%;"><?php echo $model->attributeLabels()['emd_full_name'];?></th>
                        <th style="width: 20%;"><?php echo $model->attributeLabels()['emd_date_of_birth'];?></th>
                        <th style="width: 20%;"><?php echo $model->attributeLabels()['emd_telephone'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['emd_status'];?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cloneRow" style="display: none;">
                        <td align='center' class="p-1">
                          <a href="./employeeDependence.php?id=" class="action" target="_parent"><span class="fas fa-pencil-alt actionView"></span></a>
                        </td>
                        <td class="name p-1"></td>
                        <td class="dob p-1"></td>
                        <td class="telephone p-1"></td>
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
                        <label for="cboEmployeeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_employee_id'];?></label>
                        <select class="form-control form-control-sm" id="cboEmployeeId" name="cboEmployeeId" placeholder="">
                          <?php 
                          $modelEmployeeInfomation->emi_status = 1;
                          $modelEmployeeInfomation->emi_is_deleted = 0;
                          $modelEmployeeInfomation->emi_company_id = $userCompanyId;
                          echo $modelEmployeeInfomation->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-8">
                        <label for="txtFullName" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_full_name'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtFullName" name="txtFullName" placeholder="">
                      </div>
                    </div>
        
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="dtpDateOfBirth" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_date_of_birth'];?></label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpDateOfBirth" name="dtpDateOfBirth" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtNicNo" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_nic_no'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtNicNo" name="txtNicNo" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtTelephone" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_telephone'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtTelephone" name="txtTelephone" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="optEntitledDeathDonation" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_entitled_death_donation'];?></label>
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optEntitledDeathDonation" name="optEntitledDeathDonation" value="1">
                          <!-- <label class="form-check-label" for="optEntitledDeathDonation">Entitled Death Donation</label>-->
                        </div>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="optEntitledMedicalBenifits" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_entitled_medical_benifits'];?></label>
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optEntitledMedicalBenifits" name="optEntitledMedicalBenifits" value="1">
                          <!-- <label class="form-check-label" for="optEntitledMedicalBenifits">Entitled Medical Benifits</label>-->
                        </div>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="optProvidentFundNominee" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_provident_fund_nominee'];?></label>
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optProvidentFundNominee" name="optProvidentFundNominee" value="1">
                          <!-- <label class="form-check-label" for="optProvidentFundNominee">Provident Fund Nominee</label>-->
                        </div>
                      </div>
                    </div>
        
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="optLiving" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_living'];?></label>
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optLiving" name="optLiving" value="1">
                          <!-- <label class="form-check-label" for="optLiving">Living</label>-->
                        </div>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="optSameOffice" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_same_office'];?></label>
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optSameOffice" name="optSameOffice" value="1">
                          <!-- <label class="form-check-label" for="optSameOffice">Same Office</label>-->
                        </div>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="optWorkType" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_work_type'];?></label>
                        <select class="form-control form-control-sm" id="optWorkType" name="optWorkType" placeholder="">
                          <?php 
                          $modelWorkType->emw_is_deleted = 0;
                          $modelWorkType->emw_company_id = $userCompanyId;
                          echo $modelWorkType->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
        
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="cboMaritalStatusId" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_marital_status_id'];?></label>
                        <select class="form-control form-control-sm" id="cboMaritalStatusId" name="cboMaritalStatusId" placeholder="">
                          <?php 
                          $modelMaritalStatus->sya_is_deleted = 0;
                          $modelMaritalStatus->sya_company_id = $userCompanyId;
                          echo $modelMaritalStatus->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtWorkingTelephone" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_working_telephone'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtWorkingTelephone" name="txtWorkingTelephone" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="txtMobile" class="col-form-label-sm"><?php echo $model->attributeLabels()['emd_mobile'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtMobile" name="txtMobile" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtWorkingAddress" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['emd_working_address'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtWorkingAddress" name="txtWorkingAddress" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtPermanentAddress" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['emd_permanent_address'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtPermanentAddress" name="txtPermanentAddress" placeholder="">
                      </div>
                    </div>
                   
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['emd_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['emd_status'];?></label>
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
    <script src="employeeDependence.js"></script>    
  </body>
</html>



