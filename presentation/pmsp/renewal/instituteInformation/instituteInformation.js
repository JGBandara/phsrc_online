var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frm_institute_information #btnSave').hide();
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


  // =================================
  // Validation
  // ---------------------------------
  $( "#frm_institute_information" ).validate( {
      rules: {
        cboSearch:"required",
		cboRecKeeping:"required",
		cboLabFacility:"required",
		cboEmgKit:"required",
		cboIfOtherFacility:"required",
		cboOwnership:"required",
		cboPracticing:"required",
        txtSpeciality: {
                  required: true,
                  maxlength: 128
                }, 
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_institute_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
 
   if($('#frm_institute_information #cboSearch').val()==''||$('#frm_institute_information #cboSearch').val()==null){
	 $('#frm_institute_information #btnSave').hide();
	  }else{ 
	  $('#frm_institute_information #btnSave').show();
	  }
	  
	   if(searchId){
		  $('#frm_institute_information #btnSave').show();
		  }
  $("#frm_institute_information #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frm_institute_information").valid()){   // test for validity
      
        requestType = 'edit';	
        id = $('#frm_institute_information #cboSearch').val();
     
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
 
  // =====================================================
  // ===============  Search  combo Content Load =========
  // =====================================================
  $("#frm_institute_information #cboSearch").focus(function(){  
  $('#frm_institute_information #btnSave').show();
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
            
            $('#frm_institute_information #cboRecKeeping').val(json.Rec_keeping);
            $('#frm_institute_information #txtSpecAvailability').val(json.visitingSpeciality);
            $('#frm_institute_information #cboLabFacility').val(json.labFacility);
            $('#frm_institute_information #txtXray').val(json.XRayFacility);
            $('#frm_institute_information #cboEmgKit').val(json.emargancyKit);
            $('#frm_institute_information #cboIfOtherFacility').val(json.otherFacility);
            $('#frm_institute_information #cboOwnership').val(json.owner);
			$('#frm_institute_information #cboPracticing').val(json.pracType);
			$('#frm_institute_information #txtSpeciality').val(json.speciality);
            $('#frm_institute_information #txtDisposalMethod').val(json.disposalMethod);
            $('#frm_institute_information #txtStiMethod').val(json.insDressing);
          }
        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End
//loadSearchCombo(searchId);
function loadSearchCombo($id){
	var url = "instituteInformation-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frm_institute_information #cboSearch').html(httpobj.responseText);
	$('#frm_institute_information #cboSearch').val($id);
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


