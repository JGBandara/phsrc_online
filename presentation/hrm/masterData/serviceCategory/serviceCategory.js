
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-19
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_service_category #btnNew').hide();
  $('#frmhrm_service_category #btnList').hide();
  $('#frmhrm_service_category #btnSave').hide();
  $('#frmhrm_service_category #btnPrint').hide();
  $('#frmhrm_service_category #btnDelete').hide();
  $('#frmhrm_service_category #btnApprove').hide();
  $('#frmhrm_service_category #btnReject').hide();
  $('#frmhrm_service_category #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_service_category #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_service_category #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_service_category #btnNew').show();
 	$('#frmhrm_service_category #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_service_category #btnSave').show();
 	$('#frmhrm_service_category #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_service_category #btnDelete').show();
 	$('#frmhrm_service_category #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_service_category #btnPrint').show();
 	$('#frmhrm_service_category #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_service_category" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtCode: {
                  required: true,
                  maxlength: 32
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
  $('#frmhrm_service_category #chkAutoManual').click(function(){
    if($('#frmhrm_service_category #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_service_category #sct_name').val('');
      $('#frmhrm_service_category #sct_name').prop("readonly",true);
      $('#frmhrm_service_category #sct_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_service_category #sct_name').val('');
      $('#frmhrm_service_category #sct_name').prop("readonly",false);
      $('#frmhrm_service_category #sct_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_service_category #btnNew").click(function(){  
    $("#frmhrm_service_category").get(0).reset();
    $("#frmhrm_service_category").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_service_category #btnList").click(function(){  
    window.location.assign("serviceCategoryListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_service_category #btnPrint").click(function(){  
    if($('#frmhrm_service_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_service_category #cboSearch').val();
      window.location.assign("serviceCategoryPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_service_category #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_service_category #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_service_category").valid()){   // test for validity
      if($('#frmhrm_service_category #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_service_category #cboSearch').val();
      }
      var url = "serviceCategory-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_service_category").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_service_category').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_service_category #cboSearch').trigger('change');
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
  $("#frmhrm_service_category #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_service_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_service_category #cboSearch').val();
    }
    var url = "serviceCategory-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_service_category').get(0).reset();
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
  $("#frmhrm_service_category #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_service_category #cboSearch").change(function(){  
    $("#frmhrm_service_category").validate().resetForm();
    var url = "serviceCategory-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_service_category').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_service_category').get(0).reset();
          $('#frmhrm_service_category #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_service_category #txtName').val(json[0].sct_name);
            $('#frmhrm_service_category #txtCode').val(json[0].sct_code);
            $('#frmhrm_service_category #txtRemarks').val(json[0].sct_remarks);
            $('#frmhrm_service_category #cboStatus').val(json[0].sct_status);
            if(json[0].sct_is_deleted=='1')
              $('#frmhrm_service_category #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_service_category #optIsDeleted').prop('checked',false); 
            $('#frmhrm_service_category input[name="optIsDeleted"][value="'+json[0].sct_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_service_category #cboCompanyId').val(json[0].sct_company_id);
            $('#frmhrm_service_category #cboCreatedBy').val(json[0].sct_created_by);
            $('#frmhrm_service_category #cboCreatedOn').val(json[0].sct_created_on);
            $('#frmhrm_service_category #cboLastModifiedBy').val(json[0].sct_last_modified_by);
            $('#frmhrm_service_category #cboLastModifiedOn').val(json[0].sct_last_modified_on);
            $('#frmhrm_service_category #cboDeletedBy').val(json[0].sct_deleted_by);
            $('#frmhrm_service_category #cboDeletedOn').val(json[0].sct_deleted_on);
                      
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
	var url = "serviceCategory-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_service_category #cboSearch').html(httpobj.responseText);
	$('#frmhrm_service_category #cboSearch').val($id);
	$('#frmhrm_service_category #cboSearch').trigger('change');
}


