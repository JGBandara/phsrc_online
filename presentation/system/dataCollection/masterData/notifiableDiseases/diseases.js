
$( document ).ready( function () {

  $('#frmsys_diseases #btnNew').hide();
  $('#frmsys_diseases #btnList').hide();
  $('#frmsys_diseases #btnSave').hide();
  $('#frmsys_diseases #btnPrint').hide();
  $('#frmsys_diseases #btnDelete').hide();
  $('#frmsys_diseases #btnApprove').hide();
  $('#frmsys_diseases #btnReject').hide();
  $('#frmsys_diseases #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_diseases #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_diseases #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_diseases #btnNew').show();
 	$('#frmsys_diseases #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_diseases #btnSave').show();
 	$('#frmsys_diseases #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_diseases #btnDelete').show();
 	$('#frmsys_diseases #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_diseases #btnPrint').show();
 	$('#frmsys_diseases #cboSearch').prop('disabled', false);
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
  $( "#frmsys_diseases" ).validate( {
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
  $('#frmsys_diseases #chkAutoManual').click(function(){
    if($('#frmsys_diseases #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_diseases #dc_code').val('');
      $('#frmsys_diseases #dc_code').prop("readonly",true);
      $('#frmsys_diseases #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_diseases #dc_code').val('');
      $('#frmsys_diseases #dc_code').prop("readonly",false);
      $('#frmsys_diseases #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_diseases #btnNew").click(function(){  
    $("#frmsys_diseases").get(0).reset();
    $("#frmsys_diseases").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_diseases #btnList").click(function(){  
    window.location.assign("diseasesListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_diseases #btnPrint").click(function(){  
    if($('#frmsys_diseases #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_diseases #cboSearch').val();
      window.location.assign("diseasesPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_diseases #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_diseases #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_diseases").valid()){   
  var cboVal = $('#frmsys_diseases #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "diseases-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_diseases").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_diseases').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_diseases #cboSearch').trigger('change');
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
  $("#frmsys_diseases #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_diseases #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_diseases #cboSearch').val();

    }
    var url = "diseases-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_diseases').get(0).reset();
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
  $("#frmsys_diseases #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_diseases #cboSearch").change(function(){  
    $("#frmsys_diseases").validate().resetForm();
    id = $('#frmsys_diseases #cboSearch').val();
    var url = "diseases-db-get.php";
    if($('#frmsys_diseases #cboSearch').val()==''){
        $('#frmsys_diseases').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
               $('#frmsys_diseases #txtCode').val(json.dc_code);
        $('#frmsys_diseases #txtName').val(json.dc_name);
        $('#frmsys_diseases #txtDescription').val(json.dc_description);
        $('#frmsys_diseases #cboStatus').val(json.dc_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "diseases-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_diseases #cboSearch').html(httpobj.responseText);
	$('#frmsys_diseases #cboSearch').val($id);
	$('#frmsys_diseases #cboSearch').trigger('change');
}


