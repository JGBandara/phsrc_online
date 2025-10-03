
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_employee_emergency #btnNew').hide();
  $('#frmhrm_employee_emergency #btnList').hide();
  $('#frmhrm_employee_emergency #btnSave').hide();
  $('#frmhrm_employee_emergency #btnPrint').hide();
  $('#frmhrm_employee_emergency #btnDelete').hide();
  $('#frmhrm_employee_emergency #btnApprove').hide();
  $('#frmhrm_employee_emergency #btnReject').hide();
  $('#frmhrm_employee_emergency #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_employee_emergency #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_employee_emergency #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_employee_emergency #btnNew').show();
 	$('#frmhrm_employee_emergency #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_employee_emergency #btnSave').show();
 	$('#frmhrm_employee_emergency #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_employee_emergency #btnDelete').show();
 	$('#frmhrm_employee_emergency #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_employee_emergency #btnPrint').show();
 	$('#frmhrm_employee_emergency #cboSearch').prop('disabled', false);
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
  $( "#frmhrm_employee_emergency" ).validate( {
      rules: {
        cboSearch:"required",
        txtFullName: {
                  required: true,
                  maxlength: 128
                },
        txtRelationship: {
                  required: true,
                  maxlength: 64
                },
        txtHomeAddress: {
                    maxlength: 256
                  },
        txtHomeTelephone: {
                    maxlength: 32,
                    tel: true
                  },
        txtOfficeAddress: {
                    maxlength: 256
                  },
        txtOfficeTelephone: {
                    maxlength: 32,
                    tel: true
                  },
        txtMobileNo: {
                    maxlength: 32,
                    tel: true
                  },
        txtEmergencyContact: {
                    maxlength: 128
                  },
        txtRemarks: {
                    maxlength: 256
                  },
        cboStatus:"required",
        
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
  $('#frmhrm_employee_emergency #chkAutoManual').click(function(){
    if($('#frmhrm_employee_emergency #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_employee_emergency #eme_full_name').val('');
      $('#frmhrm_employee_emergency #eme_full_name').prop("readonly",true);
      $('#frmhrm_employee_emergency #eme_full_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_employee_emergency #eme_full_name').val('');
      $('#frmhrm_employee_emergency #eme_full_name').prop("readonly",false);
      $('#frmhrm_employee_emergency #eme_full_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_employee_emergency #btnNew").click(function(){  
    $("#frmhrm_employee_emergency").get(0).reset();
    $("#frmhrm_employee_emergency").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_employee_emergency #btnList").click(function(){  
    window.location.assign("employeeEmergencyListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_employee_emergency #btnPrint").click(function(){  
    if($('#frmhrm_employee_emergency #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_emergency #cboSearch').val();
      window.location.assign("employeeEmergencyPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_employee_emergency #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_employee_emergency #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_employee_emergency").valid()){   // test for validity
      if($('#frmhrm_employee_emergency #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_employee_emergency #cboSearch').val();
      }
      var url = "employeeEmergency-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_employee_emergency").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_employee_emergency').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_employee_emergency #cboSearch').trigger('change');
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
  $("#frmhrm_employee_emergency #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_employee_emergency #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_emergency #cboSearch').val();
    }
    var url = "employeeEmergency-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_employee_emergency').get(0).reset();
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
  $("#frmhrm_employee_emergency #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_employee_emergency #cboSearch").change(function(){  
    $("#frmhrm_employee_emergency").validate().resetForm();
    var url = "employeeEmergency-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_employee_emergency').get(0).reset();return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_employee_emergency').get(0).reset();
          $("#frmhrm_employee_emergency #cboSearch").val($id);
          if(json){ 
            $('#frmhrm_employee_emergency #cboId').val(json[0].eme_id);
            $('#frmhrm_employee_emergency #txtFullName').val(json[0].eme_full_name);
            $('#frmhrm_employee_emergency #txtRelationship').val(json[0].eme_relationship);
            $('#frmhrm_employee_emergency #txtHomeAddress').val(json[0].eme_home_address);
            $('#frmhrm_employee_emergency #txtHomeTelephone').val(json[0].eme_home_telephone);
            $('#frmhrm_employee_emergency #txtOfficeAddress').val(json[0].eme_office_address);
            $('#frmhrm_employee_emergency #txtOfficeTelephone').val(json[0].eme_office_telephone);
            $('#frmhrm_employee_emergency #txtMobileNo').val(json[0].eme_mobile_no);
            $('#frmhrm_employee_emergency #txtEmergencyContact').val(json[0].eme_emergency_contact);
            $('#frmhrm_employee_emergency #txtRemarks').val(json[0].eme_remarks);
            $('#frmhrm_employee_emergency #cboStatus').val(json[0].eme_status);
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
	var url = "employeeEmergency-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_emergency #cboSearch').html(httpobj.responseText);
	$('#frmhrm_employee_emergency #cboSearch').val($id);
	$('#frmhrm_employee_emergency #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


