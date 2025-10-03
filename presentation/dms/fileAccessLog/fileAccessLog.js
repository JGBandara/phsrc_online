
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
  $('#frmdms_trn_file_access_log #btnNew').hide();
  $('#frmdms_trn_file_access_log #btnList').hide();
  $('#frmdms_trn_file_access_log #btnSave').hide();
  $('#frmdms_trn_file_access_log #btnPrint').hide();
  $('#frmdms_trn_file_access_log #btnDelete').hide();
  $('#frmdms_trn_file_access_log #btnApprove').hide();
  $('#frmdms_trn_file_access_log #btnReject').hide();
  $('#frmdms_trn_file_access_log #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmdms_trn_file_access_log #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmdms_trn_file_access_log #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmdms_trn_file_access_log #btnNew').show();
 	$('#frmdms_trn_file_access_log #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmdms_trn_file_access_log #btnSave').show();
 	$('#frmdms_trn_file_access_log #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmdms_trn_file_access_log #btnDelete').show();
 	$('#frmdms_trn_file_access_log #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmdms_trn_file_access_log #btnPrint').show();
 	$('#frmdms_trn_file_access_log #cboSearch').prop('disabled', false);
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
  $( "#frmdms_trn_file_access_log" ).validate( {
      rules: {
        cboFileId:"required",
        cboUserId:"required",
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
  $('#frmdms_trn_file_access_log #chkAutoManual').click(function(){
    if($('#frmdms_trn_file_access_log #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmdms_trn_file_access_log #dfa_file_id').val('');
      $('#frmdms_trn_file_access_log #dfa_file_id').prop("readonly",true);
      $('#frmdms_trn_file_access_log #dfa_file_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmdms_trn_file_access_log #dfa_file_id').val('');
      $('#frmdms_trn_file_access_log #dfa_file_id').prop("readonly",false);
      $('#frmdms_trn_file_access_log #dfa_file_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmdms_trn_file_access_log #btnNew").click(function(){  
    $("#frmdms_trn_file_access_log").get(0).reset();
    $("#frmdms_trn_file_access_log").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmdms_trn_file_access_log #btnList").click(function(){  
    window.location.assign("fileAccessLogListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmdms_trn_file_access_log #btnPrint").click(function(){  
    if($('#frmdms_trn_file_access_log #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_trn_file_access_log #cboSearch').val();
      window.location.assign("fileAccessLogPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmdms_trn_file_access_log #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmdms_trn_file_access_log #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmdms_trn_file_access_log").valid()){   // test for validity
      if($('#frmdms_trn_file_access_log #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmdms_trn_file_access_log #cboSearch').val();
      }
      var url = "fileAccessLog-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmdms_trn_file_access_log").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmdms_trn_file_access_log').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmdms_trn_file_access_log #cboSearch').trigger('change');
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
  $("#frmdms_trn_file_access_log #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmdms_trn_file_access_log #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_trn_file_access_log #cboSearch').val();
    }
    var url = "fileAccessLog-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmdms_trn_file_access_log').get(0).reset();
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
  $("#frmdms_trn_file_access_log #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmdms_trn_file_access_log #cboSearch").change(function(){  
    $("#frmdms_trn_file_access_log").validate().resetForm();
    var url = "fileAccessLog-db-get.php";
    if($(this).val()==''){
        $('#frmdms_trn_file_access_log').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmdms_trn_file_access_log').get(0).reset();
          $('#frmdms_trn_file_access_log #cboSearch').val($id);
          if(json){ 
            $('#frmdms_trn_file_access_log #cboFileId').val(json[0].dfa_file_id);
            $('#frmdms_trn_file_access_log #cboUserId').val(json[0].dfa_user_id);
            $('#frmdms_trn_file_access_log #dtpAccessTime').val(json[0].dfa_access_time);
            $('#frmdms_trn_file_access_log #txtRemarks').val(json[0].dfa_remarks);
            $('#frmdms_trn_file_access_log #cboStatus').val(json[0].dfa_status);
            if(json[0].dfa_is_deleted=='1')
              $('#frmdms_trn_file_access_log #optIsDeleted').prop('checked',true);
            else
              $('#frmdms_trn_file_access_log #optIsDeleted').prop('checked',false); 
            $('#frmdms_trn_file_access_log input[name="optIsDeleted"][value="'+json[0].dfa_is_deleted+'"]').prop('checked', true);

            $('#frmdms_trn_file_access_log #cboCompanyId').val(json[0].dfa_company_id);
            $('#frmdms_trn_file_access_log #cboCreatedBy').val(json[0].dfa_created_by);
            $('#frmdms_trn_file_access_log #cboCreatedOn').val(json[0].dfa_created_on);
            $('#frmdms_trn_file_access_log #cboLastModifiedBy').val(json[0].dfa_last_modified_by);
            $('#frmdms_trn_file_access_log #cboLastModifiedOn').val(json[0].dfa_last_modified_on);
            $('#frmdms_trn_file_access_log #cboDeletedBy').val(json[0].dfa_deleted_by);
            $('#frmdms_trn_file_access_log #cboDeletedOn').val(json[0].dfa_deleted_on);
                      
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
	var url = "fileAccessLog-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmdms_trn_file_access_log #cboSearch').html(httpobj.responseText);
	$('#frmdms_trn_file_access_log #cboSearch').val($id);
	$('#frmdms_trn_file_access_log #cboSearch').trigger('change');
}


