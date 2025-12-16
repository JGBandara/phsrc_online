
$( document ).ready( function () {

  $('#frmsys_radiology #btnNew').hide();
  $('#frmsys_radiology #btnList').hide();
  $('#frmsys_radiology #btnSave').hide();
  $('#frmsys_radiology #btnPrint').hide();
  $('#frmsys_radiology #btnDelete').hide();
  $('#frmsys_radiology #btnApprove').hide();
  $('#frmsys_radiology #btnReject').hide();
  $('#frmsys_radiology #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_radiology #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_radiology #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_radiology #btnNew').show();
 	$('#frmsys_radiology #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_radiology #btnSave').show();
 	$('#frmsys_radiology #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_radiology #btnDelete').show();
 	$('#frmsys_radiology #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_radiology #btnPrint').show();
 	$('#frmsys_radiology #cboSearch').prop('disabled', false);
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
  $( "#frmsys_radiology" ).validate( {
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
  $('#frmsys_radiology #chkAutoManual').click(function(){
    if($('#frmsys_radiology #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_radiology #dc_code').val('');
      $('#frmsys_radiology #dc_code').prop("readonly",true);
      $('#frmsys_radiology #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_radiology #dc_code').val('');
      $('#frmsys_radiology #dc_code').prop("readonly",false);
      $('#frmsys_radiology #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_radiology #btnNew").click(function(){  
    $("#frmsys_radiology").get(0).reset();
    $("#frmsys_radiology").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_radiology #btnList").click(function(){  
    window.location.assign("radiologyListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_radiology #btnPrint").click(function(){  
    if($('#frmsys_radiology #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_radiology #cboSearch').val();
      window.location.assign("radiologyPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_radiology #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_radiology #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_radiology").valid()){   
  var cboVal = $('#frmsys_radiology #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "radiology-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_radiology").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_radiology').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_radiology #cboSearch').trigger('change');
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
  $("#frmsys_radiology #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_radiology #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_radiology #cboSearch').val();

    }
    var url = "radiology-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_radiology').get(0).reset();
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
  $("#frmsys_radiology #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_radiology #cboSearch").change(function(){  
    $("#frmsys_radiology").validate().resetForm();
    id = $('#frmsys_radiology #cboSearch').val();
    var url = "radiology-db-get.php";
    if($('#frmsys_radiology #cboSearch').val()==''){
        $('#frmsys_radiology').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
        $('#frmsys_radiology #txtCode').val(json.rd_code);
        $('#frmsys_radiology #txtName').val(json.rd_name);
        $('#frmsys_radiology #txtDescription').val(json.rd_description);
        $('#frmsys_radiology #cboStatus').val(json.rd_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "radiology-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_radiology #cboSearch').html(httpobj.responseText);
	$('#frmsys_radiology #cboSearch').val($id);
	$('#frmsys_radiology #cboSearch').trigger('change');
}


