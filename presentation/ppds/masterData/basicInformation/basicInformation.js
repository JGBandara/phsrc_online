
var anStatus = "Auto";
$( document ).ready( function () {
	
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frm_basic_information #btnNew').hide();
  $('#frm_basic_information #btnSave').hide();
  $('#frm_basic_information #btnDelete').hide();
  $('#frm_basic_information #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frm_basic_information #cboSearch').prop('disabled', false);
  }

  if(intAddx){ // Insert New Permission
 	$('#frm_basic_information #btnNew').show();
 	$('#frm_basic_information #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frm_basic_information #btnSave').show();
 	$('#frm_basic_information #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frm_basic_information #btnDelete').show();
 	$('#frm_basic_information #cboSearch').prop('disabled', false);
  }

  
  // =================================
  // Validation
  // ---------------------------------
  $( "#frm_basic_information" ).validate( {
     rules: {
        txtName: {
                  required: true,
                  maxlength: 200
                },
      txtRelIns: {
                  required: true,
                  maxlength: 50
                },
      txtAddress: {
                  maxlength: 200
                },
	 txtOfficeAddress:{
				  required: true,
                  maxlength: 200
		 },
      txtInsName: {
		  		  required: true,
                  maxlength: 50
                },
        txtInsAddress: {
                  required: true,
                  maxlength: 200
                },
                txtMobile:{required: true,
                  maxlength: 10,
                  minlength: 10
                  },
        cboProvince: {
                  required: true,
                },
        cboDistrict: {
                 required: true,
                },
        txtEmail:{
            required: true,
        }
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );

  // --------------------------------------------------------
  
  // --------------------------------------------------------
  $("#frm_basic_information #btnNew").click(function(){  
   
    $("#frm_basic_information").get(0).reset();
    $("#frm_basic_information").validate().resetForm();
  });
  // --------------------------------------------------------

  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_basic_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frm_basic_information #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frm_basic_information").valid()){   // test for validity
      if($('#frm_basic_information #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frm_basic_information #cboSearch').val();
      }
      event.preventDefault();
      var form = $('#frm_basic_information');
      var frmData = false;
      if (window.FormData){
          frmData = new FormData(form[0]);
      }

      frmData.append('requestType',requestType);
      frmData.append('cboSearch',id);
      frmData.append('anStatus',anStatus);
      var url = "basicInformation-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			cache:false,
        	contentType:false,
        	processData:false,
			async:false,
			data:frmData?frmData:form.serialize(),
			type:'post', 
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frm_basic_information').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frm_basic_information #cboSearch').trigger('change');
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
  $("#frm_basic_information #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frm_basic_information #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frm_basic_information #cboSearch').val();
    }
    var url = "basicInformation-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frm_basic_information').get(0).reset();
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
  $("#frm_basic_information #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frm_basic_information #cboSearch").change(function(){  
    $("#frm_basic_information").validate().resetForm();
    var url = "basicInformation-db-get.php";
    if($(this).val()==''){
        $('#frm_basic_information').get(0).reset();
        $('#frm_basic_information .avatar-pic').attr('src',backwardSeparator+'img/profile/avatar.jpg'); 
        return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frm_basic_information').get(0).reset();
          $("#frm_basic_information #cboSearch").val($id);
          if(json){ 
             $('#frm_basic_information #txtName').val(json.ownerName);
              $('#frm_basic_information #txtRelIns').val(json.relationsip);
			  $('#frm_basic_information #txtOfficeAddress').val(json.officeAddress);
              $('#frm_basic_information #txtAddress').val(json.owAddress);
              $('#frm_basic_information #txtInsName').val(json.insName);
              $('#frm_basic_information #txtInsAddress').val(json.insAddress);
			  $('#frm_basic_information #txtTelephone').val(json.telephone);
                          $('#frm_basic_information #txtMobile').val(json.mobile);
			  $('#frm_basic_information #txtEmail').val(json.email);
			  $('#frm_basic_information #txtWebsite').val(json.website);
              $('#frm_basic_information #cboProvince').val(json.province);
              $('#frm_basic_information #cboDistrict').val(json.district);
              var imageName=json.profileImageName;
              //alert(json.profileImageName)
			   $('#frm_basic_information .avatar1-pic').attr('src',backwardSeparator+'drive/insProfile/'+imageName);
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
	
	var url = "basicInformation-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frm_basic_information #cboSearch').html(httpobj.responseText);
	$('#frm_basic_information #cboSearch').val($id);
	$('#frm_basic_information #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


