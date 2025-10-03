
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
  $('#frmsys_alert_type #btnNew').hide();
  $('#frmsys_alert_type #btnList').hide();
  $('#frmsys_alert_type #btnSave').hide();
  $('#frmsys_alert_type #btnPrint').hide();
  $('#frmsys_alert_type #btnDelete').hide();
  $('#frmsys_alert_type #btnApprove').hide();
  $('#frmsys_alert_type #btnReject').hide();
  $('#frmsys_alert_type #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_alert_type #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_alert_type #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_alert_type #btnNew').show();
 	$('#frmsys_alert_type #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_alert_type #btnSave').show();
 	$('#frmsys_alert_type #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_alert_type #btnDelete').show();
 	$('#frmsys_alert_type #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_alert_type #btnPrint').show();
 	$('#frmsys_alert_type #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmsys_alert_type" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 64
                },
        txtViewUrl: {
                    maxlength: 256
                  },
        txtDetailUrl: {
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
  $('#frmsys_alert_type #chkAutoManual').click(function(){
    if($('#frmsys_alert_type #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_alert_type #sat_name').val('');
      $('#frmsys_alert_type #sat_name').prop("readonly",true);
      $('#frmsys_alert_type #sat_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_alert_type #sat_name').val('');
      $('#frmsys_alert_type #sat_name').prop("readonly",false);
      $('#frmsys_alert_type #sat_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_alert_type #btnNew").click(function(){  
    $("#frmsys_alert_type").get(0).reset();
    $("#frmsys_alert_type").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_alert_type #btnList").click(function(){  
    window.location.assign("alertTypeListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_alert_type #btnPrint").click(function(){  
    if($('#frmsys_alert_type #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_alert_type #cboSearch').val();
      window.location.assign("alertTypePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_alert_type #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_alert_type #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_alert_type").valid()){   // test for validity
      if($('#frmsys_alert_type #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_alert_type #cboSearch').val();
      }
      var url = "alertType-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_alert_type").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_alert_type').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_alert_type #cboSearch').trigger('change');
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
  $("#frmsys_alert_type #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_alert_type #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_alert_type #cboSearch').val();
    }
    var url = "alertType-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_alert_type').get(0).reset();
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
  $("#frmsys_alert_type #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_alert_type #cboSearch").change(function(){  
    $("#frmsys_alert_type").validate().resetForm();
    var url = "alertType-db-get.php";
    if($(this).val()==''){
        $('#frmsys_alert_type').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmsys_alert_type').get(0).reset();
          $('#frmsys_alert_type #cboSearch').val($id);
          if(json){ 
            $('#frmsys_alert_type #txtName').val(json[0].sat_name);
            $('#frmsys_alert_type #cboCategoryId').val(json[0].sat_category_id);

            $('#frmsys_alert_type #txtViewUrl').val(json[0].sat_view_url);
            $('#frmsys_alert_type #txtDetailUrl').val(json[0].sat_detail_url);
            $('#frmsys_alert_type #txtDetailQuery').val(json[0].sat_detail_query);
            $('#frmsys_alert_type #txtRemarks').val(json[0].sat_remarks);
            $('#frmsys_alert_type #cboStatus').val(json[0].sat_status);
                      
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
	var url = "alertType-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_alert_type #cboSearch').html(httpobj.responseText);
	$('#frmsys_alert_type #cboSearch').val($id);
	$('#frmsys_alert_type #cboSearch').trigger('change');
}


