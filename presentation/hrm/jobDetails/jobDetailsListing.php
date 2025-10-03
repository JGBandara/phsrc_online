
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

require "{$backwardSeparator}autoLoad.php";

include "{$backwardSeparator}dataAccess/listingAccessController.php";
  
use presentation\hrm\classes\cls_hrm_trn_job_details;
$model = new cls_hrm_trn_job_details($db);
  
?><!DOCTYPE html>
<html>
  <head>
    <title> Job Details</title>
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
    <?php include "./jobDetailsListingToggle.php";?>
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
            <form class="needs-validation" novalidate id="frmhrm_trn_job_detailsListing">
              <div class="card">
                <div class="card-header">
                   Job Details Listing
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <table id="gridhrm_trn_job_details" class="display cell-border customGrid" style="width:100%">
                        <thead>
                            <tr>
                              <th style="max-width: 20px;">Action</th>
                                <th>Employee No</th>
                                <th>Calling Name</th>
                                <th><?php echo $model->attributeLabels()['ejd_designation_id'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_job_description'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_working_hours'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_remarks'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_status'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_is_deleted'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_location_id'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_company_id'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_created_by'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_created_on'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_last_modified_by'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_last_modified_on'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_deleted_by'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_deleted_on'];?></th>
                              </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Action</th>
                                <th>Employee No</th>
                                <th>Calling Name</th>
                                <th><?php echo $model->attributeLabels()['ejd_designation_id'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_job_description'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_working_hours'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_remarks'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_status'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_is_deleted'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_location_id'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_company_id'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_created_by'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_created_on'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_last_modified_by'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_last_modified_on'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_deleted_by'];?></th>
                                <th><?php echo $model->attributeLabels()['ejd_deleted_on'];?></th>
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
    <script src="jobDetailsListing.js"></script>    
  </body>
</html>



