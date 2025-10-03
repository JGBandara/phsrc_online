
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-11
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
use presentation\dms\masterData\classes\cls_dms_file_group;
$modelStatus = new cls_sys_status($db);
$model = new cls_dms_file_group($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>FileGroup</title>
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
      <?php include "{$backwardSeparator}presentation/dms/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frmdms_file_group">
              <div class="card">
                <div class="card-header">
                  FileGroup
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
                      <label for="txtName" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dfg_name'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtName" name="txtName" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dfg_remarks'];?></label>
                      <div class="form-group col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm"><?php echo $model->attributeLabels()['dfg_status'];?></label>
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
    <script src="fileGroup.js"></script>    
  </body>
</html>



