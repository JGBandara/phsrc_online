
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
  $('#frmhrm_duty #btnNew').hide();
  $('#frmhrm_duty #btnList').hide();
  $('#frmhrm_duty #btnSave').hide();
  $('#frmhrm_duty #btnPrint').hide();
  $('#frmhrm_duty #btnDelete').hide();
  $('#frmhrm_duty #btnApprove').hide();
  $('#frmhrm_duty #btnReject').hide();
  $('#frmhrm_duty #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_duty #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_duty #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_duty #btnNew').show();
 	$('#frmhrm_duty #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_duty #btnSave').show();
 	$('#frmhrm_duty #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_duty #btnDelete').show();
 	$('#frmhrm_duty #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_duty #btnPrint').show();
 	$('#frmhrm_duty #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_duty" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtRemarks: {
                    maxlength: 256
                  },
        cboStatus:"required",
        cboLocationId:"required",
        cboCompanyId:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmhrm_duty #chkAutoManual').click(function(){
    if($('#frmhrm_duty #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_duty #dty_name').val('');
      $('#frmhrm_duty #dty_name').prop("readonly",true);
      $('#frmhrm_duty #dty_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_duty #dty_name').val('');
      $('#frmhrm_duty #dty_name').prop("readonly",false);
      $('#frmhrm_duty #dty_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_duty #btnNew").click(function(){  
    $("#frmhrm_duty").get(0).reset();
    $("#frmhrm_duty").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_duty #btnList").click(function(){  
    window.location.assign("dutyListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_duty #btnPrint").click(function(){  
    if($('#frmhrm_duty #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_duty #cboSearch').val();
      window.location.assign("dutyPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_duty #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_duty #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_duty").valid()){   // test for validity
      if($('#frmhrm_duty #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_duty #cboSearch').val();
      }
      var url = "duty-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_duty").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_duty').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_duty #cboSearch').trigger('change');
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
  $("#frmhrm_duty #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_duty #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_duty #cboSearch').val();
    }
    var url = "duty-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_duty').get(0).reset();
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
  $("#frmhrm_duty #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_duty #cboSearch").change(function(){  
    $("#frmhrm_duty").validate().resetForm();
    var url = "duty-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_duty').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_duty').get(0).reset();
          $('#frmhrm_duty #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_duty #txtName').val(json[0].dty_name);
            $('#frmhrm_duty #txtRemarks').val(json[0].dty_remarks);
            $('#frmhrm_duty #cboStatus').val(json[0].dty_status);
            if(json[0].dty_is_deleted=='1')
              $('#frmhrm_duty #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_duty #optIsDeleted').prop('checked',false); 
            $('#frmhrm_duty input[name="optIsDeleted"][value="'+json[0].dty_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_duty #cboLocationId').val(json[0].dty_location_id);
            $('#frmhrm_duty #cboCompanyId').val(json[0].dty_company_id);
            $('#frmhrm_duty #cboCreatedBy').val(json[0].dty_created_by);
            $('#frmhrm_duty #cboCreatedOn').val(json[0].dty_created_on);
            $('#frmhrm_duty #cboLastModifiedBy').val(json[0].dty_last_modified_by);
            $('#frmhrm_duty #cboLastModifiedOn').val(json[0].dty_last_modified_on);
            $('#frmhrm_duty #cboDeletedBy').val(json[0].dty_deleted_by);
            $('#frmhrm_duty #cboDeletedOn').val(json[0].dty_deleted_on);
                      
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
	var url = "duty-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_duty #cboSearch').html(httpobj.responseText);
	$('#frmhrm_duty #cboSearch').val($id);
	$('#frmhrm_duty #cboSearch').trigger('change');
}


