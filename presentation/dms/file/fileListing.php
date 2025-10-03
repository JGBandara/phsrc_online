
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

$fileRefernceId = (isset($_REQUEST['ref_id']))?$_REQUEST['ref_id']:'';
$fileRefernceNo = (isset($_REQUEST['ref_no']))?$_REQUEST['ref_no']:'';
$fileCategory = (isset($_REQUEST['cat_name']))?$_REQUEST['cat_name']:'';

require "{$backwardSeparator}autoLoad.php";

include "{$backwardSeparator}dataAccess/listingAccessController.php";
  
use presentation\dms\classes\cls_dms_trn_file;
$model = new cls_dms_trn_file($db);
  
?><!DOCTYPE html>
<html>
  <head>
    <title>File</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}headerListing.php";?>    <!-- Bootstrap Color Picker 3.1.2-->
    <link href="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">   
    <script type="application/javascript" >
      var backwardSeparator = '<?php echo $backwardSeparator ?>';
      var filter_ref_id = '<?php echo $fileRefernceId ?>';
      var filter_ref_no = '<?php echo $fileRefernceNo ?>';
      var filter_cat_name = '<?php echo $fileCategory ?>';
    </script>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
        <!-- Message Modal -->
    <?php include "./fileListingToggle.php";?>
        <!-- Partial View Modal -->
    <?php include "{$backwardSeparator}partialViewModal.php";?>
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
            <form class="needs-validation" novalidate id="frmdms_trn_fileListing">
              <div class="card">
                <div class="card-header">
                  File Listing
                </div>
                <div class="card-body">
                  <a style="display: none;" id="selectedFileUrl"></a>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <table id="griddms_trn_file" class="display cell-border customGrid" style="width:100%">
                        <thead>
                            <tr>
                              <th style="max-width: 20px;">Action</th>
                                <th><?php echo $model->attributeLabels()['dfi_file_name'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_file_extension'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_store_location'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_url'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_reference_no'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_reference_id'];?></th>
                                <th>File Group</th>
                                <th><?php echo $model->attributeLabels()['dfi_file_category_id'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_file_version'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_meta_data'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_remarks'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_status'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_is_deleted'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_company_id'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_created_by'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_created_on'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_last_modified_by'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_last_modified_on'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_deleted_by'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_deleted_on'];?></th>
                              </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Action</th>
                                <th><?php echo $model->attributeLabels()['dfi_file_name'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_file_extension'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_store_location'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_url'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_reference_no'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_reference_id'];?></th>
                                <th>File Group</th>
                                <th><?php echo $model->attributeLabels()['dfi_file_category_id'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_file_version'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_meta_data'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_remarks'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_status'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_is_deleted'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_company_id'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_created_by'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_created_on'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_last_modified_by'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_last_modified_on'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_deleted_by'];?></th>
                                <th><?php echo $model->attributeLabels()['dfi_deleted_on'];?></th>
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
    <script src="<?php echo $backwardSeparator;?>js/dms.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="fileListing.js"></script>    
  </body>
</html>



