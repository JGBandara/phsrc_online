
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
  $('#frmsys_reset_users #btnNew').hide();
  $('#frmsys_reset_users #btnList').hide();
  $('#frmsys_reset_users #btnSave').hide();
  $('#frmsys_reset_users #btnPrint').hide();
  $('#frmsys_reset_users #btnDelete').hide();
  $('#frmsys_reset_users #btnApprove').hide();
  $('#frmsys_reset_users #btnReject').hide();
  $('#frmsys_reset_users #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_reset_users #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_reset_users #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_reset_users #btnNew').show();
 	$('#frmsys_reset_users #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_reset_users #btnSave').show();
 	$('#frmsys_reset_users #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_reset_users #btnDelete').show();
 	$('#frmsys_reset_users #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_reset_users #btnPrint').show();
 	$('#frmsys_reset_users #cboSearch').prop('disabled', false);
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
  $( "#frmsys_reset_users" ).validate( {
      rules: {
        txtPassword: {
                  required: true,
                  maxlength: 50
                },
        txtCurrentPassword:"required",
        txtConfirmPassword: {
                  required: true,
                  equalTo: '#txtPassword'
        },
        cboSearch:"required",
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_reset_users #btnNew").click(function(){  
    $("#frmsys_reset_users").get(0).reset();
    $("#frmsys_reset_users").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_reset_users #btnList").click(function(){  
    window.location.assign("userListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_reset_users #btnPrint").click(function(){  
    if($('#frmsys_reset_users #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_reset_users #cboSearch').val();
      window.location.assign("userPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_reset_users #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_reset_users #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_reset_users").valid()){   // test for validity
      if($('#frmsys_reset_users #cboSearch').val()==''){
        return	
      }
      else{
        requestType = 'passwordChange';	
        id = $('#frmsys_reset_users #cboSearch').val();
      }
      var url = "user-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_reset_users").serialize()+'&requestType='+requestType,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_reset_users').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_reset_users #cboSearch').trigger('change');
                        $('#frmsys_reset_users #txtPassword').val(json.password);
                        
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
    
});// Document Ready End

