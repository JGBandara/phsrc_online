
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_communication_language #btnNew').hide();
  $('#frmsys_communication_language #btnList').hide();
  $('#frmsys_communication_language #btnSave').hide();
  $('#frmsys_communication_language #btnPrint').hide();
  $('#frmsys_communication_language #btnDelete').hide();
  $('#frmsys_communication_language #btnApprove').hide();
  $('#frmsys_communication_language #btnReject').hide();
  $('#frmsys_communication_language #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_communication_language #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_communication_language #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_communication_language #btnNew').show();
 	$('#frmsys_communication_language #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_communication_language #btnSave').show();
 	$('#frmsys_communication_language #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_communication_language #btnDelete').show();
 	$('#frmsys_communication_language #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_communication_language #btnPrint').show();
 	$('#frmsys_communication_language #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmsys_communication_language" ).validate( {
      rules: {
        txtName: {
                  required: true,
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
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmsys_communication_language #chkAutoManual').click(function(){
    if($('#frmsys_communication_language #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_communication_language #syg_name').val('');
      $('#frmsys_communication_language #syg_name').prop("readonly",true);
      $('#frmsys_communication_language #syg_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_communication_language #syg_name').val('');
      $('#frmsys_communication_language #syg_name').prop("readonly",false);
      $('#frmsys_communication_language #syg_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_communication_language #btnNew").click(function(){  
    $("#frmsys_communication_language").get(0).reset();
    $("#frmsys_communication_language").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_communication_language #btnList").click(function(){  
    window.location.assign("communicationLanguageListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_communication_language #btnPrint").click(function(){  
    if($('#frmsys_communication_language #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_communication_language #cboSearch').val();
      window.location.assign("communicationLanguagePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_communication_language #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_communication_language #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_communication_language").valid()){   // test for validity
      if($('#frmsys_communication_language #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_communication_language #cboSearch').val();
      }
      var url = "communicationLanguage-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_communication_language").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_communication_language').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_communication_language #cboSearch').trigger('change');
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
  $("#frmsys_communication_language #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_communication_language #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_communication_language #cboSearch').val();
    }
    var url = "communicationLanguage-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_communication_language').get(0).reset();
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
  $("#frmsys_communication_language #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_communication_language #cboSearch").change(function(){  
    $("#frmsys_communication_language").validate().resetForm();
    var url = "communicationLanguage-db-get.php";
    if($(this).val()==''){
        $('#frmsys_communication_language').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmsys_communication_language').get(0).reset();
          $('#frmsys_communication_language #cboSearch').val($id);
          if(json){ 
            $('#frmsys_communication_language #txtName').val(json[0].syg_name);
            $('#frmsys_communication_language #txtRemarks').val(json[0].syg_remarks);
            $('#frmsys_communication_language #cboStatus').val(json[0].syg_status);
            if(json[0].syg_is_deleted=='1')
              $('#frmsys_communication_language #optIsDeleted').prop('checked',true);
            else
              $('#frmsys_communication_language #optIsDeleted').prop('checked',false); 
            $('#frmsys_communication_language input[name="optIsDeleted"][value="'+json[0].syg_is_deleted+'"]').prop('checked', true);

            $('#frmsys_communication_language #cboCompanyId').val(json[0].syg_company_id);
            $('#frmsys_communication_language #cboCreatedBy').val(json[0].syg_created_by);
            $('#frmsys_communication_language #cboCreatedOn').val(json[0].syg_created_on);
            $('#frmsys_communication_language #cboLastModifiedBy').val(json[0].syg_last_modified_by);
            $('#frmsys_communication_language #cboLastModifiedOn').val(json[0].syg_last_modified_on);
            $('#frmsys_communication_language #cboDeletedBy').val(json[0].syg_deleted_by);
            $('#frmsys_communication_language #cboDeletedOn').val(json[0].syg_deleted_on);
                      
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
	var url = "communicationLanguage-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_communication_language #cboSearch').html(httpobj.responseText);
	$('#frmsys_communication_language #cboSearch').val($id);
	$('#frmsys_communication_language #cboSearch').trigger('change');
}


