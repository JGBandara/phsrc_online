
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-11
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmdms_file_category #btnNew').hide();
  $('#frmdms_file_category #btnList').hide();
  $('#frmdms_file_category #btnSave').hide();
  $('#frmdms_file_category #btnPrint').hide();
  $('#frmdms_file_category #btnDelete').hide();
  $('#frmdms_file_category #btnApprove').hide();
  $('#frmdms_file_category #btnReject').hide();
  $('#frmdms_file_category #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmdms_file_category #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmdms_file_category #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmdms_file_category #btnNew').show();
 	$('#frmdms_file_category #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmdms_file_category #btnSave').show();
 	$('#frmdms_file_category #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmdms_file_category #btnDelete').show();
 	$('#frmdms_file_category #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmdms_file_category #btnPrint').show();
 	$('#frmdms_file_category #cboSearch').prop('disabled', false);
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
  $( "#frmdms_file_category" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtCode: {
                  required: true,
                  maxlength: 8
                },
        cboFileGroupId:"required",
        txtUrl: {
                  required: true,
                  maxlength: 128
                },
        txtPrefixFormat: {
                  required: true,
                  maxlength: 256
                },
        txtMetaData: {
                  required: true,
                  maxlength: 256
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
  $('#frmdms_file_category #chkAutoManual').click(function(){
    if($('#frmdms_file_category #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmdms_file_category #dfc_name').val('');
      $('#frmdms_file_category #dfc_name').prop("readonly",true);
      $('#frmdms_file_category #dfc_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmdms_file_category #dfc_name').val('');
      $('#frmdms_file_category #dfc_name').prop("readonly",false);
      $('#frmdms_file_category #dfc_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmdms_file_category #btnNew").click(function(){  
    $("#frmdms_file_category").get(0).reset();
    $("#frmdms_file_category").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmdms_file_category #btnList").click(function(){  
    window.location.assign("fileCategoryListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmdms_file_category #btnPrint").click(function(){  
    if($('#frmdms_file_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_file_category #cboSearch').val();
      window.location.assign("fileCategoryPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmdms_file_category #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmdms_file_category #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmdms_file_category").valid()){   // test for validity
      if($('#frmdms_file_category #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmdms_file_category #cboSearch').val();
      }
      var url = "fileCategory-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmdms_file_category").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmdms_file_category').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmdms_file_category #cboSearch').trigger('change');
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
  $("#frmdms_file_category #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmdms_file_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_file_category #cboSearch').val();
    }
    var url = "fileCategory-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmdms_file_category').get(0).reset();
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
  $("#frmdms_file_category #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmdms_file_category #cboSearch").change(function(){  
    $("#frmdms_file_category").validate().resetForm();
    var url = "fileCategory-db-get.php";
    if($(this).val()==''){
        $('#frmdms_file_category').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmdms_file_category').get(0).reset();
          $('#frmdms_file_category #cboSearch').val($id);
          if(json){ 
            $('#frmdms_file_category #txtName').val(json[0].dfc_name);
            $('#frmdms_file_category #txtCode').val(json[0].dfc_code);
            $('#frmdms_file_category #cboFileGroupId').val(json[0].dfc_file_group_id);
            $('#frmdms_file_category #txtUrl').val(json[0].dfc_url);
            $('#frmdms_file_category #txtPrefixFormat').val(json[0].dfc_prefix_format);
            $('#frmdms_file_category #txtMetaData').val(json[0].dfc_meta_data);
            if(json[0].dfc_is_related_to_system=='1')
              $('#frmdms_file_category #optIsRelatedToSystem').prop('checked',true);
            else
              $('#frmdms_file_category #optIsRelatedToSystem').prop('checked',false); 
            $('#frmdms_file_category input[name="optIsRelatedToSystem"][value="'+json[0].dfc_is_related_to_system+'"]').prop('checked', true);

            $('#frmdms_file_category #txtRemarks').val(json[0].dfc_remarks);
            $('#frmdms_file_category #cboStatus').val(json[0].dfc_status);
            if(json[0].dfc_is_deleted=='1')
              $('#frmdms_file_category #optIsDeleted').prop('checked',true);
            else
              $('#frmdms_file_category #optIsDeleted').prop('checked',false); 
            $('#frmdms_file_category input[name="optIsDeleted"][value="'+json[0].dfc_is_deleted+'"]').prop('checked', true);

            $('#frmdms_file_category #cboCompanyId').val(json[0].dfc_company_id);
            $('#frmdms_file_category #cboCreatedBy').val(json[0].dfc_created_by);
            $('#frmdms_file_category #cboCreatedOn').val(json[0].dfc_created_on);
            $('#frmdms_file_category #cboLastModifiedBy').val(json[0].dfc_last_modified_by);
            $('#frmdms_file_category #cboLastModifiedOn').val(json[0].dfc_last_modified_on);
            $('#frmdms_file_category #cboDeletedBy').val(json[0].dfc_deleted_by);
            $('#frmdms_file_category #cboDeletedOn').val(json[0].dfc_deleted_on);
                      
          }
        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);
  // =================================
  // Tip Display Show/Hide
  // ---------------------------------
  // Tip Display Hide
  $('#frmdms_file_category .divTipHeader').each(function(){
    $(this).bind("click", function(){
      $('.divTip', $(this)).toggleClass('tipHide');
    });
  });

});// Document Ready End

function loadSearchCombo($id){
	var url = "fileCategory-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmdms_file_category #cboSearch').html(httpobj.responseText);
	$('#frmdms_file_category #cboSearch').val($id);
	$('#frmdms_file_category #cboSearch').trigger('change');
}


