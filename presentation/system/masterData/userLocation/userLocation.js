
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
  $('#frmdms_user_location #btnNew').hide();
  $('#frmdms_user_location #btnList').hide();
  $('#frmdms_user_location #btnSave').hide();
  $('#frmdms_user_location #btnPrint').hide();
  $('#frmdms_user_location #btnDelete').hide();
  $('#frmdms_user_location #btnApprove').hide();
  $('#frmdms_user_location #btnReject').hide();
  $('#frmdms_user_location #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmdms_user_location #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmdms_user_location #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmdms_user_location #btnNew').show();
 	$('#frmdms_user_location #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmdms_user_location #btnSave').show();
 	$('#frmdms_user_location #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmdms_user_location #btnDelete').show();
 	$('#frmdms_user_location #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmdms_user_location #btnPrint').show();
 	$('#frmdms_user_location #cboSearch').prop('disabled', false);
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
  $( "#frmdms_user_location" ).validate( {
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
  $('#frmdms_user_location #chkAutoManual').click(function(){
    if($('#frmdms_user_location #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmdms_user_location #dfp_file_category_id').val('');
      $('#frmdms_user_location #dfp_file_category_id').prop("readonly",true);
      $('#frmdms_user_location #dfp_file_category_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmdms_user_location #dfp_file_category_id').val('');
      $('#frmdms_user_location #dfp_file_category_id').prop("readonly",false);
      $('#frmdms_user_location #dfp_file_category_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmdms_user_location #btnNew").click(function(){  
    $("#frmdms_user_location").get(0).reset();
    $("#frmdms_user_location").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmdms_user_location #btnList").click(function(){  
    window.location.assign("userLocationListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmdms_user_location #btnPrint").click(function(){  
    if($('#frmdms_user_location #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_user_location #cboSearch').val();
      window.location.assign("userLocationPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmdms_user_location #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmdms_user_location #btnSave").click(function(){  
    var requestType = 'edit';
    var id = '';
    if($("#frmdms_user_location").valid()){   // test for validity
      if($('#frmdms_user_location #cboSearch').val()==''){
        return;	
      }
      
      var url = "userLocation-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmdms_user_location").serialize()+'&requestType='+requestType,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmdms_user_location').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmdms_user_location #cboSearch').trigger('change');
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
  $("#frmdms_user_location #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmdms_user_location #cboSearch").change(function(){  
    $("#frmdms_user_location").validate().resetForm();
    var url = "userLocation-db-get.php";
    if($(this).val()==''){
        $('#frmdms_user_location').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmdms_user_location').get(0).reset();
          $('#frmdms_user_location #cboSearch').val($id);
          if(json){ 
            for (var i = 0; i < json.ids.length; i++) {
              $('.chk_location[value='+json.ids[i]+']').prop('checked', true);
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
	var url = "userLocation-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmdms_user_location #cboSearch').html(httpobj.responseText);
	$('#frmdms_user_location #cboSearch').val($id);
	$('#frmdms_user_location #cboSearch').trigger('change');
}


