var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frm_institute_information #btnNew').hide();
  $('#frm_institute_information #btnList').hide();
  $('#frm_institute_information #btnSave').hide();
  $('#frm_institute_information #btnPrint').hide();
  $('#frm_institute_information #btnDelete').hide();
  $('#frm_institute_information #btnApprove').hide();
  $('#frm_institute_information #btnReject').hide();
  $('#frm_institute_information #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frm_institute_information #cboSearch').prop('disabled', false);
  }
  if(intAddx){ // Insert New Permission
 	$('#frm_institute_information #btnNew').show();
 	$('#frm_institute_information #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frm_institute_information #btnSave').show();
 	$('#frm_institute_information #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frm_institute_information #btnDelete').show();
 	$('#frm_institute_information #cboSearch').prop('disabled', false);
  }

  // =================================
  // Validation
  // ---------------------------------
  $( "#frm_institute_information" ).validate( {
      rules: {
        cboSearch:"required",
        txtEstDate: {
                  required: true,
                 // maxlength: 128
                },
                
        txtBR: {
                  required: true,
                 // maxlength: 128
                },
      
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // ----------------------------------------------------------
  // --------------------------------------------------------
  $("#frm_institute_information #btnNew").click(function(){  
    $("#frm_institute_information").get(0).reset();
    $("#frm_institute_information").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_institute_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frm_institute_information #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frm_institute_information").valid()){   // test for validity
      if($('#frm_institute_information #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frm_institute_information #cboSearch').val();
      }
      var url = "instituteInformation-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frm_institute_information").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frm_institute_information').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frm_institute_information #cboSearch').trigger('change');
                        modalMsgBox("Success", json.msg);
                        location.reload();
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
  $("#frm_institute_information #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frm_institute_information #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frm_institute_information #cboSearch').val();
    }
    var url = "instituteInformation-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frm_institute_information').get(0).reset();
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
  $("#frm_institute_information #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frm_institute_information #cboSearch").change(function(){  
    $("#frm_institute_information").validate().resetForm();
    var url = "instituteInformation-db-get.php";
    if($(this).val()==''){
        $('#frm_institute_information').get(0).reset();return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frm_institute_information').get(0).reset();
          $("#frm_institute_information #cboSearch").val($id);
          if(json){ 
            
            $('#frm_institute_information #txtEstDate').val(json.stDate);
            $('#frm_institute_information #txtBR').val(json.brNo);
            $('#frm_institute_information #txtBOI').val(json.boiReg);
			
			$('#frm_institute_information #txtHrPractice').val(json.ins_practice_hr);
			
			if(json.isFulltime==1)
				$('#frm_institute_information #checkFullTime').prop('checked',true);
				else
				$('#frm_institute_information #checkFullTime').removeAttr('checked');
			
			if(json.isGroup==1)
				$('#frm_institute_information #checkGroup').prop('checked',true);
				else
				$('#frm_institute_information #checkGroup').removeAttr('checked');
				
			if(json.isIndividual==1)
				$('#frm_institute_information #checkIndividual').prop('checked',true);
				else
				$('#frm_institute_information #checkIndividual').removeAttr('checked');	
				
			if(json.isPvtNsHome==1)
				$('#frm_institute_information #checkpvtHsp').prop('checked',true);
				else
				$('#frm_institute_information #checkpvtHsp').removeAttr('checked');	
				
			if(json.isPvtDental==1)
				$('#frm_institute_information #checkDentalPractitioner').prop('checked',true);
				else
				$('#frm_institute_information #checkDentalPractitioner').removeAttr('checked');		
					
				
            $('#frm_institute_information #txtInsOther').val(json.other);
			
			if(json.isComBase==1)
				$('#frm_institute_information #checkRecSystem').prop('checked',true);
				else
				$('#frm_institute_information #checkRecSystem').removeAttr('checked');	
				
				
			if(json.isManual==1)
				$('#frm_institute_information #checkRecKeeping').prop('checked',true);
				else
				$('#frm_institute_information #checkRecKeeping').removeAttr('checked');	
				
				
            $('#frm_institute_information #txtOwnOther').val(json.own_other);
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
	var url = "instituteInformation-db-get.php?requestType=loadSearchCombo&id="+$id;
	var httpobj = $.ajax({url:url,async:false});
	$('#frm_institute_information #cboSearch').html(httpobj.responseText);
	//$('#frm_institute_information #cboSearch').val($id);
	$('#frm_institute_information #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


