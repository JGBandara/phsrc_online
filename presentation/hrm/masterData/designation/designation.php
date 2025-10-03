
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
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
use presentation\hrm\masterData\classes\cls_hrm_designation;
use presentation\hrm\masterData\classes\cls_hrm_service_category;
use presentation\hrm\masterData\classes\cls_hrm_salary_scale;

$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_designation($db);
?><!DOCTYPE html>
<html>
  <head>
    <title> Designation</title>
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
            <form class="needs-validation" novalidate id="frmhrm_designation">
              <div class="card">
                <div class="card-header">
                   Designation
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
                      <label for="cboServiceCategoryId" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_service_category_id'];?></label>
                      <div class="form-group col-sm-10">
                        <select class="form-control form-control-sm" id="cboServiceCategoryId" name="cboServiceCategoryId" placeholder="">
                          <?php 
                          $modelServiceCategory = new cls_hrm_service_category($db);
                          $modelServiceCategory->sct_status = 1;
                          $modelServiceCategory->sct_is_deleted = 0;
                          $modelServiceCategory->sct_company_id = $userCompanyId;
                          echo $modelServiceCategory->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtName" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_name'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtName" name="txtName" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtCode" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_code'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtCode" name="txtCode" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboSalaryCodeId" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_salary_code_id'];?></label>
                      <div class="form-group col-sm-10">
                        <select class="form-control form-control-sm" id="cboSalaryCodeId" name="cboSalaryCodeId" placeholder="">
                          <?php 
                          $modelSalaryScale = new cls_hrm_salary_scale($db);
                          $modelSalaryScale->scl_status = 1;
                          $modelSalaryScale->scl_is_deleted = 0;
                          $modelSalaryScale->scl_company_id = $userCompanyId;
                          echo $modelSalaryScale->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="optOtAllowed" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_ot_allowed'];?></label>
                      <div class="form-group col-sm-10">
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optOtAllowed" name="optOtAllowed" value="1">
                          <!-- <label class="form-check-label" for="optOtAllowed">Ot Allowed</label>-->
                        </div>
                      </div>
                    </div>
        
                    <div class="form-row">
                      <label for="optEarlyOtAllowed" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_early_ot_allowed'];?></label>
                      <div class="form-group col-sm-10">
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optEarlyOtAllowed" name="optEarlyOtAllowed" value="1">
                          <!-- <label class="form-check-label" for="optEarlyOtAllowed">Early Ot Allowed</label>-->
                        </div>
                      </div>
                    </div>
        
                    <div class="form-row">
                      <label for="cboCadre" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_cadre'];?></label>
                      <div class="form-group col-sm-10">
                        <input class="form-control form-control-sm" type="text" id="cboCadre" name="cboCadre" value="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="optRank" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_rank'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="optRank" name="optRank" placeholder="" data-toggle="tooltip" data-placement="top" title="1 is indicate the highest rank">
                          <!-- <label class="form-check-label" for="optRank">Rank</label>-->
                      </div>
                    </div>
        
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dsg_status'];?></label>
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
    <script src="designation.js"></script>  </body>
</html>



