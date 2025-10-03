
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-15
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_alert_category #btnNew').hide();
  $('#frmsys_alert_category #btnList').hide();
  $('#frmsys_alert_category #btnSave').hide();
  $('#frmsys_alert_category #btnPrint').hide();
  $('#frmsys_alert_category #btnDelete').hide();
  $('#frmsys_alert_category #btnApprove').hide();
  $('#frmsys_alert_category #btnReject').hide();
  $('#frmsys_alert_category #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_alert_category #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_alert_category #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_alert_category #btnNew').show();
 	$('#frmsys_alert_category #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_alert_category #btnSave').show();
 	$('#frmsys_alert_category #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_alert_category #btnDelete').show();
 	$('#frmsys_alert_category #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_alert_category #btnPrint').show();
 	$('#frmsys_alert_category #cboSearch').prop('disabled', false);
  }

    // =================================
  // Color Picker
  // ---------------------------------
  $('#txtCssColor').colorpicker();
  $('#txtCssColor').on('colorpickerChange', function(event) {
    $(this).css('background-color', event.color.toString());
  });
  $('#txtCssBgColor').colorpicker();
  $('#txtCssBgColor').on('colorpickerChange', function(event) {
    $(this).css('background-color', event.color.toString());
  });
    // =================================
  // Validation
  // ---------------------------------
  $( "#frmsys_alert_category" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 32
                },
        txtCssColor: {
                  required: true,
                  maxlength: 16
                },
        txtCssBgColor: {
                  required: true,
                  maxlength: 16
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
  $('#frmsys_alert_category #chkAutoManual').click(function(){
    if($('#frmsys_alert_category #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_alert_category #sac_name').val('');
      $('#frmsys_alert_category #sac_name').prop("readonly",true);
      $('#frmsys_alert_category #sac_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_alert_category #sac_name').val('');
      $('#frmsys_alert_category #sac_name').prop("readonly",false);
      $('#frmsys_alert_category #sac_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_alert_category #btnNew").click(function(){  
    $("#frmsys_alert_category").get(0).reset();
    $("#frmsys_alert_category").validate().resetForm();
    $('#txtCssColor').css('background-color', '#ffffff');
    $('#txtCssBgColor').css('background-color',  '#ffffff');
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_alert_category #btnList").click(function(){  
    window.location.assign("alertCategoryListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_alert_category #btnPrint").click(function(){  
    if($('#frmsys_alert_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_alert_category #cboSearch').val();
      window.location.assign("alertCategoryPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_alert_category #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_alert_category #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_alert_category").valid()){   // test for validity
      if($('#frmsys_alert_category #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_alert_category #cboSearch').val();
      }
      var url = "alertCategory-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_alert_category").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_alert_category').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_alert_category #cboSearch').trigger('change');
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
  $("#frmsys_alert_category #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_alert_category #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_alert_category #cboSearch').val();
    }
    var url = "alertCategory-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_alert_category').get(0).reset();
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
  $("#frmsys_alert_category #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_alert_category #cboSearch").change(function(){  
    $("#frmsys_alert_category").validate().resetForm();
    var url = "alertCategory-db-get.php";
    if($(this).val()==''){
        $('#frmsys_alert_category').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmsys_alert_category').get(0).reset();
          $('#frmsys_alert_category #cboSearch').val($id);
          if(json){ 
            $('#frmsys_alert_category #txtName').val(json[0].sac_name);
            $('#frmsys_alert_category #txtCssColor').val(json[0].sac_css_color);
            $('#frmsys_alert_category #txtCssColor').css('background-color',json[0].sac_css_color);
            $('#frmsys_alert_category #txtCssBgColor').val(json[0].sac_css_bg_color);
            $('#frmsys_alert_category #txtCssBgColor').css('background-color',json[0].sac_css_bg_color);
            $('#frmsys_alert_category #txtRemarks').val(json[0].sac_remarks);
            $('#frmsys_alert_category #cboStatus').val(json[0].sac_status);
            if(json[0].sac_is_deleted=='1')
              $('#frmsys_alert_category #optIsDeleted').prop('checked',true);
            else
              $('#frmsys_alert_category #optIsDeleted').prop('checked',false); 
            $('#frmsys_alert_category input[name="optIsDeleted"][value="'+json[0].sac_is_deleted+'"]').prop('checked', true);

            $('#frmsys_alert_category #cboCompanyId').val(json[0].sac_company_id);
            $('#frmsys_alert_category #cboCreatedBy').val(json[0].sac_created_by);
            $('#frmsys_alert_category #cboCreatedOn').val(json[0].sac_created_on);
            $('#frmsys_alert_category #cboLastModifiedBy').val(json[0].sac_last_modified_by);
            $('#frmsys_alert_category #cboLastModifiedOn').val(json[0].sac_last_modified_on);
            $('#frmsys_alert_category #cboDeletedBy').val(json[0].sac_deleted_by);
            $('#frmsys_alert_category #cboDeletedOn').val(json[0].sac_deleted_on);
                      
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
	var url = "alertCategory-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_alert_category #cboSearch').html(httpobj.responseText);
	$('#frmsys_alert_category #cboSearch').val($id);
	$('#frmsys_alert_category #cboSearch').trigger('change');
}


