
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

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";
//ob_start();
$searchId = (isset($_REQUEST['id']))?isset($_REQUEST['id']):'';
  
//require_once "{$backwardSeparator}presentation/system/masterData/class/cls_sys_status.php";
//require_once '../class/cls_sys_permission.php';
//use presentation\system\masterData\classes\cls_sys_permission;

//$modelStatus = new cls_sys_status($db);
//$model = new cls_sys_permission($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Apply Role Permission</title>
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
            <form class="needs-validation" novalidate id="frmsys_permission">
              <div class="card">
                <div class="card-header">
                  Apply Role Permission
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="cboRole" class="col-sm-2 col-form-label-sm d-flex justify-content-sm-end">Role</label>
                    <div class="col-sm-4">
                      <select class="form-control form-control-sm" id="cboRole" name="cboRole" placeholder="Select user">
                        <option value=""></option>
                        <?php 
                        $sql = "select syr_id as 'id', concat(syr_name) as 'name'
                                from sys_roles
                                where syr_status='1' and syr_company_id='$userCompanyId'
                                order by syr_name asc 
                                ";
                        $result = $db->singleQuery($sql);
                        while($row = mysqli_fetch_array($result)){
                          echo '<option value="'.$row['id'].'">';
                          echo $row['name'];
                          echo '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <label for="cboUser" class="col-sm-2 col-form-label-sm d-flex justify-content-sm-end">User</label>
                    <div class="col-sm-4">
                      <select class="form-control form-control-sm" id="cboUser" name="cboUser" placeholder="Select user">
                        <option value=""></option>
                        <?php 
                        $sql = "select syu_id as 'id', concat(syu_user_name,' (',syu_full_name,')') as 'name'
                                from sys_users
                                where syu_status='1' and syu_company_id='$userCompanyId'
                                order by syu_user_name asc 
                                ";
                        $result = $db->singleQuery($sql);
                        while($row = mysqli_fetch_array($result)){
                          echo '<option value="'.$row['id'].'">';
                          echo $row['name'];
                          echo '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12" id="divRoleDescription">
                      
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
    <script src="applyRole.js"></script>    
  </body>
</html>



