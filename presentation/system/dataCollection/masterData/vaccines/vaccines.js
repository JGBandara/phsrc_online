
$( document ).ready( function () {

  $('#frmsys_vaccines #btnNew').hide();
  $('#frmsys_vaccines #btnList').hide();
  $('#frmsys_vaccines #btnSave').hide();
  $('#frmsys_vaccines #btnPrint').hide();
  $('#frmsys_vaccines #btnDelete').hide();
  $('#frmsys_vaccines #btnApprove').hide();
  $('#frmsys_vaccines #btnReject').hide();
  $('#frmsys_vaccines #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_vaccines #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_vaccines #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_vaccines #btnNew').show();
 	$('#frmsys_vaccines #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_vaccines #btnSave').show();
 	$('#frmsys_vaccines #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_vaccines #btnDelete').show();
 	$('#frmsys_vaccines #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_vaccines #btnPrint').show();
 	$('#frmsys_vaccines #cboSearch').prop('disabled', false);
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
  $( "#frmsys_vaccines" ).validate( {
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
  $('#frmsys_vaccines #chkAutoManual').click(function(){
    if($('#frmsys_vaccines #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_vaccines #dc_code').val('');
      $('#frmsys_vaccines #dc_code').prop("readonly",true);
      $('#frmsys_vaccines #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_vaccines #dc_code').val('');
      $('#frmsys_vaccines #dc_code').prop("readonly",false);
      $('#frmsys_vaccines #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_vaccines #btnNew").click(function(){  
    $("#frmsys_vaccines").get(0).reset();
    $("#frmsys_vaccines").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_vaccines #btnList").click(function(){  
    window.location.assign("vaccinesListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_vaccines #btnPrint").click(function(){  
    if($('#frmsys_vaccines #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_vaccines #cboSearch').val();
      window.location.assign("vaccinesPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_vaccines #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_vaccines #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_vaccines").valid()){   
  var cboVal = $('#frmsys_vaccines #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "vaccines-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_vaccines").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_vaccines').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_vaccines #cboSearch').trigger('change');
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
  $("#frmsys_vaccines #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_vaccines #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_vaccines #cboSearch').val();

    }
    var url = "vaccines-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_vaccines').get(0).reset();
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
  $("#frmsys_vaccines #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_vaccines #cboSearch").change(function(){  
    $("#frmsys_vaccines").validate().resetForm();
    id = $('#frmsys_vaccines #cboSearch').val();
    var url = "vaccines-db-get.php";
    if($('#frmsys_vaccines #cboSearch').val()==''){
        $('#frmsys_vaccines').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
               $('#frmsys_vaccines #txtCode').val(json.vc_code);
        $('#frmsys_vaccines #txtName').val(json.vc_name);
        $('#frmsys_vaccines #txtDescription').val(json.vc_description);
        $('#frmsys_vaccines #cboStatus').val(json.vc_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "vaccines-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_vaccines #cboSearch').html(httpobj.responseText);
	$('#frmsys_vaccines #cboSearch').val($id);
	$('#frmsys_vaccines #cboSearch').trigger('change');
}


