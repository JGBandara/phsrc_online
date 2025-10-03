
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_academic_qualification_type #btnNew').hide();
  $('#frmhrm_academic_qualification_type #btnList').hide();
  $('#frmhrm_academic_qualification_type #btnSave').hide();
  $('#frmhrm_academic_qualification_type #btnPrint').hide();
  $('#frmhrm_academic_qualification_type #btnDelete').hide();
  $('#frmhrm_academic_qualification_type #btnApprove').hide();
  $('#frmhrm_academic_qualification_type #btnReject').hide();
  $('#frmhrm_academic_qualification_type #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_academic_qualification_type #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_academic_qualification_type #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_academic_qualification_type #btnNew').show();
 	$('#frmhrm_academic_qualification_type #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_academic_qualification_type #btnSave').show();
 	$('#frmhrm_academic_qualification_type #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_academic_qualification_type #btnDelete').show();
 	$('#frmhrm_academic_qualification_type #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_academic_qualification_type #btnPrint').show();
 	$('#frmhrm_academic_qualification_type #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_academic_qualification_type" ).validate( {
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
  $('#frmhrm_academic_qualification_type #chkAutoManual').click(function(){
    if($('#frmhrm_academic_qualification_type #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_academic_qualification_type #aqt_name').val('');
      $('#frmhrm_academic_qualification_type #aqt_name').prop("readonly",true);
      $('#frmhrm_academic_qualification_type #aqt_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_academic_qualification_type #aqt_name').val('');
      $('#frmhrm_academic_qualification_type #aqt_name').prop("readonly",false);
      $('#frmhrm_academic_qualification_type #aqt_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_type #btnNew").click(function(){  
    $("#frmhrm_academic_qualification_type").get(0).reset();
    $("#frmhrm_academic_qualification_type").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_type #btnList").click(function(){  
    window.location.assign("academicQualificationTypeListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_type #btnPrint").click(function(){  
    if($('#frmhrm_academic_qualification_type #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_academic_qualification_type #cboSearch').val();
      window.location.assign("academicQualificationTypePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_type #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_type #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_academic_qualification_type").valid()){   // test for validity
      if($('#frmhrm_academic_qualification_type #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_academic_qualification_type #cboSearch').val();
      }
      var url = "academicQualificationType-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_academic_qualification_type").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_academic_qualification_type').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_academic_qualification_type #cboSearch').trigger('change');
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
  $("#frmhrm_academic_qualification_type #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_academic_qualification_type #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_academic_qualification_type #cboSearch').val();
    }
    var url = "academicQualificationType-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_academic_qualification_type').get(0).reset();
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
  $("#frmhrm_academic_qualification_type #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_academic_qualification_type #cboSearch").change(function(){  
    $("#frmhrm_academic_qualification_type").validate().resetForm();
    var url = "academicQualificationType-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_academic_qualification_type').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_academic_qualification_type').get(0).reset();
          $('#frmhrm_academic_qualification_type #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_academic_qualification_type #txtName').val(json[0].aqt_name);
            $('#frmhrm_academic_qualification_type #txtRemarks').val(json[0].aqt_remarks);
            $('#frmhrm_academic_qualification_type #cboStatus').val(json[0].aqt_status);
            if(json[0].aqt_is_deleted=='1')
              $('#frmhrm_academic_qualification_type #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_academic_qualification_type #optIsDeleted').prop('checked',false); 
            $('#frmhrm_academic_qualification_type input[name="optIsDeleted"][value="'+json[0].aqt_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_academic_qualification_type #cboCompanyId').val(json[0].aqt_company_id);
            $('#frmhrm_academic_qualification_type #cboCreatedBy').val(json[0].aqt_created_by);
            $('#frmhrm_academic_qualification_type #cboCreatedOn').val(json[0].aqt_created_on);
            $('#frmhrm_academic_qualification_type #cboLastModifiedBy').val(json[0].aqt_last_modified_by);
            $('#frmhrm_academic_qualification_type #cboLastModifiedOn').val(json[0].aqt_last_modified_on);
            $('#frmhrm_academic_qualification_type #cboDeletedBy').val(json[0].aqt_deleted_by);
            $('#frmhrm_academic_qualification_type #cboDeletedOn').val(json[0].aqt_deleted_on);
                      
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
	var url = "academicQualificationType-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_academic_qualification_type #cboSearch').html(httpobj.responseText);
	$('#frmhrm_academic_qualification_type #cboSearch').val($id);
	$('#frmhrm_academic_qualification_type #cboSearch').trigger('change');
}


