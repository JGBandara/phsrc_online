
$( document ).ready( function () {

  $('#frmsys_consultation #btnNew').hide();
  $('#frmsys_consultation #btnList').hide();
  $('#frmsys_consultation #btnSave').hide();
  $('#frmsys_consultation #btnPrint').hide();
  $('#frmsys_consultation #btnDelete').hide();
  $('#frmsys_consultation #btnApprove').hide();
  $('#frmsys_consultation #btnReject').hide();
  $('#frmsys_consultation #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_consultation #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_consultation #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_consultation #btnNew').show();
 	$('#frmsys_consultation #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_consultation #btnSave').show();
 	$('#frmsys_consultation #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_consultation #btnDelete').show();
 	$('#frmsys_consultation #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_consultation #btnPrint').show();
 	$('#frmsys_consultation #cboSearch').prop('disabled', false);
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
  $( "#frmsys_consultation" ).validate( {
      rules: {
        txtCode: {
                  required: true,
                  maxlength: 10
                },
        txtName: {
                  required: true,
                  maxlength: 50
                },
        txtDescription: {
                  maxlength: 250
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
  $('#frmsys_consultation #chkAutoManual').click(function(){
    if($('#frmsys_consultation #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_consultation #dc_code').val('');
      $('#frmsys_consultation #dc_code').prop("readonly",true);
      $('#frmsys_consultation #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_consultation #dc_code').val('');
      $('#frmsys_consultation #dc_code').prop("readonly",false);
      $('#frmsys_consultation #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_consultation #btnNew").click(function(){  
    $("#frmsys_consultation").get(0).reset();
    $("#frmsys_consultation").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_consultation #btnList").click(function(){  
    window.location.assign("channelConsultationListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_consultation #btnPrint").click(function(){  
    if($('#frmsys_consultation #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_consultation #cboSearch').val();
      window.location.assign("channelConsultationPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_consultation #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_consultation #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_consultation").valid()){   
  var cboVal = $('#frmsys_consultation #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "channelConsultation-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_consultation").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_consultation').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_consultation #cboSearch').trigger('change');
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
  $("#frmsys_consultation #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_consultation #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_consultation #cboSearch').val();

    }
    var url = "channelConsultation-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_consultation').get(0).reset();
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
  $("#frmsys_consultation #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_consultation #cboSearch").change(function(){  
    $("#frmsys_consultation").validate().resetForm();
    id = $('#frmsys_consultation #cboSearch').val();
    var url = "channelConsultation-db-get.php";
    if($('#frmsys_consultation #cboSearch').val()==''){
        $('#frmsys_consultation').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
        $('#frmsys_consultation #txtCode').val(json.chn_code);
        $('#frmsys_consultation #txtName').val(json.chn_name);
        $('#frmsys_consultation #txtNo').val(json.chn_no);
        $('#frmsys_consultation #txtDescription').val(json.chn_description);
        $('#frmsys_consultation #cboStatus').val(json.chn_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "channelConsultation-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_consultation #cboSearch').html(httpobj.responseText);
	$('#frmsys_consultation #cboSearch').val($id);
	$('#frmsys_consultation #cboSearch').trigger('change');
}


