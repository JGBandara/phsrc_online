<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';

?><!DOCTYPE html>
<html>
  <head>
    <title>Basic Information</title>
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
      .avatar-pic {
        width: 150px;
      }
      .Profile-input-file{
          height:180px;width:180px;
          position: absolute;
          top: 0px;
          z-index: 999;
          opacity: 0 !important;
      }
    </style>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/fpds/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frm_basic_information" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  Institute Basic Information
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" name="txtSearch" id="txtSearch">
                    </div><div class="col-sm-2"><button type="button" class="btn btn-warning" id="btnSearch" style="width: 100px;height:30px ">Search</button></div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <!--<?php include '../instituteTabs.php';?>-->
                 <div id="personal">
                    <div class="form-row">
                      <div class="col-sm-8">
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <label for="txtName" class="col-form-label-sm">Name of Institute</label>
                            <input type="text" class="form-control form-control-sm" id="txtInsName" name="txtInsName" placeholder="" readonly>
                      
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtRelIns" class="col-form-label-sm">Registration Number </label>
                            <input type="text" class="form-control form-control-sm" id="txtRegNo" name="txtRegNo" placeholder="" readonly>
                            <input type="hidden" name="txtInsId" id="txtInsId" />
                          </div>
                          <div class="form-group col-sm-6">
                           &nbsp;
                          </div>
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtInsName" class="col-form-label-sm">Address</label>
                            <input type="text" class="form-control form-control-sm" id="txtAddress" name="txtAddress" placeholder="" readonly>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtInsAddress" class=" col-form-label-sm">Telephone </label>
                            <input type="text" class="form-control form-control-sm" id="txtTelephone" name="txtTelephone" placeholder="" readonly>
                          </div>
                        </div>
                        
                        

                        
                      </div>
                      <div class="col-sm-4">
                        <div class="form-row">
                          <div class="file-field w-100">
                            <div class="mb-4 text-center">
                              <!--<img src="<?php echo $backwardSeparator."img/core/dental_su.jpg";?>"
                                class="rounded-circle z-depth-1-half avatar-pic1" alt="example placeholder avatar">-->
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-row" id="location">
                    
                      <div class="form-group col-sm-6">
                        <label for="cboProvince" class="col-form-label-sm">Fax</label>
                        <input type="text" class="form-control form-control-sm" id="txtFax" name="txtFax" placeholder="" readonly>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="cboDistrict" class="col-form-label-sm">Email Address</label>
                        <input type="text" class="form-control form-control-sm" id="txtEmail" name="txtEmail" placeholder="" readonly>
                      </div>
                      
                    </div>
                    
                     <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtInsName" class="col-form-label-sm">Web</label>
                            <input type="text" class="form-control form-control-sm" id="txtWeb" name="txtWeb" placeholder="" readonly>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtInsAddress" class=" col-form-label-sm">Date Started </label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><input type="text" class="form-control form-control-sm" id="txtDate" name="txtDate" placeholder="" readonly>
                          </div>
                        </div>
                        
                        
                        
                        
                         <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtInsName" class="col-form-label-sm">Other info</label>
                            <input type="text" class="form-control form-control-sm" id="txtOtherInfo" name="txtOtherInfo" placeholder="" readonly>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtInsAddress" class=" col-form-label-sm">SLMC</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><input type="text" class="form-control form-control-sm" id="txtSLMC" name="txtSLMC" placeholder="" readonly>
                          </div>
                        </div>
                        
                        
                        
                         <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtInsName" class="col-form-label-sm">Province</label>
                            <input type="text" class="form-control form-control-sm" id="txtProvince" name="txtProvince" placeholder="" readonly>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtInsAddress" class=" col-form-label-sm">District</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><input type="text" class="form-control form-control-sm" id="txtDistrict" name="txtDistrict" placeholder="" readonly>
                          </div>
                        </div>
                        
                        
                        
                         <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtInsName" class="col-form-label-sm">Type of Ownership</label>
                            <input type="text" class="form-control form-control-sm" id="txtOwnership" name="txtOwnership" placeholder="" readonly>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtInsAddress" class=" col-form-label-sm">Record Keeping</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><input type="text" class="form-control form-control-sm" id="txtRecordKeeping" name="txtRecordKeeping" placeholder="" readonly>
                          </div>
                        </div>
                        
                         <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtInsName" class="col-form-label-sm">Business Registration</label>
                            <input type="text" class="form-control form-control-sm" id="txtBussReg" name="txtBussReg" placeholder="" readonly>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtInsAddress" class=" col-form-label-sm">Hours Of Practise</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><input type="text" class="form-control form-control-sm" id="txtHrPractice" name="txtHrPractice" placeholder="" readonly>
                          </div>
                        </div>
                    </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      
              		   <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                      <button type="button" class="btn btn-info" id="btnClose" style="width: 100px; margin: 5px;"><i class="fas fa-times-circle"></i>&nbsp;Close</button>
                      <button type="button" class="btn btn-info" id="btnDocument" style="width: 100px; margin: 5px;"><i class="fa fa-angle-double-right"></i>&nbsp;Next</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="basicInformation.js"></script>    
    <script>

//    ===================== snippet for profile picture change ============================ //

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar-pic')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

//    =================================== ends here ============================================ //
    </script>
  </body>
</html>



