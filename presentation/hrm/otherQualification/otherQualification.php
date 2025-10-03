
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\classes\cls_hrm_trn_other_qualification;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_other_qualification_category;
use presentation\hrm\masterData\classes\cls_hrm_other_qualification_type;

$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_trn_other_qualification($db);
?><!DOCTYPE html>
<html>
  <head>
    <title> Other Qualification</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>            <script type="application/javascript" >
      var searchId = '<?php echo $searchId ?>';
      var backwardSeparator = '<?php echo $backwardSeparator ?>';
    </script>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>    <!-- File Remarks Modal -->
    <?php include "{$backwardSeparator}fileRemarksModal.php";?>
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
            <form class="needs-validation" novalidate id="frmhrm_trn_other_qualification">
              <div class="card">
                <div class="card-header">
                   Other Qualification
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
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="cboEmployeeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_employee_id'];?></label>
                        <select class="form-control form-control-sm" id="cboEmployeeId" name="cboEmployeeId" placeholder="">
                          <?php 
                          $modelEmployeeInfomation = new cls_hrm_employee_information($db);
                          $modelEmployeeInfomation->emi_status = 1;
                          $modelEmployeeInfomation->emi_is_deleted = 0;
                          $modelEmployeeInfomation->emi_company_id = $userCompanyId;
                          echo $modelEmployeeInfomation->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboQualificationCategoryId" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_qualification_category_id'];?></label>
                        <select class="form-control form-control-sm" id="cboQualificationCategoryId" name="cboQualificationCategoryId" placeholder="">
                          <?php 
                          $modelCategory = new cls_hrm_other_qualification_category($db);
                          $modelCategory->oqc_status = 1;
                          $modelCategory->oqc_is_deleted = 0;
                          $modelCategory->oqc_company_id = $userCompanyId;
                          echo $modelCategory->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboQualificationTypeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_qualification_type_id'];?></label>
                        <select class="form-control form-control-sm" id="cboQualificationTypeId" name="cboQualificationTypeId" placeholder="">
                          <?php 
                          $modelType = new cls_hrm_other_qualification_type($db);
                          $modelType->oqt_status = 1;
                          $modelType->oqt_is_deleted = 0;
                          $modelType->oqt_company_id = $userCompanyId;
                          echo $modelType->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                      <label for="txtName" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_name'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtName" name="txtName" placeholder="">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="txtStream" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_stream'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtStream" name="txtStream" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="txtInstitute" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_institute'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtInstitute" name="txtInstitute" placeholder="">
                      </div>
                      <div class="form-group col-sm-3">
                        <label for="txtQualificationStatus" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_qualification_status'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtQualificationStatus" name="txtQualificationStatus" placeholder="">
                      </div>
                      <div class="form-group col-sm-3">
                        <label for="txtYear" class="col-form-label-sm"><?php echo $model->attributeLabels()['eoq_year'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtYear" name="txtYear" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['eoq_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['eoq_status'];?></label>
                      <div class="form-group col-sm-10">
                        <select class="form-control form-control-sm" id="cboStatus" name="cboStatus" placeholder="">
                          <?php 
                          $modelStatus->stat_id = [1,21];
                          $modelStatus->stat_status = 1;
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
                      <button type="button" class="btn btn-outline-info" id="btnNew" style="width: 100px; margin: 5px; display:none;">New</button>
                      <button type="button" class="btn btn-outline-primary" id="btnList" style="width: 100px; margin: 5px; display:none;">List</button>
                      <button type="button" class="btn btn-outline-success" id="btnSave" style="width: 100px; margin: 5px; display:none;">Save</button>
                      <button type="button" class="btn btn-outline-info" id="btnPrint" style="width: 100px; margin: 5px; display:none;">Print</button>
                      <button type="button" class="btn btn-outline-primary" id="btnApprove" style="width: 100px; margin: 5px; display:none;">Approve</button>
                      <button type="button" class="btn btn-outline-warning" id="btnReject" style="width: 100px; margin: 5px; display:none;">Reject</button>
                      <button type="button" class="btn btn-outline-danger" id="btnDelete" style="width: 100px; margin: 5px; display:none;">Delete</button>
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
 
    <!-- Custom scripts for This page-->
    <script src="otherQualification.js"></script>  </body>
</html>



