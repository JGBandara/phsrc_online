
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_location #btnNew').hide();
  $('#frmsys_location #btnList').hide();
  $('#frmsys_location #btnSave').hide();
  $('#frmsys_location #btnPrint').hide();
  $('#frmsys_location #btnDelete').hide();
  $('#frmsys_location #btnApprove').hide();
  $('#frmsys_location #btnReject').hide();
  $('#frmsys_location #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_location #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_location #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_location #btnNew').show();
 	$('#frmsys_location #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_location #btnSave').show();
 	$('#frmsys_location #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_location #btnDelete').show();
 	$('#frmsys_location #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_location #btnPrint').show();
 	$('#frmsys_location #cboSearch').prop('disabled', false);
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
  $( "#frmsys_location" ).validate( {
      rules: {
        txtCode: {
                  required: true,
                  maxlength: 10
                },
        txtName: {
                  required: true,
                  maxlength: 50
                },
        txtAddress: {
                  maxlength: 250
                },
        txtStreet: {
                  maxlength: 200
                },
        txtCity: {
                  maxlength: 200
                },
        txtPhoneNo: {
                  maxlength: 100,
                  tel: true
                },
        txtFaxNo: {
                  maxlength: 100,
                  tel: true
                },
        txtEmail: {
                  maxlength: 250,
                  email: true
                },
        txtAttendanceFormat: {
                  maxlength: 32
                },
        txtZipCode: {
                  maxlength: 10
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
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmsys_location #chkAutoManual').click(function(){
    if($('#frmsys_location #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_location #syl_code').val('');
      $('#frmsys_location #syl_code').prop("readonly",true);
      $('#frmsys_location #syl_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_location #syl_code').val('');
      $('#frmsys_location #syl_code').prop("readonly",false);
      $('#frmsys_location #syl_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_location #btnNew").click(function(){  
    $("#frmsys_location").get(0).reset();
    $("#frmsys_location").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_location #btnList").click(function(){  
    window.location.assign("locationListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_location #btnPrint").click(function(){  
    if($('#frmsys_location #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_location #cboSearch').val();
      window.location.assign("locationPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_location #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_location #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_location").valid()){   // test for validity
      if($('#frmsys_location #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_location #cboSearch').val();
      }
      var url = "location-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_location").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_location').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_location #cboSearch').trigger('change');
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
  $("#frmsys_location #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_location #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_location #cboSearch').val();
    }
    var url = "location-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_location').get(0).reset();
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
  $("#frmsys_location #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_location #cboSearch").change(function(){  
    $("#frmsys_location").validate().resetForm();
    var url = "location-db-get.php";
    if($('#frmsys_location #cboSearch').val()==''){
        $('#frmsys_location').get(0).reset();return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$(this).val(),
        async:false,
        success:function(json){
        //jQuery.each($menuList, function($m, $menu) {
        //});
        $('#frmsys_location #txtCode').val(json[0].syl_code);
                $('#frmsys_location #txtName').val(json[0].syl_name);
                $('#frmsys_location #txtAddress').val(json[0].syl_address);
                $('#frmsys_location #txtStreet').val(json[0].syl_street);
                $('#frmsys_location #txtCity').val(json[0].syl_city);
                $('#frmsys_location #txtPhoneNo').val(json[0].syl_phone_no);
                $('#frmsys_location #txtFaxNo').val(json[0].syl_fax_no);
                $('#frmsys_location #txtEmail').val(json[0].syl_email);
                $('#frmsys_location #txtAttendanceFormat').val(json[0].syl_attendance_format);
                $('#frmsys_location #txtZipCode').val(json[0].syl_zip_code);
                $('#frmsys_location #txtRemarks').val(json[0].syl_remarks);
                $('#frmsys_location #cboStatus').val(json[0].syl_status);
                if(json[0].syl_is_deleted=='1')
                  $('#frmsys_location #optIsDeleted').prop('checked',true);
                else
                  $('#frmsys_location #optIsDeleted').prop('checked',false); 
                $('#frmsys_location input[name="optIsDeleted"][value="'+json[0].syl_is_deleted+'"]').prop('checked', true);

                $('#frmsys_location #cboCompanyId').val(json[0].syl_company_id);
                $('#frmsys_location #cboCreatedBy').val(json[0].syl_created_by);
                $('#frmsys_location #cboCreatedOn').val(json[0].syl_created_on);
                $('#frmsys_location #cboLastModifiedBy').val(json[0].syl_last_modified_by);
                $('#frmsys_location #cboLastModifiedOn').val(json[0].syl_last_modified_on);
                $('#frmsys_location #cboDeletedBy').val(json[0].syl_deleted_by);
                $('#frmsys_location #cboDeletedOn').val(json[0].syl_deleted_on);
                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "location-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_location #cboSearch').html(httpobj.responseText);
	$('#frmsys_location #cboSearch').val($id);
	$('#frmsys_location #cboSearch').trigger('change');
}


