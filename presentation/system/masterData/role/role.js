
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_roles #btnNew').hide();
  $('#frmsys_roles #btnList').hide();
  $('#frmsys_roles #btnSave').hide();
  $('#frmsys_roles #btnPrint').hide();
  $('#frmsys_roles #btnDelete').hide();
  $('#frmsys_roles #btnApprove').hide();
  $('#frmsys_roles #btnReject').hide();
  $('#frmsys_roles #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_roles #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_roles #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_roles #btnNew').show();
 	$('#frmsys_roles #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_roles #btnSave').show();
 	$('#frmsys_roles #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_roles #btnDelete').show();
 	$('#frmsys_roles #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_roles #btnPrint').show();
 	$('#frmsys_roles #cboSearch').prop('disabled', false);
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
  $( "#frmsys_roles" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtRemarks: {
                  maxlength: 255
                },
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmsys_roles #chkAutoManual').click(function(){
    if($('#frmsys_roles #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_roles #syr_name').val('');
      $('#frmsys_roles #syr_name').prop("readonly",true);
      $('#frmsys_roles #syr_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_roles #syr_name').val('');
      $('#frmsys_roles #syr_name').prop("readonly",false);
      $('#frmsys_roles #syr_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_roles #btnNew").click(function(){  
    $("#frmsys_roles").get(0).reset();
    $("#frmsys_roles").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_roles #btnList").click(function(){  
    window.location.assign("roleListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_roles #btnPrint").click(function(){  
    if($('#frmsys_roles #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_roles #cboSearch').val();
      window.location.assign("rolePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_roles #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_roles #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_roles").valid()){   // test for validity
      if($('#frmsys_roles #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_roles #cboSearch').val();
      }
      var url = "role-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_roles").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_roles').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_roles #cboSearch').trigger('change');
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
  $("#frmsys_roles #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_roles #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_roles #cboSearch').val();
    }
    var url = "role-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_roles').get(0).reset();
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
  $("#frmsys_roles #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_roles #cboSearch").change(function(){  
    $("#frmsys_roles").validate().resetForm();
    var url = "role-db-get.php";
    if($('#frmsys_roles #cboSearch').val()==''){
        $('#frmsys_roles').get(0).reset();return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$(this).val(),
        async:false,
        success:function(json){
        //jQuery.each($menuList, function($m, $menu) {
        //});
        $('#frmsys_roles #txtName').val(json[0].syr_name);
                $('#frmsys_roles #txtRemarks').val(json[0].syr_remarks);
                $('#frmsys_roles #cboStatus').val(json[0].syr_status);
                if(json[0].syr_is_deleted=='1')
                  $('#frmsys_roles #optIsDeleted').prop('checked',true);
                else
                  $('#frmsys_roles #optIsDeleted').prop('checked',false); 
                $('#frmsys_roles input[name="optIsDeleted"][value="'+json[0].syr_is_deleted+'"]').prop('checked', true);

                $('#frmsys_roles #cboCompanyId').val(json[0].syr_company_id);
                $('#frmsys_roles #cboCreatedBy').val(json[0].syr_created_by);
                $('#frmsys_roles #cboCreatedOn').val(json[0].syr_created_on);
                $('#frmsys_roles #cboLastModifiedBy').val(json[0].syr_last_modified_by);
                $('#frmsys_roles #cboLastModifiedOn').val(json[0].syr_last_modified_on);
                $('#frmsys_roles #cboDeletedBy').val(json[0].syr_deleted_by);
                $('#frmsys_roles #cboDeletedOn').val(json[0].syr_deleted_on);
                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "role-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_roles #cboSearch').html(httpobj.responseText);
	$('#frmsys_roles #cboSearch').val($id);
	$('#frmsys_roles #cboSearch').trigger('change');
}


