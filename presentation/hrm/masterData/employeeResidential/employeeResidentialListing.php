
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
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
  
//use presentation\hrm\masterData\classes\cls_hrm_employee_residential;

//$model = new cls_hrm_employee_residential($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Residential</title>
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
    <?php include "./employeeResidentialListingToggle.php";?>
        <!-- Partial View Modal -->
    <?php include "{$backwardSeparator}partialViewModal.php";?>
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
            <form class="needs-validation" novalidate id="frmhrm_employee_residentialListing">
              <div class="card">
                <div class="card-header">
                  Employee Residential Information Listing
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <table id="gridhrm_employee_residential" class="display cell-border customGrid" style="width:100%">
                        <thead>
                            <tr>
                              <th style="max-width: 20px;">Action</th>
                                <th>Employee No</th>
                                <th>Calling Name</th>
                                <th>Permanent Address</th>
                                <th>Permanent Street</th>
                                <th>Permanent City</th>
                                <th>Permanent Postal Code</th>
                                <th>Permanent Telephone</th>
                                <th>Permanent Mobile No</th>
                                <th>Permanent Email</th>
                                <th>Permanent Country</th>
                                <th>Permanent Province</th>
                                <th>Permanent District</th>
                                <th>Permanent DS Division</th>
                                <th>Permanent Electorate</th>
                                <th>Current Address</th>
                                <th>Current Street</th>
                                <th>Current City</th>
                                <th>Current Postal Code</th>
                                <th>Current Telephone General Line</th>
                                <th>Current Telephone Direct Line</th>
                                <th>Current Mobile No</th>
                                <th>Current Fax</th>
                                <th>Current Email</th>
                                <th>Current Country</th>
                                <th>Current Province</th>
                                <th>Current District</th>
                                <th>Current DS Division</th>
                                <th>Current Electorate</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Is Deleted</th>
                                <th>Company</th>
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
                                <th>Employee No</th>
                                <th>Calling Name</th>
                                <th>Permanent Address</th>
                                <th>Permanent Street</th>
                                <th>Permanent City</th>
                                <th>Permanent Postal Code</th>
                                <th>Permanent Telephone</th>
                                <th>Permanent Mobile No</th>
                                <th>Permanent Email</th>
                                <th>Permanent Country</th>
                                <th>Permanent Province</th>
                                <th>Permanent District</th>
                                <th>Permanent DS Division</th>
                                <th>Permanent Electorate</th>
                                <th>Current Address</th>
                                <th>Current Street</th>
                                <th>Current City</th>
                                <th>Current Postal Code</th>
                                <th>Current Telephone General Line</th>
                                <th>Current Telephone Direct Line</th>
                                <th>Current Mobile No</th>
                                <th>Current Fax</th>
                                <th>Current Email</th>
                                <th>Current Country</th>
                                <th>Current Province</th>
                                <th>Current District</th>
                                <th>Current DS Division</th>
                                <th>Current Electorate</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Is Deleted</th>
                                <th>Company</th>
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
    <script src="employeeResidentialListing.js"></script>    
  </body>
</html>



