
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmdms_file_permission #btnNew').hide();
  $('#frmdms_file_permission #btnList').hide();
  $('#frmdms_file_permission #btnSave').hide();
  $('#frmdms_file_permission #btnPrint').hide();
  $('#frmdms_file_permission #btnDelete').hide();
  $('#frmdms_file_permission #btnApprove').hide();
  $('#frmdms_file_permission #btnReject').hide();
  $('#frmdms_file_permission #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmdms_file_permission #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmdms_file_permission #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmdms_file_permission #btnNew').show();
 	$('#frmdms_file_permission #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmdms_file_permission #btnSave').show();
 	$('#frmdms_file_permission #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmdms_file_permission #btnDelete').show();
 	$('#frmdms_file_permission #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmdms_file_permission #btnPrint').show();
 	$('#frmdms_file_permission #cboSearch').prop('disabled', false);
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
  $( "#frmdms_file_permission" ).validate( {
      rules: {
        cboSearch:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmdms_file_permission #chkAutoManual').click(function(){
    if($('#frmdms_file_permission #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmdms_file_permission #dfp_file_category_id').val('');
      $('#frmdms_file_permission #dfp_file_category_id').prop("readonly",true);
      $('#frmdms_file_permission #dfp_file_category_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmdms_file_permission #dfp_file_category_id').val('');
      $('#frmdms_file_permission #dfp_file_category_id').prop("readonly",false);
      $('#frmdms_file_permission #dfp_file_category_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmdms_file_permission #btnNew").click(function(){  
    $("#frmdms_file_permission").get(0).reset();
    $("#frmdms_file_permission").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmdms_file_permission #btnList").click(function(){  
    window.location.assign("filePermissionListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmdms_file_permission #btnPrint").click(function(){  
    if($('#frmdms_file_permission #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_file_permission #cboSearch').val();
      window.location.assign("filePermissionPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmdms_file_permission #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmdms_file_permission #btnSave").click(function(){  
    var requestType = 'edit';
    var id = '';
    if($("#frmdms_file_permission").valid()){   // test for validity
      if($('#frmdms_file_permission #cboSearch').val()==''){
        return;	
      }
      
      var url = "filePermission-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmdms_file_permission").serialize()+'&requestType='+requestType,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmdms_file_permission').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmdms_file_permission #cboSearch').trigger('change');
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
    
  // =====================================================
  // ===============  Search  combo Content Load =========
  // =====================================================
  $("#frmdms_file_permission #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmdms_file_permission #cboSearch").change(function(){  
    $("#frmdms_file_permission").validate().resetForm();
    var url = "filePermission-db-get.php";
    if($(this).val()==''){
        $('#frmdms_file_permission').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmdms_file_permission').get(0).reset();
          $('#frmdms_file_permission #cboSearch').val($id);
          if(json){ 
            for (var i = 0; i < json.ids.length; i++) {
              $('.chk_permission[value='+json.ids[i]+']').prop('checked', true);
            }
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
	var url = "filePermission-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmdms_file_permission #cboSearch').html(httpobj.responseText);
	$('#frmdms_file_permission #cboSearch').val($id);
	$('#frmdms_file_permission #cboSearch').trigger('change');
}


