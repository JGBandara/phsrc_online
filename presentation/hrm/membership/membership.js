
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
  $('#frmhrm_trn_membership #btnNew').hide();
  $('#frmhrm_trn_membership #btnList').hide();
  $('#frmhrm_trn_membership #btnSave').hide();
  $('#frmhrm_trn_membership #btnPrint').hide();
  $('#frmhrm_trn_membership #btnDelete').hide();
  $('#frmhrm_trn_membership #btnApprove').hide();
  $('#frmhrm_trn_membership #btnReject').hide();
  $('#frmhrm_trn_membership #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_membership #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_membership #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_membership #btnNew').show();
 	$('#frmhrm_trn_membership #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_membership #btnSave').show();
 	$('#frmhrm_trn_membership #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_membership #btnDelete').show();
 	$('#frmhrm_trn_membership #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_membership #btnPrint').show();
 	$('#frmhrm_trn_membership #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_membership" ).validate( {
      rules: {
        cboEmployeeId:"required",
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtType: {
                  required: true,
                  maxlength: 128
                },
        txtCategory: {
                    maxlength: 128
                  },
        dtpDateOfCommencement: {
                  required: true,
                  dateISO: true,
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
  $('#frmhrm_trn_membership #chkAutoManual').click(function(){
    if($('#frmhrm_trn_membership #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_membership #mem_employee_id').val('');
      $('#frmhrm_trn_membership #mem_employee_id').prop("readonly",true);
      $('#frmhrm_trn_membership #mem_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_membership #mem_employee_id').val('');
      $('#frmhrm_trn_membership #mem_employee_id').prop("readonly",false);
      $('#frmhrm_trn_membership #mem_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_membership #btnNew").click(function(){  
    $("#frmhrm_trn_membership").get(0).reset();
    $("#frmhrm_trn_membership").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_membership #btnList").click(function(){  
    window.location.assign("membershipListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_membership #btnPrint").click(function(){  
    if($('#frmhrm_trn_membership #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_membership #cboSearch').val();
      window.location.assign("membershipPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_membership #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_membership #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_membership").valid()){   // test for validity
      if($('#frmhrm_trn_membership #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_membership #cboSearch').val();
      }
      var url = "membership-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_trn_membership").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_membership').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_membership #cboSearch').trigger('change');
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
  $("#frmhrm_trn_membership #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_membership #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_membership #cboSearch').val();
    }
    var url = "membership-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_membership').get(0).reset();
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
  $("#frmhrm_trn_membership #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_membership #cboSearch").change(function(){  
    $("#frmhrm_trn_membership").validate().resetForm();
    var url = "membership-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_membership').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_membership').get(0).reset();
          $('#frmhrm_trn_membership #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_trn_membership #cboEmployeeId').val(json[0].mem_employee_id);
            $('#frmhrm_trn_membership #txtName').val(json[0].mem_name);
            $('#frmhrm_trn_membership #txtType').val(json[0].mem_type);
            $('#frmhrm_trn_membership #txtCategory').val(json[0].mem_category);
            $('#frmhrm_trn_membership #dtpDateOfCommencement').val(json[0].mem_date_of_commencement);
            $('#frmhrm_trn_membership #dtpRenewalDate').val(json[0].mem_renewal_date);
            $('#frmhrm_trn_membership #txtRemarks').val(json[0].mem_remarks);
            $('#frmhrm_trn_membership #cboStatus').val(json[0].mem_status);
            if(json[0].mem_is_deleted=='1')
              $('#frmhrm_trn_membership #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_trn_membership #optIsDeleted').prop('checked',false); 
            $('#frmhrm_trn_membership input[name="optIsDeleted"][value="'+json[0].mem_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_trn_membership #cboCompanyId').val(json[0].mem_company_id);
            $('#frmhrm_trn_membership #cboCreatedBy').val(json[0].mem_created_by);
            $('#frmhrm_trn_membership #cboCreatedOn').val(json[0].mem_created_on);
            $('#frmhrm_trn_membership #cboLastModifiedBy').val(json[0].mem_last_modified_by);
            $('#frmhrm_trn_membership #cboLastModifiedOn').val(json[0].mem_last_modified_on);
            $('#frmhrm_trn_membership #cboDeletedBy').val(json[0].mem_deleted_by);
            $('#frmhrm_trn_membership #cboDeletedOn').val(json[0].mem_deleted_on);
                      
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
	var url = "membership-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_membership #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_membership #cboSearch').val($id);
	$('#frmhrm_trn_membership #cboSearch').trigger('change');
}


