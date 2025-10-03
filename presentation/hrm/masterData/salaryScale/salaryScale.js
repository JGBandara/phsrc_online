
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_salary_scale #btnNew').hide();
  $('#frmhrm_salary_scale #btnList').hide();
  $('#frmhrm_salary_scale #btnSave').hide();
  $('#frmhrm_salary_scale #btnPrint').hide();
  $('#frmhrm_salary_scale #btnDelete').hide();
  $('#frmhrm_salary_scale #btnApprove').hide();
  $('#frmhrm_salary_scale #btnReject').hide();
  $('#frmhrm_salary_scale #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_salary_scale #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_salary_scale #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_salary_scale #btnNew').show();
 	$('#frmhrm_salary_scale #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_salary_scale #btnSave').show();
 	$('#frmhrm_salary_scale #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_salary_scale #btnDelete').show();
 	$('#frmhrm_salary_scale #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_salary_scale #btnPrint').show();
 	$('#frmhrm_salary_scale #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_salary_scale" ).validate( {
      rules: {
        txtCode: {
                  required: true,
                  maxlength: 8
                },
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
  $('#frmhrm_salary_scale #chkAutoManual').click(function(){
    if($('#frmhrm_salary_scale #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_salary_scale #scl_code').val('');
      $('#frmhrm_salary_scale #scl_code').prop("readonly",true);
      $('#frmhrm_salary_scale #scl_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_salary_scale #scl_code').val('');
      $('#frmhrm_salary_scale #scl_code').prop("readonly",false);
      $('#frmhrm_salary_scale #scl_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_salary_scale #btnNew").click(function(){  
    $("#frmhrm_salary_scale").get(0).reset();
    $("#frmhrm_salary_scale").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_salary_scale #btnList").click(function(){  
    window.location.assign("salaryScaleListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_salary_scale #btnPrint").click(function(){  
    if($('#frmhrm_salary_scale #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_salary_scale #cboSearch').val();
      window.location.assign("salaryScalePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_salary_scale #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_salary_scale #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_salary_scale").valid()){   // test for validity
      if($('#frmhrm_salary_scale #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_salary_scale #cboSearch').val();
      }
      var url = "salaryScale-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_salary_scale").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_salary_scale').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_salary_scale #cboSearch').trigger('change');
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
  $("#frmhrm_salary_scale #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_salary_scale #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_salary_scale #cboSearch').val();
    }
    var url = "salaryScale-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_salary_scale').get(0).reset();
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
  $("#frmhrm_salary_scale #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_salary_scale #cboSearch").change(function(){  
    $("#frmhrm_salary_scale").validate().resetForm();
    var url = "salaryScale-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_salary_scale').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_salary_scale').get(0).reset();
          $('#frmhrm_salary_scale #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_salary_scale #txtCode').val(json[0].scl_code);
            $('#frmhrm_salary_scale #txtName').val(json[0].scl_name);
            $('#frmhrm_salary_scale #txtRemarks').val(json[0].scl_remarks);
            $('#frmhrm_salary_scale #cboStatus').val(json[0].scl_status);
            if(json[0].scl_is_deleted=='1')
              $('#frmhrm_salary_scale #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_salary_scale #optIsDeleted').prop('checked',false); 
            $('#frmhrm_salary_scale input[name="optIsDeleted"][value="'+json[0].scl_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_salary_scale #cboCompanyId').val(json[0].scl_company_id);
            $('#frmhrm_salary_scale #cboCreatedBy').val(json[0].scl_created_by);
            $('#frmhrm_salary_scale #cboCreatedOn').val(json[0].scl_created_on);
            $('#frmhrm_salary_scale #cboLastModifiedBy').val(json[0].scl_last_modified_by);
            $('#frmhrm_salary_scale #cboLastModifiedOn').val(json[0].scl_last_modified_on);
            $('#frmhrm_salary_scale #cboDeletedBy').val(json[0].scl_deleted_by);
            $('#frmhrm_salary_scale #cboDeletedOn').val(json[0].scl_deleted_on);
                      
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
	var url = "salaryScale-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_salary_scale #cboSearch').html(httpobj.responseText);
	$('#frmhrm_salary_scale #cboSearch').val($id);
	$('#frmhrm_salary_scale #cboSearch').trigger('change');
}


