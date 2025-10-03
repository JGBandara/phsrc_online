
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
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

include  "{$backwardSeparator}dataAccess/accessController.php";
//ob_start();
$searchId = (isset($_REQUEST['id']))?isset($_REQUEST['id']):'';
  
require_once "{$backwardSeparator}presentation/system/masterData/class/cls_sys_status.php";
//require_once '../class/cls_sys_menus.php';

$modelStatus = new cls_sys_status($db);
//$model = new cls_sys_menus($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Menu</title>
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
            <form class="needs-validation" novalidate id="frmsys_menus">
              <div class="card">
                <div class="card-header">
                  Menu
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
                      <label for="cboParentId" class="col-sm-2 col-form-label-sm">Parent Id</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboParentId" name="cboParentId" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtName" class="col-sm-2 col-form-label-sm">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtName" name="txtName" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtUrl" class="col-sm-2 col-form-label-sm">Url</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtUrl" name="txtUrl" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm">Status</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboStatus" name="cboStatus" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboOrderBy" class="col-sm-2 col-form-label-sm">Order By</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboOrderBy" name="cboOrderBy" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <fieldset class="form-group">
                      <div class="row">
                        <legend class="col-form-label-sm col-sm-2 pt-0">Show Menu</legend>
                        <div class="col-sm-10">
                          <div class="form-check form-control-sm form-check-inline">
                            <input class="form-check-input" type="radio" name="optShowMenu" id="optShowMenu_1" value="option1" checked>
                            <label class="form-check-label" for="optShowMenu_1">
                              First radio
                            </label>
                          </div>
                          <div class="form-check form-control-sm form-check-inline">
                            <input class="form-check-input" type="radio" name="optShowMenu" id="optShowMenu_2" value="option2">
                            <label class="form-check-label" for="optShowMenu_2">
                              Second radio
                            </label>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                    <div class="form-group row">
                      <div class="col-sm-2 col-form-label-sm">Show Menu</div>
                      <div class="col-sm-10">
                        <div class="form-check form-control-sm">
                          <input class="form-check-input" type="checkbox" id="optShowMenu" name="optShowMenu" value="1">
                          <!-- <label class="form-check-label" for="optShowMenu">Show Menu</label>-->
                        </div>
                      </div>
                    </div>
        
                    <div class="form-group row">
                      <label for="cboView" class="col-sm-2 col-form-label-sm">View</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboView" name="cboView" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboList" class="col-sm-2 col-form-label-sm">List</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboList" name="cboList" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboAdd" class="col-sm-2 col-form-label-sm">Add</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboAdd" name="cboAdd" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboEdit" class="col-sm-2 col-form-label-sm">Edit</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboEdit" name="cboEdit" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboDelete" class="col-sm-2 col-form-label-sm">Delete</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboDelete" name="cboDelete" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboApproval1" class="col-sm-2 col-form-label-sm">Approval 1</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboApproval1" name="cboApproval1" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboApproval2" class="col-sm-2 col-form-label-sm">Approval 2</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboApproval2" name="cboApproval2" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboApproval3" class="col-sm-2 col-form-label-sm">Approval 3</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboApproval3" name="cboApproval3" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboApproval4" class="col-sm-2 col-form-label-sm">Approval 4</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboApproval4" name="cboApproval4" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboApproval5" class="col-sm-2 col-form-label-sm">Approval 5</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboApproval5" name="cboApproval5" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboSendToApproval" class="col-sm-2 col-form-label-sm">Send To Approval</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboSendToApproval" name="cboSendToApproval" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboPrint" class="col-sm-2 col-form-label-sm">Print</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboPrint" name="cboPrint" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboReject" class="col-sm-2 col-form-label-sm">Reject</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboReject" name="cboReject" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboRevise" class="col-sm-2 col-form-label-sm">Revise</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboRevise" name="cboRevise" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboAdminRight" class="col-sm-2 col-form-label-sm">Admin Right</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboAdminRight" name="cboAdminRight" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboCopyToClipboard" class="col-sm-2 col-form-label-sm">Copy To Clipboard</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboCopyToClipboard" name="cboCopyToClipboard" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboExportToExcel" class="col-sm-2 col-form-label-sm">Export To Excel</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboExportToExcel" name="cboExportToExcel" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboExportToPdf" class="col-sm-2 col-form-label-sm">Export To Pdf</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboExportToPdf" name="cboExportToPdf" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboWithoutPermission" class="col-sm-2 col-form-label-sm">Without Permission</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboWithoutPermission" name="cboWithoutPermission" placeholder="">
                          <?php 
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtBehaviour" class="col-sm-2 col-form-label-sm">Behaviour</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtBehaviour" name="txtBehaviour" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtAwesomeIcon" class="col-sm-2 col-form-label-sm">Awesome Icon</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtAwesomeIcon" name="txtAwesomeIcon" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="txtModule" class="col-sm-2 col-form-label-sm">Module</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtModule" name="txtModule" placeholder="">
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
    <script src="menu.js"></script>    
  </body>
</html>



