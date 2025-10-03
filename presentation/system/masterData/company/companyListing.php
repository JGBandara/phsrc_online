
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include "{$backwardSeparator}dataAccess/listingAccessController.php";
  
//use presentation\system\masterData\classes\cls_sys_companies;

//$model = new cls_sys_companies($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Company</title>
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
        <!-- Message Modal -->
    <?php include "./companyListingToggle.php";?>
        <!-- Partial View Modal -->
    <?php include "{$backwardSeparator}partialViewModal.php";?>
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
            <form class="needs-validation" novalidate id="frmsys_companiesListing">
              <div class="card">
                <div class="card-header">
                  Company Listing
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <table id="gridsys_companies" class="display cell-border customGrid" style="width:100%">
                        <thead>
                            <tr>
                              <th style="max-width: 20px;">Action</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Web Site</th>
                                <th>Remarks</th>
                                <th>Account No</th>
                                <th>Registration No</th>
                                <th>Vat No</th>
                                <th>Svat No</th>
                                <th>Working Day Type</th>
                                <th>Base Currency</th>
                                <th>Tax Applicable</th>
                                <th>Nopay Consider</th>
                                <th>Menu Order</th>
                                <th>Status</th>
                                <th>Is Deleted</th>
                                <th>Created By</th>
                                <th>Created On</th>
                                <th>Last Modified By</th>
                                <th>Last Modified On</th>
                                <th>Deleted By</th>
                                <th>Deleted On</th>
                              </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Action</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Web Site</th>
                                <th>Remarks</th>
                                <th>Account No</th>
                                <th>Registration No</th>
                                <th>Vat No</th>
                                <th>Svat No</th>
                                <th>Working Day Type</th>
                                <th>Base Currency</th>
                                <th>Tax Applicable</th>
                                <th>Nopay Consider</th>
                                <th>Menu Order</th>
                                <th>Status</th>
                                <th>Is Deleted</th>
                                <th>Created By</th>
                                <th>Created On</th>
                                <th>Last Modified By</th>
                                <th>Last Modified On</th>
                                <th>Deleted By</th>
                                <th>Deleted On</th>
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
    <script src="companyListing.js"></script>    
  </body>
</html>



