
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
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
use presentation\hrm\classes\cls_hrm_trn_language_skills;
use presentation\hrm\masterData\classes\cls_hrm_language_skill;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_language_merit;
use presentation\system\masterData\classes\cls_sys_communication_language;

$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_trn_language_skills($db);
?><!DOCTYPE html>
<html>
  <head>
    <title> Language Skills</title>
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
            <form class="needs-validation" novalidate id="frmhrm_trn_language_skills">
              <div class="card">
                <div class="card-header">
                   Language Skills
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
                      <div class="form-group col-sm-6">
                        <label for="cboEmployeeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['lgs_employee_id'];?></label>
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
                      <div class="form-group col-sm-6">
                        <label for="cboLanguageId" class="col-form-label-sm"><?php echo $model->attributeLabels()['lgs_language_id'];?></label>
                        <select class="form-control form-control-sm" id="cboLanguageId" name="cboLanguageId" placeholder="">
                          <?php 
                          $modelLanguage = new cls_sys_communication_language($db);
                          $modelLanguage->syg_status = 1;
                          $modelLanguage->syg_is_deleted = 0;
                          $modelLanguage->syg_company_id = $userCompanyId;
                          echo $modelLanguage->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col text-info"><hr></div>
                    </div>
                    <?php 
                    $modelSkill = new cls_hrm_language_skill($db);
                    $modelSkill->ski_status = 1;
                    $modelSkill->ski_is_deleted = 0;
                    $modelSkill->ski_company_id = $userCompanyId;
                    $modelsSkill = $modelSkill->getModels();
                    foreach ($modelsSkill as $modelSkill) {
                    ?>
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="" class="col-form-label-sm"><?php echo $modelSkill->ski_name;?></label>
                      </div>
                      <div class="form-group col-sm-6">
                        <input type="hidden" name="cboSkillTypeId[]" value="<?php echo $modelSkill->ski_id;?>"/>
                        <select class="form-control form-control-sm type_<?php echo $modelSkill->ski_id;?>" id="cboMeritId" name="cboMeritId[]" placeholder="">
                          <?php 
                          $modelMerit = new cls_hrm_language_merit($db);
                          $modelMerit->lmt_status = 1;
                          $modelMerit->lmt_is_deleted = 0;
                          $modelMerit->lmt_company_id = $userCompanyId;
                          echo $modelMerit->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
                    <?php }?>
      
                    <div class="row">
                        <div class="col text-info"><hr></div>
                    </div>
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['lgs_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['lgs_status'];?></label>
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
    <script src="languageSkills.js"></script>  </body>
</html>



