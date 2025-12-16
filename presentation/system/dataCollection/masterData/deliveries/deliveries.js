
$( document ).ready( function () {

  $('#frmsys_deliveries #btnNew').hide();
  $('#frmsys_deliveries #btnList').hide();
  $('#frmsys_deliveries #btnSave').hide();
  $('#frmsys_deliveries #btnPrint').hide();
  $('#frmsys_deliveries #btnDelete').hide();
  $('#frmsys_deliveries #btnApprove').hide();
  $('#frmsys_deliveries #btnReject').hide();
  $('#frmsys_deliveries #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_deliveries #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_deliveries #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_deliveries #btnNew').show();
 	$('#frmsys_deliveries #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_deliveries #btnSave').show();
 	$('#frmsys_deliveries #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_deliveries #btnDelete').show();
 	$('#frmsys_deliveries #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_deliveries #btnPrint').show();
 	$('#frmsys_deliveries #cboSearch').prop('disabled', false);
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
  $( "#frmsys_deliveries" ).validate( {
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
  $('#frmsys_deliveries #chkAutoManual').click(function(){
    if($('#frmsys_deliveries #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_deliveries #dc_code').val('');
      $('#frmsys_deliveries #dc_code').prop("readonly",true);
      $('#frmsys_deliveries #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_deliveries #dc_code').val('');
      $('#frmsys_deliveries #dc_code').prop("readonly",false);
      $('#frmsys_deliveries #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_deliveries #btnNew").click(function(){  
    $("#frmsys_deliveries").get(0).reset();
    $("#frmsys_deliveries").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_deliveries #btnList").click(function(){  
    window.location.assign("deliveriesListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_deliveries #btnPrint").click(function(){  
    if($('#frmsys_deliveries #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_deliveries #cboSearch').val();
      window.location.assign("deliveriesPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_deliveries #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_deliveries #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_deliveries").valid()){   
  var cboVal = $('#frmsys_deliveries #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "deliveries-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_deliveries").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_deliveries').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_deliveries #cboSearch').trigger('change');
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
  $("#frmsys_deliveries #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_deliveries #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_deliveries #cboSearch').val();

    }
    var url = "deliveries-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_deliveries').get(0).reset();
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
  $("#frmsys_deliveries #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_deliveries #cboSearch").change(function(){  
    $("#frmsys_deliveries").validate().resetForm();
    id = $('#frmsys_deliveries #cboSearch').val();
    var url = "deliveries-db-get.php";
    if($('#frmsys_deliveries #cboSearch').val()==''){
        $('#frmsys_deliveries').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
               $('#frmsys_deliveries #txtCode').val(json.dl_code);
        $('#frmsys_deliveries #txtName').val(json.dl_name);
        $('#frmsys_deliveries #txtDescription').val(json.dl_description);
        $('#frmsys_deliveries #cboStatus').val(json.dl_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "deliveries-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_deliveries #cboSearch').html(httpobj.responseText);
	$('#frmsys_deliveries #cboSearch').val($id);
	$('#frmsys_deliveries #cboSearch').trigger('change');
}


