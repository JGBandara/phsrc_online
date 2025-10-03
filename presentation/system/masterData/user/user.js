
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
  $('#frmsys_users #btnNew').hide();
  $('#frmsys_users #btnList').hide();
  $('#frmsys_users #btnSave').hide();
  $('#frmsys_users #btnPrint').hide();
  $('#frmsys_users #btnDelete').hide();
  $('#frmsys_users #btnApprove').hide();
  $('#frmsys_users #btnReject').hide();
  $('#frmsys_users #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_users #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_users #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_users #btnNew').show();
 	$('#frmsys_users #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_users #btnSave').show();
 	$('#frmsys_users #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_users #btnDelete').show();
 	$('#frmsys_users #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_users #btnPrint').show();
 	$('#frmsys_users #cboSearch').prop('disabled', false);
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
  $( "#frmsys_users" ).validate( {
      rules: {
        txtUserName: {
                  required: true,
                  maxlength: 50
                },
        txtPassword: {
                  required: true,
                  maxlength: 50
                },
        txtFullName: {
                  required: true,
                  maxlength: 100
                },
        txtContactNo: {
                  maxlength: 200
                },
        txtGender: {
                  maxlength: 15
                },
        txtEmail: {
                  required: true,
                  maxlength: 100
                },
        txtResetPasswordTime: {
                  maxlength: 100
                },
        cboEmployeeId:"required",
        txtRemarks: {
                  maxlength: 255
                },
        cboCompanyId:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmsys_users #chkAutoManual').click(function(){
    if($('#frmsys_users #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_users #syu_user_name').val('');
      $('#frmsys_users #syu_user_name').prop("readonly",true);
      $('#frmsys_users #syu_user_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_users #syu_user_name').val('');
      $('#frmsys_users #syu_user_name').prop("readonly",false);
      $('#frmsys_users #syu_user_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_users #btnNew").click(function(){  
    $("#frmsys_users").get(0).reset();
    $("#frmsys_users").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_users #btnList").click(function(){  
    window.location.assign("userListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_users #btnPrint").click(function(){  
    if($('#frmsys_users #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_users #cboSearch').val();
      window.location.assign("userPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_users #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_users #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_users").valid()){   // test for validity
      if($('#frmsys_users #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_users #cboSearch').val();
      }
      var url = "user-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_users").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_users').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_users #cboSearch').trigger('change');
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
  $("#frmsys_users #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_users #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_users #cboSearch').val();
    }
    var url = "user-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_users').get(0).reset();
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
  $("#frmsys_users #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_users #cboSearch").change(function(){  
    $("#frmsys_users").validate().resetForm();
    var url = "user-db-get.php";
    if($('#frmsys_users #cboSearch').val()==''){
        $('#frmsys_users').get(0).reset();return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$(this).val(),
        async:false,
        success:function(json){
        //jQuery.each($menuList, function($m, $menu) {
        //});
        $('#frmsys_users #txtUserName').val(json[0].syu_user_name);
                $('#frmsys_users #txtPassword').val(json[0].syu_password);
                $('#frmsys_users #txtFullName').val(json[0].syu_full_name);
                $('#frmsys_users #cboDivisionId').val(json[0].syu_division_id);
                $('#frmsys_users #txtContactNo').val(json[0].syu_contact_no);
                $('#frmsys_users #cboDesignationId').val(json[0].syu_designation_id);
                $('#frmsys_users #txtGender').val(json[0].syu_gender);
                $('#frmsys_users #txtEmail').val(json[0].syu_email);
                $('#frmsys_users #txtResetPasswordTime').val(json[0].syu_reset_password_time);
                $('#frmsys_users #cboEmployeeId').val(json[0].syu_employee_id);
                $('#frmsys_users #txtRemarks').val(json[0].syu_remarks);
                $('#frmsys_users #cboStatus').val(json[0].syu_status);
                $('#frmsys_users #cboCompanyId').val(json[0].syu_company_id);
                $('#frmsys_users #cboCreatedBy').val(json[0].syu_created_by);
                $('#frmsys_users #cboCreatedOn').val(json[0].syu_created_on);
                $('#frmsys_users #cboLastModifiedBy').val(json[0].syu_last_modified_by);
                $('#frmsys_users #cboLastModifiedOn').val(json[0].syu_last_modified_on);
                $('#frmsys_users #cboDeletedBy').val(json[0].syu_deleted_by);
                $('#frmsys_users #cboDeletedOn').val(json[0].syu_deleted_on);
                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "user-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_users #cboSearch').html(httpobj.responseText);
	$('#frmsys_users #cboSearch').val($id);
	$('#frmsys_users #cboSearch').trigger('change');
}


