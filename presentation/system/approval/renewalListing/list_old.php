
  <meta charset="UTF-8">
  <title>Pagination table with search option</title>
  <!--<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>-->
<link rel="stylesheet" href="../../../css/grid_js/style.css">
<style>
 .avatar1-pic {
        width: 350px;
		height:20px
      }
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
      <div class="header_wrap">
        <div class="num_rows">
		
				<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 		<select class  ="form-control" name="state" id="maxRows">
						 
						 
						 <option value="10">10</option>
						 <option value="15">15</option>
						 <option value="20">20</option>
						 <option value="50">50</option>
						 <option value="70">70</option>
						 <option value="100">100</option>
            <option value="5000">Show ALL Rows</option>
						</select>
			 		
			  	</div>
        </div>
        <div class="tb_search">
<input type="text" id="search_input_all" onKeyUp="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
        </div>
      </div>
<table class="table table-striped table-class" id= "table-id">
  
	
<thead>
<tr>
		<th>Institute Name</th>
		<th>Reg Type</th>
		<th>Date</th>
		<th>Action</th>
                <th>Check List</th>
	</tr>
  </thead>

	
  
    
</table>

<!--		Start Pagination -->
			<div class='pagination-container'>
				<nav>
				  <ul class="pagination">
				   <!--	Here the JS Function Will Add the Rows -->
				  </ul>
				</nav>
			</div>
      <div class="rows_count">Showing 11 to 20 of 91 entries</div>

</div> <!-- 		End of Container -->





  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          
          <h4 class="modal-title">Institute Details</h4>
          <button type="button" class="close" id="btnClose" data-dismiss="modal">&times;</button>
        </div>
        <div class="btn-group btn-group-justified">
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butBasicInfo'>Basic Information</a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butStaffInfo'>Staff Information</a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butInstituteInfo'>Institution Information</a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butFacilityInfo'>Facilities </a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butDocInfo'>Documents </a>
    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butPaymentInfo'>Payments </a>
<!--    <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butCheckInfo'>Check List</a>-->
  </div>
        <div class="modal-body" style="margin-top:20px">
        <div id="basicInfo">
        <input type="hidden" id="txtId" name="txtId"/>
          <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-user-circle" aria-hidden="true" style="color:#F00"></i>
&nbsp;Name of the person who is operating or maintaining the institution</div><div class="form-group col-md-9">:&nbsp;<label class="textStyle" id="lblName"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-window-minimize" aria-hidden="true" style="color:#6C6"></i>
&nbsp;The relationship with the institution </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblRelationship"></label></div><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-book" aria-hidden="true" style="color:#090"></i>

&nbsp;Address</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblAddress"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-card" aria-hidden="true" style="color:#FC0"></i>&nbsp;
Name of the institution</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsName"></label></div><div class="form-group col-md-3 textMainTxtStyle">
<i class="fa fa-telegram" aria-hidden="true" style="color:#F63"></i>
&nbsp;Institute Address </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsAddress"></label></div></div>

<div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Province</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblProvince"></label></div><div class="form-group col-md-3 textMainTxtStyle">
District </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblDistrict"></label></div></div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->     
<div id="staffInfo">
          <div class="form-row"><div class="form-group col-md-12 textMainTxtStyle">The details of the medical staff including Doctors, Consultants engaged in the profession under this institution</div></div>
        
          <div class="card" >
                <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments" style="overflow:auto">
                    <thead class="">
                      <tr>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 20%;">Qualifications</th>
                        <th style="width: 12%;">Institute</th>
                        <th style="width: 12%;">Country</th>
                        <th style="width: 12%;">PostGraduate</th>
                        <th style="width: 12%;">Speciality</th>
                        <th style="width: 12%;">SLMC No</th>
                      </tr>
                    </thead>
                    
                  </table>
                </div>
              </div>      
        
        <div class="form-row"><div class="form-group col-md-12 textMainTxtStyle">Managment Information</div></div>
        
        <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 20%;">Position</th>
                        <th style="width: 25%;">Name</th>
                        <th style="width: 25%;">Contact detail</th>
                        <th style="width: 20%;">Other Information</th>
                      </tr>
                    </thead>
                    
                  </table>
                </div>
              </div>      

        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Government officer or not (If yes name of the institution and the post held by the officer currently)</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsGovOfficer"></label></div><div class="form-group col-md-3 textMainTxtStyle">
Government officer or not (If yes name of the institution and the post held by the officer currently)</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsname"></label></div></div>
        
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Hours of practice</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPracHoure"></label></div></div>
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      
        <div id="instituteInfo">
          <div class="form-row"><div class="form-group col-md-3">Date of Establishment</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtEstDate"></label></div><div class="form-group col-md-3">
 Company/ Business registration no </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtBR"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3">BOI registration</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtBOI"></label></div><div class="form-group col-md-3">
                &nbsp; </div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id="textXrayFacility"></label></div></div>



                    <div class="form-row"><div class="form-group col-md-6">
    <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                          <th style="width: 100%;" colspan="2">Type of the institution</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Private hospital</td><td class='p-1'><input type="checkbox" id="checkPvtHs" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Nursing home</td><td class='p-1'><input type="checkbox" id="checkNursingHome" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Maternity home</td><td class='p-1'><input type="checkbox" id="checkMatHome" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Other</td><td class='p-1'><input type="text" id="txtInsOther" disabled="true"/></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>  
                </div><div class="form-group col-md-6">
<div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                          <th style="width: 100%;" colspan="2">Ownership status</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Public company</td><td class='p-1'><input type="checkbox" id="checkPubCompany" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Private company</td><td class='p-1'><input type="checkbox" id="checkPvtCompany" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Proprietary private hospital</td><td class='p-1'><input type="checkbox" id="checkProHospital" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Co-operative hospital</td><td class='p-1'><input type="checkbox" id="checkCoHospital" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Estate owned hospital</td><td class='p-1'><input type="checkbox" id="checkEsHospital" disabled="true"/></td></tr>
                    <tr><td align='center' class='p-1'>Other</td><td class='p-1'><input type="text" id="txtOwnOther" disabled="true"/></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>  
                </div></div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="facilityInfo">
           <div class="form-row"><div class="form-group col-md-3">Total no: of inpatient beds</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoBed"></label></div><div class="form-group col-md-3">
 Total No. of rooms </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoRoom"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3">Total No. of Wards</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoWard"></label></div><div class="form-group col-md-3">
                &nbsp; </div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id="cboAtomicEnergy"></label></div></div>



                    <div class="form-row"><div class="form-group col-md-12">
    <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblinsFacility">
                    <thead class="">
                      <tr>
                          <th style="width: 30%;">Facility</th>
                          <th style="width: 30%;">Value</th>
                          <th style="width: 40%;">Description</th>
                       
                      </tr>
                    </thead>
                    
                  </table>
                </div>
              </div>  
                </div></div>
    
    <div class="form-row"><div class="form-group col-md-3">License obtained from the Atomic Energy Authority for Radiology Service</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboAtomicEnergy"></label></div><div class="form-group col-md-3">
 The number of such license </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoLicense"></label></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Method of clinical waste disposal</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtclinicalDis"></label></div><div class="form-group col-md-3">
 Method of sterilization of instruments and dressings</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtInsDress"></label></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Emergency kit</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboEmgKit"></label></div><div class="form-group col-md-3">
         &nbsp; </div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id=""></label></div></div>
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="documentList">
           <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments">
                    <thead class="">
                      <tr>
                        <th>Action</th>
                        <th style="width: 20%;">Category</th>
                        <th style="width: 25%;">Name</th>
                        <th style="width: 25%;">Reference No</th>
                        <th style="width: 20%;">version</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cloneRow" style="display: none;">
                        <td align='center' class="p-1">
                          <a href="#" class="action" target="_blank"><span class="fas fa-download actionView"></span></a>
                        </td>
                        <td class="category p-1"></td>
                        <td class="name p-1"></td>
                        <td class="reference p-1"></td>
                        <td class="version p-1"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>              
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="paymentInfo">
          <div class="form-row"><div class="form-group col-md-3">Payment Type</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboPayType"></label></div><div class="form-group col-md-3">
 Registration Year </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtYear"></label></div></div>
        
         <div class="form-row"><div class="form-group col-md-3">Registration Fee</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtAmount"></label></div><div class="form-group col-md-3">
 Stamp Fee</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtAmount"></label></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Payment Amount</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtAmount"></label></div><div class="form-group col-md-3">
Payment Date</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentDate"></label></div></div>

 <div class="form-row"><div class="form-group col-md-3">Paying Branch</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentBranch"></label></div><div class="form-group col-md-3">
&nbsp;</div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id="textPayType"></label></div></div>
 
<!-- <div class="form-row"><div class="form-group col-md-4">&nbsp;</div><div class="form-group col-md-4"><img src="" class="avatar1-pic" alt="Bank Slip" height="20px"></div><div class="form-group col-md-4">&nbsp;</div></div>-->
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
       <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="checkList">
           
           <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-user-circle" aria-hidden="true" style="color:#F00"></i>
&nbsp;Number of Doctors available </div><div class="form-group col-md-9">:&nbsp;<label class="textStyle" id="lblName"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-window-minimize" aria-hidden="true" style="color:#6C6"></i>
&nbsp;Number of Nurses available</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblRelationship"></label></div><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-book" aria-hidden="true" style="color:#090"></i>

&nbsp;Number of Ambulances </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblAddress"></label></div></div>
        
        <div class="form-row"><div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-card" aria-hidden="true" style="color:#FC0"></i>&nbsp;
Model </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsName"></label></div><div class="form-group col-md-3 textMainTxtStyle">
<i class="fa fa-telegram" aria-hidden="true" style="color:#F63"></i>
&nbsp;Facilities available  </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsAddress"></label></div></div>

<div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Equipment available </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblProvince"></label></div><div class="form-group col-md-3 textMainTxtStyle">
Number of Drivers available </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblDistrict"></label></div></div>
           <div class="form-row"><div class="form-group col-md-3">Upload Check List</div><div class="form-group col-md-3">&nbsp;<input type="file"/></div><div class="form-group col-md-3">
                   &nbsp;</div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id="txtYear1"></label></div></div>
        
           <div class="form-row"><div class="form-group col-md-3">Comments</div><div class="form-group col-md-9">&nbsp;<textarea class="form-group col-md-9"></textarea></div></div>
 
 

 
 
<!-- <div class="form-row"><div class="form-group col-md-4">&nbsp;</div><div class="form-group col-md-4"><img src="" class="avatar1-pic" alt="Bank Slip" height="20px"></div><div class="form-group col-md-4">&nbsp;</div></div>-->
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->

        
        </div>
       
        <div class="modal-footer">
         <div style=""><b><label id="lblAcction" style="font-size:36px;"></label></b></div><div class="col-md-5">&nbsp;</div> <center><button type="button" class="btn btn-success" id="btnApprove">Approve</button>&nbsp;<button type="button" class="btn btn-danger" id="btnReject">Reject</button>&nbsp;<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnClose">Close</button></center>
        </div>
      </div>
      
    </div>
  </div>
<!--  Developed By Yasser Mas -->
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script  src="../../../js/grid_js/script.js"></script>
<script  src="list.js"></script>

