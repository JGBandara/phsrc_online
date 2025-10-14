<?php
session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
$sql = "select ins_application_id from institute_registration where institute_reg_id='$searchId' ";
    $result = $db->singleQuery($sql);
    while($row=  mysqli_fetch_array($result)){
        $insId=$row['ins_application_id'];
    }
$_SESSION['institute_id']=$insId;

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Payments</title>
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
      .avatar1-pic {
        width: 350px;
		height:200px
      }
      .Profile-input-file{
          height:180px;width:580px;
          position: absolute;
          top: 0px;
          z-index: 999;
          opacity: 0 !important;
      }
	  .image-upload>input {
  display: none;
}
    </style>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/phnh/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>  <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frm_payment_information"  action="" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  Payments
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select class="form-control form-control-sm" id="cboSearch" name="cboSearch" placeholder="">
                      </select>
                    </div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <?php include '../instituteTabs.php';?>
                 <div id="personal">
                    <div class="form-row" >
                      <div class="col-sm-12">
                    
						<div class="bankPayment">
                        <div class="form-row form-group col-sm-12">
                        <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments">
                    <thead class="">
                      <tr>
                        <th style="background-color:#FFF;color:#006400"><label id="msgPayment"></label></th>
                      
                    </thead>
                   
                  </table>
                        </div>
                        
                         <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtPayAmount" class="col-form-label-sm required">Payment Type</label>
                            <select class="form-control form-control-sm" id="cboPayType" name="cboPayType">
                            <option>&nbsp;</option>
                            <option value="Card Payment">Online</option>
                            <option value="Bank_Through">Bank Through</option>
                            <option value="Bank_Transfer">Bank Transfer</option>
                            </select>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtPayAmount" class="col-form-label-sm required">Registration Year</label>
                            <input type="text" class="form-control form-control-sm" id="txtYear" name="txtYear" placeholder="" value="2025" readonly>
                          </div>
                          
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtPayAmount" class="col-form-label-sm">Annual Registration Fee(LKR)</label>
                            <input type="text" class="form-control form-control-sm" id="txtRegFee" name="txtRegFee" placeholder="" style="text-align:right;color:green" readonly >
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtAddress" class=" col-form-label-sm">Stamp Fee (LKR)</label>
                            <input type="text" class="form-control form-control-sm" id="txtStampFee" name="txtStampFee" placeholder="" value="0" style="text-align:right;color:green" readonly>
                          </div>
                        </div>
                                                    
                         <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtArrears" class="col-form-label-sm">Board Price (LKR)</label>
                            <input type="number" class="form-control form-control-sm" id="txtArrears" name="txtArrears" placeholder="" style="text-align:right;color:red" value="0" readonly>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtPayAmount" class="col-form-label-sm">Payment Amount (LKR)</label>
                            <input type="text" class="form-control form-control-sm" id="txtAmount" name="txtAmount" placeholder="" style="text-align:right;color:green" value="0"  readonly>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          
                            <div class="form-group col-sm-6">
                            <label for="txtRelIns" class="col-form-label-sm">Paying Branch</label>
                            <input type="text" class="form-control form-control-sm" id="txtPaymentBranch" name="txtPaymentBranch" placeholder="" list="branchList">
                            <datalist id="branchList" >
                    <?php $sql="SELECT
branch_Name
from tbl_boc_branch";
$result = $db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
	
	echo '<option  value='.$row['branch_Name'].'>';

	}

?>
  
</datalist>
                          </div>
                            
                          <div class="form-group col-sm-6">
                            <label for="txtAddress" class=" col-form-label-sm required">Payment Date</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--> <!--<input type="text" class="form-control form-control-sm" id="txtPaymentDate" name="txtPaymentDate" placeholder="">-->
                            <input type="text" class="form-control form-control-sm datepicker_past" id="txtPaymentDate" name="txtPaymentDate" placeholder="">
                          </div>
                        </div>
                        <div class="form-row hideOnline">
                          
                          <div class="form-group col-sm-6">
                           <!-- <label for="txtRelIns" class="col-form-label-sm">Upload Bank Slip</label>-->
                           
     <img src="../../../../../img/bankSlip.jpg" >

                           
                            <!--<input type="file" class="form-control form-control-sm" id="imgBankSlip" name="imgBankSlip" placeholder="">--><input type="file" onchange="readURL(this);" accept="image/*" class="form-control form-input col-sm-6 Profile-input-file" id="fileProfileImage" name="fileProfileImage">
                          </div>
                          
                        </div>
                        
                        <div class="form-row hideOnlineSlip">
                          <div class="form-group col-sm-12">
                            <img src="" class="avatar1-pic" alt="Bank Slip">
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <p><input type="checkbox" id="confirm" name="confirm" class=" col-form-label-sm required" value="confirm"><b>I further declare that the information furnished by me found to be incorrect or false at any stage my application or certificate of registration can be cancelled or suspend by the authority.</b></p>
                          </div>
                        </div>
                        
                            </div>
                        
                        </div>
                        
                        
                        
                        

                        
                      </div>
                    
                    </div>

                    
                    </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                       <button type="button" class="btn btn-warning" id="btnNew" style="width: 100px; margin: 5px;"><i class="fas fa-align-justify"></i>&nbsp;New</button>
              		   <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                   	   <button type="button" class="btn btn-danger" id="btnDelete" style="width: 100px; margin: 5px;"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
                      <button type="button" class="btn btn-info" id="btnClose" style="width: 100px; margin: 5px;"><i class="fas fa-times-circle"></i>&nbsp;Close</button>
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
    <script src="payments.js"></script>    
    <script>

//    ===================== snippet for profile picture change ============================ //

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar1-pic')
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



