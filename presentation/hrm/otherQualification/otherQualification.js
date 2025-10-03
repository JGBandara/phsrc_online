
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
  $('#frmhrm_trn_other_qualification #btnNew').hide();
  $('#frmhrm_trn_other_qualification #btnList').hide();
  $('#frmhrm_trn_other_qualification #btnSave').hide();
  $('#frmhrm_trn_other_qualification #btnPrint').hide();
  $('#frmhrm_trn_other_qualification #btnDelete').hide();
  $('#frmhrm_trn_other_qualification #btnApprove').hide();
  $('#frmhrm_trn_other_qualification #btnReject').hide();
  $('#frmhrm_trn_other_qualification #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_other_qualification #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_other_qualification #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_other_qualification #btnNew').show();
 	$('#frmhrm_trn_other_qualification #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_other_qualification #btnSave').show();
 	$('#frmhrm_trn_other_qualification #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_other_qualification #btnDelete').show();
 	$('#frmhrm_trn_other_qualification #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_other_qualification #btnPrint').show();
 	$('#frmhrm_trn_other_qualification #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_other_qualification" ).validate( {
      rules: {
        cboEmployeeId:"required",
        cboQualificationCategoryId:"required",
        cboQualificationTypeId:"required",
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtStream: {
                    maxlength: 128
                  },
        txtInstitute: {
                    maxlength: 128
                  },
        txtQualificationStatus: {
                    maxlength: 16
                  },
        txtYear: {
                  required: true,
                  maxlength: 4
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
  $('#frmhrm_trn_other_qualification #chkAutoManual').click(function(){
    if($('#frmhrm_trn_other_qualification #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_other_qualification #eoq_employee_id').val('');
      $('#frmhrm_trn_other_qualification #eoq_employee_id').prop("readonly",true);
      $('#frmhrm_trn_other_qualification #eoq_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_other_qualification #eoq_employee_id').val('');
      $('#frmhrm_trn_other_qualification #eoq_employee_id').prop("readonly",false);
      $('#frmhrm_trn_other_qualification #eoq_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_other_qualification #btnNew").click(function(){  
    $("#frmhrm_trn_other_qualification").get(0).reset();
    $("#frmhrm_trn_other_qualification").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_other_qualification #btnList").click(function(){  
    window.location.assign("otherQualificationListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_other_qualification #btnPrint").click(function(){  
    if($('#frmhrm_trn_other_qualification #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_other_qualification #cboSearch').val();
      window.location.assign("otherQualificationPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_other_qualification #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_other_qualification #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_other_qualification").valid()){   // test for validity
      if($('#frmhrm_trn_other_qualification #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_other_qualification #cboSearch').val();
      }
      var url = "otherQualification-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_trn_other_qualification").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_other_qualification').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_other_qualification #cboSearch').trigger('change');
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
  $("#frmhrm_trn_other_qualification #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_other_qualification #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_other_qualification #cboSearch').val();
    }
    var url = "otherQualification-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_other_qualification').get(0).reset();
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
  $("#frmhrm_trn_other_qualification #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_other_qualification #cboSearch").change(function(){  
    $("#frmhrm_trn_other_qualification").validate().resetForm();
    var url = "otherQualification-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_other_qualification').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_other_qualification').get(0).reset();
          $('#frmhrm_trn_other_qualification #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_trn_other_qualification #cboEmployeeId').val(json[0].eoq_employee_id);
            $('#frmhrm_trn_other_qualification #cboQualificationCategoryId').val(json[0].eoq_qualification_category_id);
            $('#frmhrm_trn_other_qualification #cboQualificationTypeId').val(json[0].eoq_qualification_type_id);
            $('#frmhrm_trn_other_qualification #txtName').val(json[0].eoq_name);
            $('#frmhrm_trn_other_qualification #txtStream').val(json[0].eoq_stream);
            $('#frmhrm_trn_other_qualification #txtInstitute').val(json[0].eoq_institute);
            $('#frmhrm_trn_other_qualification #txtQualificationStatus').val(json[0].eoq_qualification_status);
            $('#frmhrm_trn_other_qualification #txtYear').val(json[0].eoq_year);
            $('#frmhrm_trn_other_qualification #txtRemarks').val(json[0].eoq_remarks);
            $('#frmhrm_trn_other_qualification #cboStatus').val(json[0].eoq_status);
            if(json[0].eoq_is_deleted=='1')
              $('#frmhrm_trn_other_qualification #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_trn_other_qualification #optIsDeleted').prop('checked',false); 
            $('#frmhrm_trn_other_qualification input[name="optIsDeleted"][value="'+json[0].eoq_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_trn_other_qualification #cboCompanyId').val(json[0].eoq_company_id);
            $('#frmhrm_trn_other_qualification #cboCreatedBy').val(json[0].eoq_created_by);
            $('#frmhrm_trn_other_qualification #cboCreatedOn').val(json[0].eoq_created_on);
            $('#frmhrm_trn_other_qualification #cboLastModifiedBy').val(json[0].eoq_last_modified_by);
            $('#frmhrm_trn_other_qualification #cboLastModifiedOn').val(json[0].eoq_last_modified_on);
            $('#frmhrm_trn_other_qualification #cboDeletedBy').val(json[0].eoq_deleted_by);
            $('#frmhrm_trn_other_qualification #cboDeletedOn').val(json[0].eoq_deleted_on);
                      
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
	var url = "otherQualification-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_other_qualification #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_other_qualification #cboSearch').val($id);
	$('#frmhrm_trn_other_qualification #cboSearch').trigger('change');
}


