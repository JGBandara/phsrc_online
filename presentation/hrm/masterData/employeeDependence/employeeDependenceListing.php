
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
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
  
use presentation\hrm\masterData\classes\cls_hrm_employee_dependence;
$model = new cls_hrm_employee_dependence($db);
  
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Dependence</title>
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
    <?php include "./employeeDependenceListingToggle.php";?>
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
            <form class="needs-validation" novalidate id="frmhrm_employee_dependenceListing">
              <div class="card">
                <div class="card-header">
                  Employee Dependence Listing
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <table id="gridhrm_employee_dependence" class="display cell-border customGrid" style="width:100%">
                        <thead>
                            <tr>
                              <th style="max-width: 20px;">Action</th>
                                <th>Employee No</th>
                                <th>Calling Name</th>
                                <th><?php echo $model->attributeLabels()['emd_full_name'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_date_of_birth'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_nic_no'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_telephone'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_entitled_death_donation'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_entitled_medical_benifits'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_provident_fund_nominee'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_living'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_work_type'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_working_address'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_working_telephone'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_permanent_address'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_mobile'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_same_office'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_marital_status_id'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_remarks'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_status'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_is_deleted'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_company_id'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_created_by'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_created_on'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_last_modified_by'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_last_modified_on'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_deleted_by'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_deleted_on'];?></th>
                              </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Action</th>
                                <th>Employee No</th>
                                <th>Calling Name</th>
                                <th><?php echo $model->attributeLabels()['emd_full_name'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_date_of_birth'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_nic_no'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_telephone'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_entitled_death_donation'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_entitled_medical_benifits'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_provident_fund_nominee'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_living'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_work_type'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_working_address'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_working_telephone'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_permanent_address'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_mobile'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_same_office'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_marital_status_id'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_remarks'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_status'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_is_deleted'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_company_id'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_created_by'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_created_on'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_last_modified_by'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_last_modified_on'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_deleted_by'];?></th>
                                <th><?php echo $model->attributeLabels()['emd_deleted_on'];?></th>
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
    <script src="employeeDependenceListing.js"></script>    
  </body>
</html>



