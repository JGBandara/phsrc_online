
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
  $('#frmhrm_employee_information #btnNew').hide();
  $('#frmhrm_employee_information #btnList').hide();
  $('#frmhrm_employee_information #btnSave').hide();
  $('#frmhrm_employee_information #btnPrint').hide();
  $('#frmhrm_employee_information #btnDelete').hide();
  $('#frmhrm_employee_information #btnApprove').hide();
  $('#frmhrm_employee_information #btnReject').hide();
  $('#frmhrm_employee_information #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_employee_information #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_employee_information #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_employee_information #btnNew').show();
 	$('#frmhrm_employee_information #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_employee_information #btnSave').show();
 	$('#frmhrm_employee_information #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_employee_information #btnDelete').show();
 	$('#frmhrm_employee_information #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_employee_information #btnPrint').show();
 	$('#frmhrm_employee_information #cboSearch').prop('disabled', false);
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
  $( "#frmhrm_employee_information" ).validate( {
      rules: {
        txtNo: {
                  required: true,
                  maxlength: 32
                },
        txtCallingName: {
                  required: true,
                  maxlength: 32
                },
        txtEpfNo: {
                  maxlength: 32
                },
        txtFingerPrintNo: {
                  maxlength: 32
                },
        dtpJoinedDate: {
                  dateISO: true
                },
        dtpPermanentDate: {
                  dateISO: true
                },
        dtpConfirmDate: {
                  dateISO: true
                },
        dtpResignedDate: {
                  dateISO: true
                },
        dtpRetirementDate: {
                  dateISO: true
                },
        txtImageName: {
                  maxlength: 64
                },
        txtRemarks: {
                  maxlength: 250
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
  $('#frmhrm_employee_information #chkAutoManual').click(function(){
    if($('#frmhrm_employee_information #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_employee_information #emi_no').val('');
      $('#frmhrm_employee_information #emi_no').prop("readonly",true);
      $('#frmhrm_employee_information #emi_no').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_employee_information #emi_no').val('');
      $('#frmhrm_employee_information #emi_no').prop("readonly",false);
      $('#frmhrm_employee_information #emi_no').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_employee_information #btnNew").click(function(){  
    $("#frmhrm_employee_information").get(0).reset();
    $("#frmhrm_employee_information").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_employee_information #btnList").click(function(){  
    window.location.assign("employeeInformationListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_employee_information #btnPrint").click(function(){  
    if($('#frmhrm_employee_information #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_information #cboSearch').val();
      window.location.assign("employeeInformationPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_employee_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_employee_information #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_employee_information").valid()){   // test for validity
      if($('#frmhrm_employee_information #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_employee_information #cboSearch').val();
      }
      event.preventDefault();
      var form = $('#frmhrm_employee_information');
      var frmData = false;
      if (window.FormData){
          frmData = new FormData(form[0]);
      }

      frmData.append('requestType',requestType);
      frmData.append('cboSearch',id);
      frmData.append('anStatus',anStatus);
      var url = "employeeInformation-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			cache:false,
        	contentType:false,
        	processData:false,
			async:false,
			data:frmData?frmData:form.serialize(),
			type:'post', 
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_employee_information').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_employee_information #cboSearch').trigger('change');
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
  $("#frmhrm_employee_information #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_employee_information #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_information #cboSearch').val();
    }
    var url = "employeeInformation-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_employee_information').get(0).reset();
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
  $("#frmhrm_employee_information #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_employee_information #cboSearch").change(function(){  
    $("#frmhrm_employee_information").validate().resetForm();
    var url = "employeeInformation-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_employee_information').get(0).reset();
        $('#frmhrm_employee_information .avatar-pic').attr('src',backwardSeparator+'img/profile/avatar.jpg'); 
        return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_employee_information').get(0).reset();
          $("#frmhrm_employee_information #cboSearch").val($id);
          if(json){ 
              $('#frmhrm_employee_information #txtNo').val(json[0].emi_no);
              $('#frmhrm_employee_information #txtCallingName').val(json[0].emi_calling_name);
              $('#frmhrm_employee_information #txtEpfNo').val(json[0].emi_epf_no);
              $('#frmhrm_employee_information #txtFingerPrintNo').val(json[0].emi_finger_print_no);
              $('#frmhrm_employee_information #dtpJoinedDate').val(json[0].emi_joined_date);
              $('#frmhrm_employee_information #dtpPermanentDate').val(json[0].emi_permanent_date);
              $('#frmhrm_employee_information #dtpConfirmDate').val(json[0].emi_confirm_date);
              $('#frmhrm_employee_information input[name="optConfirmStatus"][value="'+json[0].emi_confirm_status+'"]').prop('checked', true);
              $('#frmhrm_employee_information input[name="optMedicalStatus"][value="'+json[0].emi_medical_status+'"]').prop('checked', true);
              $('#frmhrm_employee_information #dtpResignedDate').val(json[0].emi_resigned_date);
              $('#frmhrm_employee_information #dtpRetirementDate').val(json[0].emi_retirement_date);
              if(json[0].emi_image_name!=""){
                $('#frmhrm_employee_information .avatar-pic').attr('src',backwardSeparator+'img/profile/'+json[0].emi_image_name);
              }
              else{
                $('#frmhrm_employee_information .avatar-pic').attr('src',backwardSeparator+'img/profile/avatar.jpg');               
              }
              $('#frmhrm_employee_information #txtImageName').val(json[0].emi_image_name);
              $('#frmhrm_employee_information #txtRemarks').val(json[0].emi_remarks);
              $('#frmhrm_employee_information #cboStatus').val(json[0].emi_status);
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
	var url = "employeeInformation-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_information #cboSearch').html(httpobj.responseText);
	$('#frmhrm_employee_information #cboSearch').val($id);
	$('#frmhrm_employee_information #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


