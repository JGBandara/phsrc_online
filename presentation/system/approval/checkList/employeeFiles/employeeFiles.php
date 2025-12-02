<?php
session_start();
$backwardSeparator = "../../../../../";
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
use presentation\dms\masterData\classes\cls_dms_file_category;

$modelStatus = new cls_sys_status($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Document</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>        
    <link href="<?php echo $backwardSeparator;?>vendor/dropZone/component-dropzone.css" rel="stylesheet">   
    <link href="<?php echo $backwardSeparator;?>vendor/dropZone/dropzone.css" rel="stylesheet">   

    <script type="application/javascript" >
      var searchId = '<?php echo $searchId ?>';
      var employeeId = '<?php echo $employeeId ?>';
      var backwardSeparator = '<?php echo $backwardSeparator ?>';
    </script>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- File Remarks Modal -->
    <?php include "{$backwardSeparator}fileRemarksModal.php";?>
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
            <form class="needs-validation" novalidate id="frmhrm_employee_files">
              <div class="card">
                <div class="card-header">
                  Check List
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select class="form-control form-control-sm" onkeyup="filterSelect()" id="cboSearch" name="cboSearch" placeholder="Search..">
                      </select>
                    </div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <?php include '../instituteTabs.php';?>                  
      
                    <div class="form-row">
                      <div class="form-group col-sm-12">
                        <label for="cboCategoryId" class="col-form-label-sm">Document Category</label>
                        <select class="form-control form-control-sm" onkeyup="filterSelect()" id="cboCategoryId" name="cboCategoryId" placeholder="">
                          <?php 
                          $modelCategory = new cls_dms_file_category($db);
                          $modelCategory->dfc_file_group_id =13;
                          $modelCategory->dfc_status = 1;
                          $modelCategory->dfc_is_deleted = 0;
                          $modelCategory->dfc_company_id = $userCompanyId;
                          echo $modelCategory->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="dropzone" id="abc-efg"><div id="dropzone-previews"></div></div>
                      </div>
                    </div>
                </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="button" class="btn btn-info" id="btnClose" style="width: 100px; margin: 5px;"><i class="fas fa-times-circle"></i>&nbsp;Close</button>
                      <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                    </div>
                  </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments">
                    <thead class="">
                      <tr>
                        <th>Action</th>
                        <th style="width: 20%;">Category</th>
                        <th style="width: 25%;">Name</th>
                        <th style="width: 25%;">Reference No</th>
                        <th style="width: 20%;">version</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cloneRow" style="display: none;">
                        <td align='center' class="p-1">
                          <a href="#" class="action" target="_blank"><span class="fas fa-download actionView"></span></a>
                        </td>
                        <td class="category p-1"></td>
                        <td class="name p-1"></td>
                        <td class="reference p-1"></td>
                        <td class="version p-1"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>              
            </div>
          </form>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Dropzone -->
    <script src="<?php echo $backwardSeparator;?>vendor/dropZone/dropzone.js"></script>
    <script src="<?php echo $backwardSeparator;?>js/dms.js"></script>
    
    <script type="text/javascript">
      Dropzone.autoDiscover = false;
    </script>    
 
    <!-- Custom scripts for This page-->
    <script src="employeeFiles.js"></script>
        <script>
   var originalOptions = [];

window.onload = function () {
  var select = document.getElementById("cboSearch");
  originalOptions = Array.from(select.options).map(opt => opt.text);
};

function filterSelect() {
  var text = document.getElementById("txtSearch").value.toLowerCase();
  var select = document.getElementById("cboSearch");

  select.innerHTML = "";

  originalOptions.forEach(function(item) {
    if (item.toLowerCase().startsWith(text)) {
      var option = document.createElement("option");
      option.text = item;
      select.add(option);
    }
  });
}


        </script>  </body>
</html>



