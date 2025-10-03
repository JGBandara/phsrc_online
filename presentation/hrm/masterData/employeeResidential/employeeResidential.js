
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_employee_residential #btnNew').hide();
  $('#frmhrm_employee_residential #btnList').hide();
  $('#frmhrm_employee_residential #btnSave').hide();
  $('#frmhrm_employee_residential #btnPrint').hide();
  $('#frmhrm_employee_residential #btnDelete').hide();
  $('#frmhrm_employee_residential #btnApprove').hide();
  $('#frmhrm_employee_residential #btnReject').hide();
  $('#frmhrm_employee_residential #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_employee_residential #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_employee_residential #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_employee_residential #btnNew').show();
 	$('#frmhrm_employee_residential #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_employee_residential #btnSave').show();
 	$('#frmhrm_employee_residential #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_employee_residential #btnDelete').show();
 	$('#frmhrm_employee_residential #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_employee_residential #btnPrint').show();
 	$('#frmhrm_employee_residential #cboSearch').prop('disabled', false);
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
  $( "#frmhrm_employee_residential" ).validate( {
      rules: {
        cboSearch:"required",
        txtPermanentAddress: {
                  required: true,
                  maxlength: 64
                },
        txtPermanentStreet: {
                  required: true,
                  maxlength: 64
                },
        txtPermanentCity: {
                  required: true,
                  maxlength: 64
                },
        txtPermanentPostalCode: {
                    maxlength: 32
                  },
        txtPermanentTelephone: {
                    maxlength: 32,
                    tel: true
                  },
        txtPermanentMobileNo: {
                    maxlength: 32,
                    tel: true
                  },
        txtPermanentEmail: {
                    maxlength: 128,
                    email:true
                  },
        cboPermanentCountryId:"required",
        cboPermanentProvinceId:"required",
        cboPermanentDistrictId:"required",
        txtPermanentElectorate: {
                    maxlength: 128
                  },
        txtCurrentAddress: {
                  required: true,
                  maxlength: 64
                },
        txtCurrentStreet: {
                  required: true,
                  maxlength: 64
                },
        txtCurrentCity: {
                  required: true,
                  maxlength: 64
                },
        txtCurrentPostalCode: {
                    maxlength: 32
                  },
        txtCurrentTelephoneGeneralLine: {
                    maxlength: 32,
                    tel: true
                  },
        txtCurrentTelephoneDirectLine: {
                    maxlength: 32,
                    tel: true
                  },
        txtCurrentMobileNo: {
                    maxlength: 32,
                    tel: true
                  },
        txtCurrentFax: {
                    maxlength: 32,
                    tel: true
                  },
        txtCurrentEmail: {
                    maxlength: 128,
                    email: true
                  },
        cboCurrentCountryId:"required",
        cboCurrentProvinceId:"required",
        cboCurrentDistrictId:"required",
        txtCurrentElectorate: {
                    maxlength: 128
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
  // ----------------------------------------------------------
  //        Active Tab
  // ----------------------------------------------------------
  $('.employee-tab a').each(function(){
    $href = $(this).attr('href');
    $url = $href.split('?')[0];
    $tempPath = backwardSeparator + xprojectPath;
    if($url==$tempPath){
      $(this).addClass('active');
    }
    else{
      $(this).removeClass('active');
    }
  });
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmhrm_employee_residential #chkAutoManual').click(function(){
    if($('#frmhrm_employee_residential #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_employee_residential #emr_permanent_address').val('');
      $('#frmhrm_employee_residential #emr_permanent_address').prop("readonly",true);
      $('#frmhrm_employee_residential #emr_permanent_address').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_employee_residential #emr_permanent_address').val('');
      $('#frmhrm_employee_residential #emr_permanent_address').prop("readonly",false);
      $('#frmhrm_employee_residential #emr_permanent_address').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      Permanent Province
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #cboPermanentCountryId").change(function(){  
	var url = "employeeResidential-db-get.php?requestType=loadPermanentProvinceCombo&id="+$(this).val();
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_residential #cboPermanentProvinceId').html(httpobj.responseText);
  });
  // --------------------------------------------------------
  //      Permanent District
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #cboPermanentProvinceId").change(function(){  
	var url = "employeeResidential-db-get.php?requestType=loadPermanentDistrictCombo&id="+$(this).val();
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_residential #cboPermanentDistrictId').html(httpobj.responseText);
  });
  // --------------------------------------------------------
  //      Permanent DS Division
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #cboPermanentDistrictId").change(function(){  
	var url = "employeeResidential-db-get.php?requestType=loadPermanentDsDivisionCombo&id="+$(this).val();
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_residential #cboPermanentDsDivisionId').html(httpobj.responseText);
  });
  // --------------------------------------------------------
  //      Current Province
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #cboCurrentCountryId").change(function(){  
	var url = "employeeResidential-db-get.php?requestType=loadCurrentProvinceCombo&id="+$(this).val();
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_residential #cboCurrentProvinceId').html(httpobj.responseText);
  });
  // --------------------------------------------------------
  //      Current District
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #cboCurrentProvinceId").change(function(){  
	var url = "employeeResidential-db-get.php?requestType=loadCurrentDistrictCombo&id="+$(this).val();
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_residential #cboCurrentDistrictId').html(httpobj.responseText);
  });
  // --------------------------------------------------------
  //      Current DS Division
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #cboCurrentDistrictId").change(function(){  
	var url = "employeeResidential-db-get.php?requestType=loadCurrentDsDivisionCombo&id="+$(this).val();
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_residential #cboCurrentDsDivisionId').html(httpobj.responseText);
  });

  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #btnNew").click(function(){  
    $("#frmhrm_employee_residential").get(0).reset();
    $("#frmhrm_employee_residential").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #btnList").click(function(){  
    window.location.assign("employeeResidentialListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #btnPrint").click(function(){  
    if($('#frmhrm_employee_residential #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_residential #cboSearch').val();
      window.location.assign("employeeResidentialPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_employee_residential #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_employee_residential").valid()){   // test for validity
      if($('#frmhrm_employee_residential #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_employee_residential #cboSearch').val();
      }
      var url = "employeeResidential-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_employee_residential").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_employee_residential').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_employee_residential #cboSearch').trigger('change');
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
  $("#frmhrm_employee_residential #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_employee_residential #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_residential #cboSearch').val();
    }
    var url = "employeeResidential-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_employee_residential').get(0).reset();
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
  $("#frmhrm_employee_residential #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_employee_residential #cboSearch").change(function(){  
    $("#frmhrm_employee_residential").validate().resetForm();
    var url = "employeeResidential-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_employee_residential').get(0).reset();return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_employee_residential').get(0).reset();
          $("#frmhrm_employee_residential #cboSearch").val($id);
          if(json){
            $('#frmhrm_employee_residential #cboId').val(json[0].emr_id);
            $('#frmhrm_employee_residential #txtPermanentAddress').val(json[0].emr_permanent_address);
            $('#frmhrm_employee_residential #txtPermanentStreet').val(json[0].emr_permanent_street);
            $('#frmhrm_employee_residential #txtPermanentCity').val(json[0].emr_permanent_city);
            $('#frmhrm_employee_residential #txtPermanentPostalCode').val(json[0].emr_permanent_postal_code);
            $('#frmhrm_employee_residential #txtPermanentTelephone').val(json[0].emr_permanent_telephone);
            $('#frmhrm_employee_residential #txtPermanentMobileNo').val(json[0].emr_permanent_mobile_no);
            $('#frmhrm_employee_residential #txtPermanentEmail').val(json[0].emr_permanent_email);
            $('#frmhrm_employee_residential #cboPermanentCountryId').val(json[0].emr_permanent_country_id);
            $('#frmhrm_employee_residential #cboPermanentCountryId').trigger('change');
            $('#frmhrm_employee_residential #cboPermanentProvinceId').val(json[0].emr_permanent_province_id);
            $('#frmhrm_employee_residential #cboPermanentProvinceId').trigger('change');
            $('#frmhrm_employee_residential #cboPermanentDistrictId').val(json[0].emr_permanent_district_id);
            $('#frmhrm_employee_residential #cboPermanentDistrictId').trigger('change');
            $('#frmhrm_employee_residential #cboPermanentDsDivisionId').val(json[0].emr_permanent_ds_division_id);
            $('#frmhrm_employee_residential #txtPermanentElectorate').val(json[0].emr_permanent_electorate);
            $('#frmhrm_employee_residential #txtCurrentAddress').val(json[0].emr_current_address);
            $('#frmhrm_employee_residential #txtCurrentStreet').val(json[0].emr_current_street);
            $('#frmhrm_employee_residential #txtCurrentCity').val(json[0].emr_current_city);
            $('#frmhrm_employee_residential #txtCurrentPostalCode').val(json[0].emr_current_postal_code);
            $('#frmhrm_employee_residential #txtCurrentTelephoneGeneralLine').val(json[0].emr_current_telephone_general_line);
            $('#frmhrm_employee_residential #txtCurrentTelephoneDirectLine').val(json[0].emr_current_telephone_direct_line);
            $('#frmhrm_employee_residential #txtCurrentMobileNo').val(json[0].emr_current_mobile_no);
            $('#frmhrm_employee_residential #txtCurrentFax').val(json[0].emr_current_fax);
            $('#frmhrm_employee_residential #txtCurrentEmail').val(json[0].emr_current_email);
            $('#frmhrm_employee_residential #cboCurrentCountryId').val(json[0].emr_current_country_id);
            $('#frmhrm_employee_residential #cboCurrentCountryId').trigger('change');
            $('#frmhrm_employee_residential #cboCurrentProvinceId').val(json[0].emr_current_province_id);
            $('#frmhrm_employee_residential #cboCurrentProvinceId').trigger('change');
            $('#frmhrm_employee_residential #cboCurrentDistrictId').val(json[0].emr_current_district_id);
            $('#frmhrm_employee_residential #cboCurrentDistrictId').trigger('change');
            $('#frmhrm_employee_residential #cboCurrentDsDivisionId').val(json[0].emr_current_ds_division_id);
            $('#frmhrm_employee_residential #txtCurrentElectorate').val(json[0].emr_current_electorate);
            $('#frmhrm_employee_residential #txtRemarks').val(json[0].emr_remarks);
            $('#frmhrm_employee_residential #cboStatus').val(json[0].emr_status);
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
	var url = "employeeResidential-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_residential #cboSearch').html(httpobj.responseText);
	$('#frmhrm_employee_residential #cboSearch').val($id);
	$('#frmhrm_employee_residential #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


