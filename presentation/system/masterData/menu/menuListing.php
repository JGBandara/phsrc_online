
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

include  "{$backwardSeparator}dataAccess/listingAccessController.php";
//ob_start();
  
//require_once '../class/cls_sys_menus.php';

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
    <?php include "{$backwardSeparator}headerListing.php";?>    <!-- Bootstrap Color Picker 3.1.2-->
    <link href="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">   
    <script type="application/javascript" >
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
            <form class="needs-validation" novalidate id="frmsys_menusListing">
              <div class="card">
                <div class="card-header">
                  Menu Listing
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <table id="gridsys_menus" class="display cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>Parent Id</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Show Menu</th>
                                <th>View</th>
                                <th>List</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Approval 1</th>
                                <th>Approval 2</th>
                                <th>Approval 3</th>
                                <th>Approval 4</th>
                                <th>Approval 5</th>
                                <th>Send To Approval</th>
                                <th>Print</th>
                                <th>Reject</th>
                                <th>Revise</th>
                                <th>Admin Right</th>
                                <th>Copy To Clipboard</th>
                                <th>Export To Excel</th>
                                <th>Export To Pdf</th>
                                <th>Without Permission</th>
                                <th>Behaviour</th>
                                <th>Awesome Icon</th>
                                <th>Module</th>                            
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Code</th>
                                <th>Parent Id</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Show Menu</th>
                                <th>View</th>
                                <th>List</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Approval 1</th>
                                <th>Approval 2</th>
                                <th>Approval 3</th>
                                <th>Approval 4</th>
                                <th>Approval 5</th>
                                <th>Send To Approval</th>
                                <th>Print</th>
                                <th>Reject</th>
                                <th>Revise</th>
                                <th>Admin Right</th>
                                <th>Copy To Clipboard</th>
                                <th>Export To Excel</th>
                                <th>Export To Pdf</th>
                                <th>Without Permission</th>
                                <th>Behaviour</th>
                                <th>Awesome Icon</th>
                                <th>Module</th>                            
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                      </table>                    
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="button" class="btn btn-outline-secondary" id="btnClose" style="width: 100px; margin: 5px;">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footerListing.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Common Script -->
    <script src="<?php echo $backwardSeparator;?>js/common.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="menuListing.js"></script>    
  </body>
</html>



