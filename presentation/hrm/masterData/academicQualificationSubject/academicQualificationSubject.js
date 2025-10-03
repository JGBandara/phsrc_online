
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
  $('#frmhrm_academic_qualification_subject #btnNew').hide();
  $('#frmhrm_academic_qualification_subject #btnList').hide();
  $('#frmhrm_academic_qualification_subject #btnSave').hide();
  $('#frmhrm_academic_qualification_subject #btnPrint').hide();
  $('#frmhrm_academic_qualification_subject #btnDelete').hide();
  $('#frmhrm_academic_qualification_subject #btnApprove').hide();
  $('#frmhrm_academic_qualification_subject #btnReject').hide();
  $('#frmhrm_academic_qualification_subject #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_academic_qualification_subject #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_academic_qualification_subject #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_academic_qualification_subject #btnNew').show();
 	$('#frmhrm_academic_qualification_subject #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_academic_qualification_subject #btnSave').show();
 	$('#frmhrm_academic_qualification_subject #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_academic_qualification_subject #btnDelete').show();
 	$('#frmhrm_academic_qualification_subject #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_academic_qualification_subject #btnPrint').show();
 	$('#frmhrm_academic_qualification_subject #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_academic_qualification_subject" ).validate( {
      rules: {
        cboQualificationTypeId:"required",
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
  $('#frmhrm_academic_qualification_subject #chkAutoManual').click(function(){
    if($('#frmhrm_academic_qualification_subject #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_academic_qualification_subject #aqb_qualification_type_id').val('');
      $('#frmhrm_academic_qualification_subject #aqb_qualification_type_id').prop("readonly",true);
      $('#frmhrm_academic_qualification_subject #aqb_qualification_type_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_academic_qualification_subject #aqb_qualification_type_id').val('');
      $('#frmhrm_academic_qualification_subject #aqb_qualification_type_id').prop("readonly",false);
      $('#frmhrm_academic_qualification_subject #aqb_qualification_type_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_subject #btnNew").click(function(){  
    $("#frmhrm_academic_qualification_subject").get(0).reset();
    $("#frmhrm_academic_qualification_subject").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_subject #btnList").click(function(){  
    window.location.assign("academicQualificationSubjectListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_subject #btnPrint").click(function(){  
    if($('#frmhrm_academic_qualification_subject #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_academic_qualification_subject #cboSearch').val();
      window.location.assign("academicQualificationSubjectPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_subject #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_academic_qualification_subject #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_academic_qualification_subject").valid()){   // test for validity
      if($('#frmhrm_academic_qualification_subject #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_academic_qualification_subject #cboSearch').val();
      }
      var url = "academicQualificationSubject-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_academic_qualification_subject").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_academic_qualification_subject').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_academic_qualification_subject #cboSearch').trigger('change');
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
  $("#frmhrm_academic_qualification_subject #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_academic_qualification_subject #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_academic_qualification_subject #cboSearch').val();
    }
    var url = "academicQualificationSubject-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_academic_qualification_subject').get(0).reset();
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
  $("#frmhrm_academic_qualification_subject #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_academic_qualification_subject #cboSearch").change(function(){  
    $("#frmhrm_academic_qualification_subject").validate().resetForm();
    var url = "academicQualificationSubject-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_academic_qualification_subject').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_academic_qualification_subject').get(0).reset();
          $('#frmhrm_academic_qualification_subject #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_academic_qualification_subject #cboQualificationTypeId').val(json[0].aqb_qualification_type_id);
            $('#frmhrm_academic_qualification_subject #txtName').val(json[0].aqb_name);
            $('#frmhrm_academic_qualification_subject #txtRemarks').val(json[0].aqb_remarks);
            $('#frmhrm_academic_qualification_subject #cboStatus').val(json[0].aqb_status);
            if(json[0].aqb_is_deleted=='1')
              $('#frmhrm_academic_qualification_subject #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_academic_qualification_subject #optIsDeleted').prop('checked',false); 
            $('#frmhrm_academic_qualification_subject input[name="optIsDeleted"][value="'+json[0].aqb_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_academic_qualification_subject #cboCompanyId').val(json[0].aqb_company_id);
            $('#frmhrm_academic_qualification_subject #cboCreatedBy').val(json[0].aqb_created_by);
            $('#frmhrm_academic_qualification_subject #cboCreatedOn').val(json[0].aqb_created_on);
            $('#frmhrm_academic_qualification_subject #cboLastModifiedBy').val(json[0].aqb_last_modified_by);
            $('#frmhrm_academic_qualification_subject #cboLastModifiedOn').val(json[0].aqb_last_modified_on);
            $('#frmhrm_academic_qualification_subject #cboDeletedBy').val(json[0].aqb_deleted_by);
            $('#frmhrm_academic_qualification_subject #cboDeletedOn').val(json[0].aqb_deleted_on);
                      
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
	var url = "academicQualificationSubject-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_academic_qualification_subject #cboSearch').html(httpobj.responseText);
	$('#frmhrm_academic_qualification_subject #cboSearch').val($id);
	$('#frmhrm_academic_qualification_subject #cboSearch').trigger('change');
}


