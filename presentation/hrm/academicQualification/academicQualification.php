
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
//include  "{$backwardSeparator}dataAccess/connector.php";
 
$employeeId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
$searchId = (isset($_REQUEST['rec_id']))?$_REQUEST['rec_id']:'';
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\classes\cls_hrm_trn_academic_qualification;
use presentation\hrm\classes\cls_hrm_trn_academic_qualification_details;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_academic_qualification_stream;
use presentation\hrm\masterData\classes\cls_hrm_academic_qualification_type;

$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_trn_academic_qualification($db);
$modelDetails = new cls_hrm_trn_academic_qualification_details($db);
?><!DOCTYPE html>
<html>
  <head>
    <title> Academic Qualification</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>            
    <script type="application/javascript" >
      var employeeId = '<?php echo $employeeId ?>';
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
            <form class="needs-validation" novalidate id="frmhrm_trn_academic_qualification">
              <div class="card">
                <div class="card-header">
                   Academic Qualification
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
                  <table class="table table-hover table-bordered small" id="tblacademicQualification">
                    <thead class="">
                      <tr>
                        <th>Action</th>
                        
                            <th style="width: 15%;"><?php echo $model->attributeLabels()['eaq_type_id'];?></th>
                            <th style="width: 15%;"><?php echo $model->attributeLabels()['eaq_stream_id'];?></th>
                            <th style="width: 15%;"><?php echo $model->attributeLabels()['eaq_institute'];?></th>
                            <th style="width: 15%;"><?php echo $model->attributeLabels()['eaq_year'];?></th>
                            <th style="width: 15%;"><?php echo $model->attributeLabels()['eaq_status'];?></th>                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cloneRow" style="display: none;">
                        <td align='center' class="p-1">
                          <a href="./academicQualification.php?id=" class="action" target="_parent"><span class="fas fa-pencil-alt actionView"></span></a>
                        </td>
                        <td class="eaq_type_id p-1"></td>
                          <td class="eaq_stream_id p-1"></td>
                          <td class="eaq_institute p-1"></td>
                          <td class="eaq_year p-1"></td>
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
                        <label for="cboEmployeeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['eaq_employee_id'];?></label>
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
                        <label for="cboTypeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['eaq_type_id'];?></label>
                        <select class="form-control form-control-sm" id="cboTypeId" name="cboTypeId" placeholder="">
                          <?php 
                          $modelType = new cls_hrm_academic_qualification_type($db);
                          $modelType->aqt_status = 1;
                          $modelType->aqt_is_deleted = 0;
                          $modelType->aqt_company_id = $userCompanyId;
                          echo $modelType->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboStreamId" class="col-form-label-sm"><?php echo $model->attributeLabels()['eaq_stream_id'];?></label>
                        <select class="form-control form-control-sm" id="cboStreamId" name="cboStreamId" placeholder="">
                          <?php 
                          $modelStream = new cls_hrm_academic_qualification_stream($db);
                          $modelStream->aqs_status = 1;
                          $modelStream->aqs_is_deleted = 0;
                          $modelStream->aqs_company_id = $userCompanyId;
                          echo $modelStream->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-8">
                        <label for="txtInstitute" class="col-form-label-sm"><?php echo $model->attributeLabels()['eaq_institute'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtInstitute" name="txtInstitute" placeholder="">
                      </div>
                      <div class="form-group col-sm-2">
                        <label for="txtYear" class="col-form-label-sm"><?php echo $model->attributeLabels()['eaq_year'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtYear" name="txtYear" placeholder="">
                      </div>
                      <div class="form-group col-sm-2">
                        <label for="txtIndexNo" class="col-form-label-sm"><?php echo $model->attributeLabels()['eaq_index_no'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtIndexNo" name="txtIndexNo" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['eaq_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['eaq_status'];?></label>
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

<!-- ==================================================================================== -->
<!-- =============================    Details        ==================================== -->
<!-- ==================================================================================== -->
                  <div class="card"> <!-- Detail card -->
                    <div class="table-responsive">
                      <table class="table" id="tblhrm_trn_academic_qualification_details">
                        <thead>
                          <tr>
      
                            <th scope="col"><?php echo $modelDetails->attributeLabels()['eaqd_subject_id'];?></th>      
                            <th scope="col"><?php echo $modelDetails->attributeLabels()['eaqd_grade'];?></th>      
                            <th scope="col"><?php echo $modelDetails->attributeLabels()['eaqd_remarks'];?></th>                            <th scope="col"><div class="rounded-circle btn btn-success detailButton newDataRow"><span class="fas fa-plus text-white"></span></div> </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="cloneRow">
      
                            <td>
                              <select class="form-control form-control-sm detSubjectId" placeholder="">
                              </select>
                            </td>      
                            <td>
                              <input type="text" class="form-control form-control-sm detGrade"  placeholder="">
                            </td>      
                            <td>
                              <input type="text" class="form-control form-control-sm detRemarks"  placeholder="">
                            </td>                            <td>
                              <input type="hidden" class="form-control form-control-sm detId" placeholder="">
                              <div class="rounded-circle btn btn-danger detailButton deleteDataRow"><span class="fas fa-minus text-white"></span></div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div> <!-- End Detail card -->
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
    <script src="academicQualification.js"></script>  </body>
</html>



