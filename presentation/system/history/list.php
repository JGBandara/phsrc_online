
  <meta charset="UTF-8">
  <title>Pagination table with search option</title>
  <!--<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>-->
<link rel="stylesheet" href="../../../css/grid_js/style.css">
<style>
 .avatar1-pic {
        width: 350px;
		height:20px
      }
      .profilImg {
        width: 250px;
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
		<th>Payment Type</th>
		<th>Payment Staus</th>
    <th>Category</th>
		<th>Date</th>
    <th>Status</th>
		<th>Action</th>
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
    <!-- <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butCheckInfo'>Check List</a> -->
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

<div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Telephone</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblTelephone"></label></div><div class="form-group col-md-3 textMainTxtStyle">
Mobile Number </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblMobile"></label></div></div>

<div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">Web site</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblWeb"></label></div><div class="form-group col-md-3 textMainTxtStyle">
Province </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblProvince"></label></div></div>

<div class="form-row"><div class="form-group col-md-3 textMainTxtStyle">E-mail</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblMail"></label></div><div class="form-group col-md-3 textMainTxtStyle">
District </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblDistrict"></label></div></div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->     
<div id="staffInfo">
          <div class="form-row"><div class="form-group col-md-12 textMainTxtStyle">The details of the medical staff including Doctors, Consultants engaged in the profession under this institution</div></div>
        
          <div class="card" >
                <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments1" style="overflow:auto">
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
                &nbsp; </div><div class="form-group col-md-3">&nbsp;</div></div>
                
                <div class="form-row"><div class="form-group col-md-3">Type of the institution</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtInsType"></label></div><div class="form-group col-md-3">
 Ownership status </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtOwnerShip"></label></div></div>

 <div class="form-row"><div class="form-group col-md-3">Institute/Owner Profile</div><div class="form-group col-md-3">:&nbsp;<div class="profilDiv"></div></div><div class="form-group col-md-3">
                &nbsp; </div><div class="form-group col-md-3">&nbsp;</div></div>



<!--  <a style ="display:contents" target="_blank" id ="insProf">View</a>                  <div class="form-row"><div class="form-group col-md-6">
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
                </div></div>-->
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
    
<!--    <div class="form-row"><div class="form-group col-md-3">License obtained from the Atomic Energy Authority for Radiology Service</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboAtomicEnergy"></label></div><div class="form-group col-md-3">
 The number of such license </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoLicense"></label></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Method of clinical waste disposal</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtclinicalDis"></label></div><div class="form-group col-md-3">
 Method of sterilization of instruments and dressings</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtInsDress"></label></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Emergency kit</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboEmgKit"></label></div><div class="form-group col-md-3">
         &nbsp; </div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id=""></label></div></div>-->
        
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
        
         <div class="form-row"><div class="form-group col-md-3">Registration Fee</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtregAmount"></label></div><div class="form-group col-md-3">
 Stamp Fee</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtStampAmount"></label></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Arrears Amount</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtArras"></label></div><div class="form-group col-md-3">
Payment Amount</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtAmount"></label></div></div>

 <div class="form-row"><div class="form-group col-md-3">Paying Branch</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentBranch"></label></div><div class="form-group col-md-3">Payment Date
&nbsp;</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentDate"></label></div></div>
      <br>
      <div class="form-row"><div class="form-group col-md-3">Bank Slip</div><div class="form-group col-md-3">:&nbsp;<a style ="display:contents" target="_blank" id ="slip">View</a></div><div class="form-group col-md-3">&nbsp;</div><div class="form-group col-md-3">&nbsp;</div></div>
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
       <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->      <div id="checkList">
 <!---------------------------------------------------------------------------------------------------------------->          
<!--  
<div style="" id="denLab"><div class="form-row"><div class="form-group col-md-3">Name of the person operating the Ambulance Service</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtambName" class="form-group" name="txtambName"/></div><div class="form-group col-md-3">Number of Doctors available </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtNoDoctor" class="form-group" name="txtNoDoctor"/></div></div>
        
         <div class="form-row"><div class="form-group col-md-3">Number of Nurses available </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtNoNurs" class="form-group" name="txtNoNurs"/></div><div class="form-group col-md-3">
 Number of Ambulances </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtnoAmbulance" class="form-group" name="txtnoAmbulance"/></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Model</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtnoModel" class="form-group" name="txtnoModel"/></div><div class="form-group col-md-3">
&nbsp;</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentDate"></label></div></div>

 <div class="form-row"><div class="form-group col-md-3">Facilities available</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtfacility" class="form-group" name="txtfacility"/></div><div class="form-group col-md-3">
Equipment available </div><div class="form-group col-md-3">&nbsp;<input type="text" id="txtequipment" class="form-group" name="txtfacility"/></div></div>

<div class="form-row"><div class="form-group col-md-3">Number of Drivers available</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtDriverAv" class="form-group" name="txtDriverAv"/></div><div class="form-group col-md-3">
Extracts of the RMV registration</div><div class="form-group col-md-3">&nbsp;<input type="text" id="txtRMVreg" class="form-group" name="txtRMVreg"/></div></div>
</div>-->
           
<!---------------------------------------------dental Lab--------------------------------------------------------------------->     

<!--<div style="" id="denLab"><div class="form-row"><div class="form-group col-md-3">Name of the person operating the Dental Laboratory </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtdlName" class="form-group" name="txtdlName"/></div><div class="form-group col-md-3">
 Name of the Dental Laboratory Technician</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtdlTName" class="form-group" name="txtdlTName"/></div></div>
        
         <div class="form-row"><div class="form-group col-md-3">Qualifications </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtQlifications" class="form-group" name="txtQlifications"/></div><div class="form-group col-md-3">
 Facilities available</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtfaciAv" class="form-group" name="txtfaciAv"/></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Method of Clinical Waste Disposal</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtwastDisposal" class="form-group" name="txtwastDisposal"/></div><div class="form-group col-md-3">
Business registration no</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtbusinessReg" class="form-group" name="txtbusinessReg"/></div></div>
    </div>-->


<!-------------------------------------------------------------------------------------------------------------------->
<!--<div style="height:200px;overflow: auto" id="mdLab">
<div class="form-row"><div class="form-group col-md-3">Name of the person operating the Laboratory </div><div class="form-group col-md-3">&nbsp;</div><div class="form-group col-md-3">
&nbsp;</div><div class="form-group col-md-3">&nbsp;<input type="text" id="txtNoDoctor" class="form-group" name="txtNoDoctor"/></div></div>
        
         <div class="form-row"><div class="form-group col-md-3">Name of the Pathologist </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtNamePath" class="form-group" name="txtNamePath"/></div><div class="form-group col-md-3">
 Sri Lanka Medical Council (SLMC) registration no </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtpathSLMC" class="form-group" name="txtpathSLMC"/></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Whether Full Time/ Part Time </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtpathWh" class="form-group" name="txtpathWh"/></div><div class="form-group col-md-3">
&nbsp;</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentDate"></label></div></div>

 <div class="form-row"><div class="form-group col-md-3">Name of the Microbiologist</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtNameMicro" class="form-group" name="txtNameMicro"/></div><div class="form-group col-md-3">
Sri Lanka Medical Council (SLMC) registration no</div><div class="form-group col-md-3">&nbsp;<input type="text" id="txtmicSlmc" class="form-group" name="txtmicSlmc"/></div></div>

<div class="form-row"><div class="form-group col-md-3">Whether Full Time/ Part Time</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtmicWh" class="form-group" name="txtmicWh"/></div><div class="form-group col-md-3">
&nbsp</div><div class="form-group col-md-3">&nbsp;</div></div>

 <div class="form-row"><div class="form-group col-md-3">Name of the Chemical Pathologist</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtNameChemi" class="form-group" name="txtNameChemi"/></div><div class="form-group col-md-3">
Sri Lanka Medical Council (SLMC) registration no</div><div class="form-group col-md-3">&nbsp;<input type="text" id="txtcemSlmc" class="form-group" name="txtcemSlmc"/></div></div>

<div class="form-row"><div class="form-group col-md-3">Whether Full Time/ Part Time</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtcemWh" class="form-group" name="txtcemWh"/></div><div class="form-group col-md-3">
&nbsp</div><div class="form-group col-md-3">&nbsp;</div></div>

<div class="form-row"><div class="form-group col-md-3">Internal and External Quality Controlling</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtqtyControl" class="form-group" name="txtqtyControl"/></div><div class="form-group col-md-3">
Facilities available </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtfaciCemi" class="form-group" name="txtfaciCemi"/></div></div>

<div class="form-row"><div class="form-group col-md-3">Method of Clinical Waste Disposal</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtcemWh" class="form-group" name="txtcemWh"/></div><div class="form-group col-md-3">
&nbsp</div><div class="form-group col-md-3">&nbsp;</div></div>

<div class="form-row"><div class="form-group col-md-3">Business registration no. </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtcembisReg" class="form-group" name="txtcembisReg"/></div><div class="form-group col-md-3">
&nbsp</div><div class="form-group col-md-3">&nbsp;</div></div>
</div>-->
<!--------------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------Hospital--------------------------------------------------------------->     
<!--
<div style="" id="denLab"><div class="form-row"><div class="form-group col-md-3">Name of the Owner </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtdlName" class="form-group" name="txtdlName"/></div><div class="form-group col-md-3">
 Name of the Chief Executive Officer</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtdlTName" class="form-group" name="txtdlTName"/></div></div>
        
         <div class="form-row"><div class="form-group col-md-3">Name of the Medical Director</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtQlifications" class="form-group" name="txtQlifications"/></div><div class="form-group col-md-3">
 (SLMC) registration no</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtfaciAv" class="form-group" name="txtfaciAv"/></div></div>
 
 <div class="form-row"><div class="form-group col-md-3">Number of Full Time Doctors </div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtwastDisposal" class="form-group" name="txtwastDisposal"/></div><div class="form-group col-md-3">
Name of the Nursing Director</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtbusinessReg" class="form-group" name="txtbusinessReg"/></div></div>
    </div>

<div class="form-row"><div class="form-group col-md-3">Number of Nurses</div><div class="form-group col-md-3">:&nbsp;<input type="text" id="txtwastDisposal" class="form-group" name="txtwastDisposal"/></div>
    
     </div>
    
    <div class="form-row"><div class="form-group col-md-6">
    <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                          <th style="width: 100%;" colspan="2">Consultation Rooms</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Number of consultation rooms</td><td class='p-1'><input type="text" id="checkPvtHs" /></td></tr>
                        <tr><td align='center' class='p-1'>Square area of the each room </td><td class='p-1'><input type="text" id="checkNursingHome" /></td></tr>
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
                          <th style="width: 100%;" colspan="2">Equipments</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Examination bed</td><td class='p-1'><input type="text" id="checkPubCompany"/></td></tr>
                    <tr><td align='center' class='p-1'>Table and chairs</td><td class='p-1'><input type="text" id="checkPvtCompany" /></td></tr>
                    <tr><td align='center' class='p-1'>Wash basin</td><td class='p-1'><input type="text" id="checkProHospital" /></td></tr>
                    <tr><td align='center' class='p-1'>Weighing scale</td><td class='p-1'><input type="text" id="checkCoHospital" /></td></tr>
                    <tr><td align='center' class='p-1'>Adequate ventilation and illumination</td><td class='p-1'><input type="text" id="checkEsHospital" /></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>  
                </div></div>


<div class="form-row"><div class="form-group col-md-6">
    <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                          <th style="width: 100%;" colspan="2">Waiting Area</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Seating facilities for minimum
of 10 persons per consultation
 room with sanitary facilities
</td><td class='p-1'><input type="text" id="checkPvtHs" /></td></tr>
                        <tr><td align='center' class='p-1'>Adequate ventilation and illumination </td><td class='p-1'><input type="text" id="checkNursingHome" /></td></tr>
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
                          <th style="width: 100%;" colspan="2">Sample Collection Room</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Examination bed</td><td class='p-1'><input type="text" id="checkPubCompany"/></td></tr>
                    <tr><td align='center' class='p-1'>Floor area</td><td class='p-1'><input type="text" id="checkPvtCompany" /></td></tr>
                    <tr><td align='center' class='p-1'>Adequate sanitary facilities</td><td class='p-1'><input type="text" id="checkProHospital" /></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>  
                </div></div>


<div class="form-row"><div class="form-group col-md-6">
    <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                          <th style="width: 100%;" colspan="2">Equipments</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Arm chair
</td><td class='p-1'><input type="text" id="checkPvtHs" /></td></tr>
                        <tr><td align='center' class='p-1'>Bed</td><td class='p-1'><input type="text" id="checkNursingHome" /></td></tr>
                        <tr><td align='center' class='p-1'>Safe waste disposal</td><td class='p-1'><input type="text" id="checkNursingHome" /></td></tr>
                        <tr><td align='center' class='p-1'>Toilet facilities</td><td class='p-1'><input type="text" id="checkNursingHome" /></td></tr>
                        <tr><td align='center' class='p-1'>Adequate illumination</td><td class='p-1'><input type="text" id="checkNursingHome" /></td></tr>
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
                          <th style="width: 100%;" colspan="2">Laboratory Facilities</th>
                       
                      </tr>
                    </thead>
                    <tbody><tr><td align='center' class='p-1'>Name of the Pathologist
		Sri Lanka Medical Council (SLMC)
registration no.
Whether Full Time/ Part Time
</td><td class='p-1'><input type="text" id="checkPubCompany"/></td></tr>
                    <tr><td align='center' class='p-1'>Name of the Microbiologist
		Sri Lanka Medical Council (SLMC)
registration no.
Whether Full Time/ Part Time
</td><td class='p-1'><input type="text" id="checkPvtCompany" /></td></tr>
                    <tr><td align='center' class='p-1'>Name of the Chemical Pathologist
		Sri Lanka Medical Council (SLMC)
registration no.
Whether Full Time/ Part Time
</td><td class='p-1'><input type="text" id="checkProHospital" /></td></tr>
                    <tr><td align='center' class='p-1'>Name of the Chief Medical Laboratory
		Technician 
		Sri Lanka Medical Council (SLMC)
registration no.
Number of Medical Laboratory
Technicians 
</td><td class='p-1'><input type="text" id="checkProHospital" /></td></tr>
                    </tr>
                    <tr><td align='center' class='p-1'>Internal and external quality controlling
</td><td class='p-1'><input type="text" id="checkProHospital" /></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>  
                </div></div>-->
    
    
   


<!-------------------------------------------------------------------------------------------------------------------->

           
<!--           <div class="form-row"><div class="form-group col-md-3">Upload Check List</div><div class="form-group col-md-3">&nbsp;<input type="file"/></div><div class="form-group col-md-3">
                   &nbsp;</div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id=""></label></div></div>
        
           <div class="form-row"><div class="form-group col-md-3">Comments</div><div class="form-group col-md-9">&nbsp;<textarea class="form-group col-md-9" name="txtComment" name="txtComment"></textarea></div></div>
 
           <div class="form-row"><div class="form-group col-md-3">&nbsp;</div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id="txtPaymentBranch"></label></div><div class="form-group col-md-3">
                   &nbsp;</div><div class="form-group col-md-3">&nbsp;<button type="button" class="btn btn-success" id="btnApprove">Save</button></div></div>-->

 
 
<!-- <div class="form-row"><div class="form-group col-md-4">&nbsp;</div><div class="form-group col-md-4"><img src="" class="avatar1-pic" alt="Bank Slip" height="20px"></div><div class="form-group col-md-4">&nbsp;</div></div>-->
        
        </div>
  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->

        
        </div>
        <div><center><textarea style="width:90%" placeholder="PD's Comment" name="txtRemark" id="txtRemark" readonly></textarea></center></div>
        <div class="modal-footer">
          
         <div style=""><b><label id="lblAcction" style="font-size:36px;"></label></b></div><div class="col-md-5">&nbsp;</div> <center><button type="button" class="btn btn-success btnApprove" id="btnApprove">Approve</button>&nbsp;<button type="button" class="btn btn-danger" id="btnReject">Reject</button>&nbsp;<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnClose">Close</button></center>
        </div>
      </div>
      
    </div>
  </div>
<!--  Developed By Yasser Mas -->
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
 <script src="<?php echo $backwardSeparator;?>js/dms.js"></script>
<script  src="../../../js/grid_js/script.js"></script>
<script  src="list.js"></script>



