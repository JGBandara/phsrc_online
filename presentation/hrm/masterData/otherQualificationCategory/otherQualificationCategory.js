
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
  $('#frmhrm_other_qualification_category #btnNew').hide();
  $('#frmhrm_other_qualification_category #btnList').hide();
  $('#frmhrm_other_qualification_category #btnSave').hide();
  $('#frmhrm_other_qualification_category #btnPrint').hide();
  $('#frmhrm_other_qualification_category #btnDelete').hide();
  $('#frmhrm_other_qualification_category #btnApprove').hide();
  $('#frmhrm_other_qualification_category #btnReject').hide();
  $('#frmhrm_other_qualification_category #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_other_qualification_category #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_other_qualification_category #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_other_qualification_category #btnNew').show();
 	$('#frmhrm_other_qualification_category #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_other_qualification_category #btnSave').show();
 	$('#frmhrm_other_qualification_category #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_other_qualification_category #btnDelete').show();
 	$('#frmhrm_other_qualification_category #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_other_qualification_category #btnPrint').show();
 	$('#frmhrm_other_qualification_category #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_other_qualification_category" ).validate( {
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
  $('#frmhrm_other_qualification_category #chkAutoManual').click(function(){
    if($('#frmhrm_other_qualification_category #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_other_qualification_category #oqc_name').val('');
      $('#frmhrm_other_qualification_category #oqc_name').prop("readonly",true);
      $('#frmhrm_other_qualification_category #oqc_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_other_qualification_category #oqc_name').val('');
      $('#frmhrm_other_qualification_category #oqc_name').prop("readonly",false);
      $('#frmhrm_other_qualification_category #oqc_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_other_qualification_category #btnNew").click(function(){  
    $("#frmhrm_other_qualification_category").get(0).reset();
    $("#frmhrm_other_qualification_category").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_other_qualification_category #btnList").click(function(){  
    window.location.assign("otherQualificationCategoryListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_other_qualification_category #btnPrint").click(function(){  
    if($('#frmhrm_other_qualification_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_other_qualification_category #cboSearch').val();
      window.location.assign("otherQualificationCategoryPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_other_qualification_category #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_other_qualification_category #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_other_qualification_category").valid()){   // test for validity
      if($('#frmhrm_other_qualification_category #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_other_qualification_category #cboSearch').val();
      }
      var url = "otherQualificationCategory-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_other_qualification_category").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_other_qualification_category').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_other_qualification_category #cboSearch').trigger('change');
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
  $("#frmhrm_other_qualification_category #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_other_qualification_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_other_qualification_category #cboSearch').val();
    }
    var url = "otherQualificationCategory-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_other_qualification_category').get(0).reset();
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
  $("#frmhrm_other_qualification_category #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_other_qualification_category #cboSearch").change(function(){  
    $("#frmhrm_other_qualification_category").validate().resetForm();
    var url = "otherQualificationCategory-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_other_qualification_category').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_other_qualification_category').get(0).reset();
          $('#frmhrm_other_qualification_category #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_other_qualification_category #txtName').val(json[0].oqc_name);
            $('#frmhrm_other_qualification_category #txtRemarks').val(json[0].oqc_remarks);
            $('#frmhrm_other_qualification_category #cboStatus').val(json[0].oqc_status);
            if(json[0].oqc_is_deleted=='1')
              $('#frmhrm_other_qualification_category #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_other_qualification_category #optIsDeleted').prop('checked',false); 
            $('#frmhrm_other_qualification_category input[name="optIsDeleted"][value="'+json[0].oqc_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_other_qualification_category #cboCompanyId').val(json[0].oqc_company_id);
            $('#frmhrm_other_qualification_category #cboCreatedBy').val(json[0].oqc_created_by);
            $('#frmhrm_other_qualification_category #cboCreatedOn').val(json[0].oqc_created_on);
            $('#frmhrm_other_qualification_category #cboLastModifiedBy').val(json[0].oqc_last_modified_by);
            $('#frmhrm_other_qualification_category #cboLastModifiedOn').val(json[0].oqc_last_modified_on);
            $('#frmhrm_other_qualification_category #cboDeletedBy').val(json[0].oqc_deleted_by);
            $('#frmhrm_other_qualification_category #cboDeletedOn').val(json[0].oqc_deleted_on);
                      
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
	var url = "otherQualificationCategory-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_other_qualification_category #cboSearch').html(httpobj.responseText);
	$('#frmhrm_other_qualification_category #cboSearch').val($id);
	$('#frmhrm_other_qualification_category #cboSearch').trigger('change');
}


