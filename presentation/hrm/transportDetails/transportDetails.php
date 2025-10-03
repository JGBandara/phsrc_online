
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
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

$employeeId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
$searchId = (isset($_REQUEST['rec_id']))?$_REQUEST['rec_id']:'';
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\classes\cls_hrm_trn_transport_details;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_transport_mode;
use presentation\hrm\masterData\classes\cls_hrm_transport_vehicle_type;
use presentation\hrm\masterData\classes\cls_hrm_dwelling_mode;

$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_trn_transport_details($db);
?><!DOCTYPE html>
<html>
  <head>
    <title> Transport Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>            
    <script type="application/javascript" >
      var searchId = '<?php echo $searchId ?>';
      var employeeId = '<?php echo $employeeId ?>';
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
            <form class="needs-validation" novalidate id="frmhrm_trn_transport_details">
              <div class="card">
                <div class="card-header">
                   Transport Details
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
                  <?php include '../masterData/employeeTabsEmployee.php';?>                  
                  
                  <table class="table table-hover table-bordered small" id="tblEmpTransportDetails">
                    <thead class="">
                      <tr>
                        <th>Action</th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['etd_transport_mode_id'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['etd_dwelling_mode_id'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['etd_travelling_time'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['etd_distance'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['etd_duration'];?></th>
                        <th style="width: 15%;"><?php echo $model->attributeLabels()['ejt_status'];?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cloneRow" style="display: none;">
                        <td align='center' class="p-1">
                          <a href="./transportDetails.php?id=" class="action" target="_parent"><span class="fas fa-pencil-alt actionView"></span></a>
                        </td>
                        <td class="mode p-1"></td>
                        <td class="dwelling p-1"></td>
                        <td class="time p-1"></td>
                        <td class="distance p-1"></td>
                        <td class="duration p-1"></td>
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
                        <label for="cboEmployeeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_employee_id'];?></label>
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
                        <label for="cboTransportModeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_transport_mode_id'];?></label>
                        <select class="form-control form-control-sm" id="cboTransportModeId" name="cboTransportModeId" placeholder="">
                          <?php 
                          $modelTrasportMode = new cls_hrm_transport_mode($db);
                          $modelTrasportMode->tmd_status = 1;
                          $modelTrasportMode->tmd_is_deleted = 0;
                          $modelTrasportMode->tmd_company_id = $userCompanyId;
                          echo $modelTrasportMode->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="cboTransportVehicleTypeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_transport_vehicle_type_id'];?></label>
                        <select class="form-control form-control-sm" id="cboTransportVehicleTypeId" name="cboTransportVehicleTypeId" placeholder="">
                          <?php 
                          $modeVehicleType = new cls_hrm_transport_vehicle_type($db);
                          $modeVehicleType->tvt_status = 1;
                          $modeVehicleType->tvt_is_deleted = 0;
                          $modeVehicleType->tvt_company_id = $userCompanyId;
                          echo $modeVehicleType->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-12">
                        <label for="txtRoute" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_route'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtRoute" name="txtRoute" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-3">
                        <label for="txtTravellingTime" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_travelling_time'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtTravellingTime" name="txtTravellingTime" placeholder="">
                      </div>
                      <div class="form-group col-sm-3">
                        <label for="txtDistance" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_distance'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtDistance" name="txtDistance" placeholder="">
                      </div>
                      <div class="form-group col-sm-3">
                        <label for="cboDwellingModeId" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_dwelling_mode_id'];?></label>
                        <select class="form-control form-control-sm" id="cboDwellingModeId" name="cboDwellingModeId" placeholder="">
                          <?php 
                          $modelDwellingMode = new cls_hrm_dwelling_mode($db);
                          $modelDwellingMode->dwm_status = 1;
                          $modelDwellingMode->dwm_is_deleted = 0;
                          $modelDwellingMode->dwm_company_id = $userCompanyId;
                          echo $modelDwellingMode->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-3">
                        <label for="txtDuration" class="col-form-label-sm"><?php echo $model->attributeLabels()['etd_duration'];?></label>
                        <input type="text" class="form-control form-control-sm" id="txtDuration" name="txtDuration" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['etd_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['etd_status'];?></label>
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
    <script src="transportDetails.js"></script>  </body>
</html>



