
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
  
use presentation\system\masterData\classes\cls_sys_status;
//use presentation\system\masterData\classes\cls_sys_permission;

$modelStatus = new cls_sys_status($db);
//$model = new cls_sys_permission($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Role Permission</title>
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
    <style type="text/css">
      th.rotate {
        height: 140px;
        max-width :40px;
        padding:0;
        padding-bottom: 5px;
      }

      th.rotate > div {
        transform: 
          /* Magic Numbers */
          translate(0px, 0px)
          rotate(-90deg);
        width: 38px;
      }
      th.rotate > div > span {
        /*border-bottom: 1px solid #ccc;*/
        padding: 0px 5px;
      }
      .pageName {
        font-size:0.8em;
        margin-bottom:0;
      }
    </style>
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
                  Role Permission
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
                    <label for="cboModule" class="col-sm-2 col-form-label-sm d-flex justify-content-sm-end">Module</label>
                    <div class="col-sm-4">
                      <select class="form-control form-control-sm" id="cboModule" name="cboModule" placeholder="Select module name">
                        <option value=""></option>
                        <?php 
                        $sql = "select distinct(sym_module) as 'name'
                                from sys_menus 
                                where sym_status='1' and sym_module!='common'
                                group by sym_module
                                order by sym_module asc ";
                        $result = $db->singleQuery($sql);
                        while($row = mysqli_fetch_array($result)){
                          echo '<option value="'.$row['name'].'">';
                          echo $row['name'];
                          echo '</option>';
                        }
                        ?>
                      </select>
                    </div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <table class="table table-responsive table-bordered table-striped" height="600">
                    <thead class="table-dark">
                      <tr style="height: 6rem;">
                        <th scope="col" class="" style="vertical-align: middle; min-width:200px;">Page Name</th>
                        <?php
                        $sql = "show columns from sys_menus";
                        $result = $db->singleQuery($sql);
                        $columns = [];
                        while($row = mysqli_fetch_assoc($result)){
                          $columns[] = $row;
                        }
                        $columnCount = 0;
                        $columnsName = [];
                        for ($index = 8; $index < count($columns)-4; $index++) {
                          $columnCount++;
                          $columnNames = explode('_',$columns[$index]['Field']);
                          $name = "";
                          echo '<th scope="col" class="rotate" style="white-space:nowrap;"><div><span>';
                          foreach ($columnNames as $key => $value) {
                            $name .= ($key==0)?'syn': '_'.$value;
                            echo ($key!=0)?ucwords($value).' ': '';
                          }
                          $columnsName[] = $name;
                          echo '</span></div></th>';
                        }
                        ?>
                        <th scope="col" class="" style="vertical-align: middle; min-width:200px;">Page Name</th>
                      </tr>
                    </thead>
                    <tbody class="table-hover" id="tBodyPermission">
                      <tr class="cloneRow" style="display: none;">
                        <td scope="row" class="">
                          <input type="checkbox" class="sym_name menu" value="" id=""/>
                          <input type="hidden" class="sym_id" value=""/>
                          <label class="sym_name pageName" for=""></label>
                        </td>
                        <?php foreach ($columnsName as $k=>$columnName) {?>
                        <td align="center"><input type="checkbox" class="<?php echo $columnName;?> permission" field_name="<?php echo $columnName;?>" value="1" /></td>
                        <?php }?>
                        <td><label class="sym_name pageName" for=""></label></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="button" class="btn btn-outline-secondary" id="btnClose" style="width: 100px; margin: 5px;">Close</button>
                      <button type="button" class="btn btn-outline-primary" id="btnList" style="width: 100px; margin: 5px;">List</button>
                      <button type="button" class="btn btn-outline-info" id="btnPrint" style="width: 100px; margin: 5px;">Print</button>
<!--                      <button type="button" class="btn btn-outline-primary" id="btnApprove" style="width: 100px; margin: 5px;">Approve</button>
                      <button type="button" class="btn btn-outline-warning" id="btnReject" style="width: 100px; margin: 5px;">Reject</button>-->
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
    <script src="rolePermission.js"></script>    
  </body>
</html>



