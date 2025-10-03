
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_employee_personal #btnNew').hide();
  $('#frmhrm_employee_personal #btnList').hide();
  $('#frmhrm_employee_personal #btnSave').hide();
  $('#frmhrm_employee_personal #btnPrint').hide();
  $('#frmhrm_employee_personal #btnDelete').hide();
  $('#frmhrm_employee_personal #btnApprove').hide();
  $('#frmhrm_employee_personal #btnReject').hide();
  $('#frmhrm_employee_personal #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_employee_personal #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_employee_personal #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_employee_personal #btnNew').show();
 	$('#frmhrm_employee_personal #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_employee_personal #btnSave').show();
 	$('#frmhrm_employee_personal #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_employee_personal #btnDelete').show();
 	$('#frmhrm_employee_personal #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_employee_personal #btnPrint').show();
 	$('#frmhrm_employee_personal #cboSearch').prop('disabled', false);
  }

  // =================================
  // Color Picker
  // ---------------------------------
  $('#txtCssColor').colorpicker();
  $('#txtCssColor').on('colorpickerChange', function(event) {
    $(this).css('background-color', event.color.toString());
  });
  
  // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_employee_personal" ).validate( {
      rules: {
        cboSearch:"required",
        txtInitials: {
                  required: true,
                  maxlength: 32
                },
        txtMiddleName: {
                  maxlength: 32
                },
        txtSurname: {
                  required: true,
                  maxlength: 32
                },
        txtNameDenotedByInitials: {
                  maxlength: 128
                },
        txtFullName: {
                  required: true,
                  maxlength: 128
                },
        txtOtherName: {
                  maxlength: 128
                },
        txtNicNo: {
                  maxlength: 32
                },
        dtpNicIssueDate: {
                  dateISO: true
                },
        txtNationality: {
                  maxlength: 64
                },
        txtRace: {
                  maxlength: 64
                },
        txtReligion: {
                  maxlength: 64
                },
        dtpDateOfBirth: {
                  dateISO: true
                },
        txtBloodGroup: {
                  maxlength: 32
                },
        optMaritialStatusId:"required",
        dtpMarriedDate: {
                  dateISO: true
                },
        txtPassportNo: {
                  maxlength: 64
                },
        dtpPassportIssueDate: {
                  dateISO: true
                },
        txtPassportIssuePlace: {
                  maxlength: 128
                },
        dtpPassportExpiryDate: {
                  dateISO: true
                },
        txtPassportCountries: {
                  maxlength: 256
                },
        txtDrivingLicenseNo: {
                  maxlength: 64
                },
        dtpDrivingLicenseIssueDate: {
                  dateISO: true
                },
        dtpDrivingLicenseExpiryDate: {
                  dateISO: true
                },
        txtDrivingLicenseVehicleClass: {
                  maxlength: 128
                },
        txtRemarks: {
                  maxlength: 256
                },
        cboStatus:"required",
        cboCompanyId:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // ----------------------------------------------------------
  //        Active Tab
  // ----------------------------------------------------------
  $('.employee-tab a').each(function(){
    $href = $(this).attr('href');
    $url = $href.split('?')[0];
    $tempPath = backwardSeparator + xprojectPath;
    if($url==$tempPath){
      $(this).addClass('active');
    }
    else{
      $(this).removeClass('active');
    }
  });
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmhrm_employee_personal #chkAutoManual').click(function(){
    if($('#frmhrm_employee_personal #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_employee_personal #emp_initials').val('');
      $('#frmhrm_employee_personal #emp_initials').prop("readonly",true);
      $('#frmhrm_employee_personal #emp_initials').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_employee_personal #emp_initials').val('');
      $('#frmhrm_employee_personal #emp_initials').prop("readonly",false);
      $('#frmhrm_employee_personal #emp_initials').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_employee_personal #btnNew").click(function(){  
    $("#frmhrm_employee_personal").get(0).reset();
    $("#frmhrm_employee_personal").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_employee_personal #btnList").click(function(){  
    window.location.assign("employeePersonalListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_employee_personal #btnPrint").click(function(){  
    if($('#frmhrm_employee_personal #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_personal #cboSearch').val();
      window.location.assign("employeePersonalPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_employee_personal #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_employee_personal #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_employee_personal").valid()){   // test for validity
      if($('#frmhrm_employee_personal #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_employee_personal #cboSearch').val();
      }
      var url = "employeePersonal-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_employee_personal").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_employee_personal').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_employee_personal #cboSearch').trigger('change');
                        modalMsgBox("Success", json.msg);
						return;
					}
                    else if(json.type=='fail'){
                        modalMsgBox("Error", json.msg);
						return;
                    }
				},
			error:function(xhr,status){
                    modalMsgBox("Error", "AJAX error "+xhr.status);
				}		
			});
    } else {
      modalMsgBox("Error", "Validation Failed ...");
    }
  });
  
  // --------------------------------------------------------
  //      Delete Function
  // --------------------------------------------------------
  $("#frmhrm_employee_personal #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_employee_personal #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_personal #cboSearch').val();
    }
    var url = "employeePersonal-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_employee_personal').get(0).reset();
                      modalMsgBox("Success", json.msg);
                      return;
                  }
                  else if(json.type=='fail'){
                      modalMsgBox("Error", json.msg);
                      return;
                  }
              },
          error:function(xhr,status){
              modalMsgBox("Error", "AJAX error "+xhr.status);
              }		
          });
  });
  
  // =====================================================
  // ===============  Search  combo Content Load =========
  // =====================================================
  $("#frmhrm_employee_personal #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_employee_personal #cboSearch").change(function(){  
    $("#frmhrm_employee_personal").validate().resetForm();
    var url = "employeePersonal-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_employee_personal').get(0).reset();return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_employee_personal').get(0).reset();
          $("#frmhrm_employee_personal #cboSearch").val($id);
          if(json){ 
              $('#frmhrm_employee_personal #cboId').val(json[0].emp_id);
              $('#frmhrm_employee_personal #txtInitials').val(json[0].emp_initials);
              $('#frmhrm_employee_personal #txtMiddleName').val(json[0].emp_middle_name);
              $('#frmhrm_employee_personal #txtSurname').val(json[0].emp_surname);
              $('#frmhrm_employee_personal #txtNameDenotedByInitials').val(json[0].emp_name_denoted_by_initials);
              $('#frmhrm_employee_personal #txtFullName').val(json[0].emp_full_name);
              $('#frmhrm_employee_personal #txtOtherName').val(json[0].emp_other_name);
              $('#frmhrm_employee_personal #txtNicNo').val(json[0].emp_nic_no);
              $('#frmhrm_employee_personal #dtpNicIssueDate').val(json[0].emp_nic_issue_date);
              $('#frmhrm_employee_personal #txtNationality').val(json[0].emp_nationality);
              $('#frmhrm_employee_personal #txtRace').val(json[0].emp_race);
              $('#frmhrm_employee_personal #txtReligion').val(json[0].emp_religion);
              $('#frmhrm_employee_personal input[name="optGender"][value="'+json[0].emp_gender+'"]').prop('checked', true);
              $('#frmhrm_employee_personal #dtpDateOfBirth').val(json[0].emp_date_of_birth);
              $('#frmhrm_employee_personal #txtBloodGroup').val(json[0].emp_blood_group);
              $('#frmhrm_employee_personal #optMaritialStatusId').val(json[0].emp_maritial_status_id);
              $('#frmhrm_employee_personal #dtpMarriedDate').val(json[0].emp_married_date);

              $('#frmhrm_employee_personal #txtPassportNo').val(json[0].emp_passport_no);
              $('#frmhrm_employee_personal #optPassportType').val(json[0].emp_passport_type);
              $('#frmhrm_employee_personal #dtpPassportIssueDate').val(json[0].emp_passport_issue_date);
              $('#frmhrm_employee_personal #txtPassportIssuePlace').val(json[0].emp_passport_issue_place);
              $('#frmhrm_employee_personal #dtpPassportExpiryDate').val(json[0].emp_passport_expiry_date);
              $('#frmhrm_employee_personal #txtPassportCountries').val(json[0].emp_passport_countries);

              $('#frmhrm_employee_personal #txtDrivingLicenseNo').val(json[0].emp_driving_license_no);
              $('#frmhrm_employee_personal #dtpDrivingLicenseIssueDate').val(json[0].emp_driving_license_issue_date);
              $('#frmhrm_employee_personal #dtpDrivingLicenseExpiryDate').val(json[0].emp_driving_license_expiry_date);
              $('#frmhrm_employee_personal #txtDrivingLicenseVehicleClass').val(json[0].emp_driving_license_vehicle_class);
              $('#frmhrm_employee_personal #txtRemarks').val(json[0].emp_remarks);
              $('#frmhrm_employee_personal #cboStatus').val(json[0].emp_status);
          }
        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "employeePersonal-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_personal #cboSearch').html(httpobj.responseText);
	$('#frmhrm_employee_personal #cboSearch').val($id);
	$('#frmhrm_employee_personal #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}

