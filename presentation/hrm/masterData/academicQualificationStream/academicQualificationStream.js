
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
  $('#frmhrm_academic_qualification_stream #btnNew').hide();
  $('#frmhrm_academic_qualification_stream #btnList').hide();
  $('#frmhrm_academic_qualification_stream #btnSave').hide();
  $('#frmhrm_academic_qualification_stream #btnPrint').hide();
  $('#frmhrm_academic_qualification_stream #btnDelete').hide();
  $('#frmhrm_academic_qualification_stream #btnApprove').hide();
  $('#frmhrm_academic_qualification_stream #btnReject').hide();
  $('#frmhrm_academic_qualification_stream #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_academic_qualification_stream #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_academic_qualification_stream #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_academic_qualification_stream #btnNew').show();
 	$('#frmhrm_academic_qualification_stream #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_academic_qualification_stream #btnSave').show();
 	$('#frmhrm_academic_qualification_stream #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_academic_qualification_stream #btnDelete').show();
 	$('#frmhrm_academic_qualification_stream #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_academic_qualification_stream #btnPrint').show();
 	$('#frmhrm_academic_qualification_stream #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_academic_qualification_stream" ).validate( {
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
  $('#frmhrm_academic_qualification_stream #chkAutoManual').click(function(){
    if($('#frmhrm_academic_qualification_stream #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_academic_qualification_stream #aqs_name').val('');
      $('#frmhrm_academic_qualification_stream #aqs_name').prop("readonly",true);
      $('#frmhrm_academic_qualification_stream #aqs_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_academic_qualification_stream #aqs_name').val('');
      $('#frmhrm_academic_qualification_stream #aqs_name').prop("readonly",false);
      $('#frmhrm_academic_qualification_stream #aqs_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_stream #btnNew").click(function(){  
    $("#frmhrm_academic_qualification_stream").get(0).reset();
    $("#frmhrm_academic_qualification_stream").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_stream #btnList").click(function(){  
    window.location.assign("academicQualificationStreamListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_stream #btnPrint").click(function(){  
    if($('#frmhrm_academic_qualification_stream #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_academic_qualification_stream #cboSearch').val();
      window.location.assign("academicQualificationStreamPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_stream #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_stream #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_academic_qualification_stream").valid()){   // test for validity
      if($('#frmhrm_academic_qualification_stream #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_academic_qualification_stream #cboSearch').val();
      }
      var url = "academicQualificationStream-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_academic_qualification_stream").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_academic_qualification_stream').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_academic_qualification_stream #cboSearch').trigger('change');
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
  $("#frmhrm_academic_qualification_stream #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_academic_qualification_stream #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_academic_qualification_stream #cboSearch').val();
    }
    var url = "academicQualificationStream-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_academic_qualification_stream').get(0).reset();
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
  $("#frmhrm_academic_qualification_stream #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_academic_qualification_stream #cboSearch").change(function(){  
    $("#frmhrm_academic_qualification_stream").validate().resetForm();
    var url = "academicQualificationStream-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_academic_qualification_stream').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_academic_qualification_stream').get(0).reset();
          $('#frmhrm_academic_qualification_stream #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_academic_qualification_stream #txtName').val(json[0].aqs_name);
            $('#frmhrm_academic_qualification_stream #txtRemarks').val(json[0].aqs_remarks);
            $('#frmhrm_academic_qualification_stream #cboStatus').val(json[0].aqs_status);
            if(json[0].aqs_is_deleted=='1')
              $('#frmhrm_academic_qualification_stream #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_academic_qualification_stream #optIsDeleted').prop('checked',false); 
            $('#frmhrm_academic_qualification_stream input[name="optIsDeleted"][value="'+json[0].aqs_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_academic_qualification_stream #cboCompanyId').val(json[0].aqs_company_id);
            $('#frmhrm_academic_qualification_stream #cboCreatedBy').val(json[0].aqs_created_by);
            $('#frmhrm_academic_qualification_stream #cboCreatedOn').val(json[0].aqs_created_on);
            $('#frmhrm_academic_qualification_stream #cboLastModifiedBy').val(json[0].aqs_last_modified_by);
            $('#frmhrm_academic_qualification_stream #cboLastModifiedOn').val(json[0].aqs_last_modified_on);
            $('#frmhrm_academic_qualification_stream #cboDeletedBy').val(json[0].aqs_deleted_by);
            $('#frmhrm_academic_qualification_stream #cboDeletedOn').val(json[0].aqs_deleted_on);
                      
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
	var url = "academicQualificationStream-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_academic_qualification_stream #cboSearch').html(httpobj.responseText);
	$('#frmhrm_academic_qualification_stream #cboSearch').val($id);
	$('#frmhrm_academic_qualification_stream #cboSearch').trigger('change');
}


