
var anStatus = "Auto";
function insertRow(tblId)
{
	var txtId = 1;
	var tbl = document.getElementById(tblId);	
	rows = tbl.rows.length;
	tbl.insertRow(rows);
	tbl.rows[rows].className='mainRow';
	tbl.rows[rows].id= tbl.id+"id" + rows;
	tbl.rows[rows].innerHTML = tbl.rows[rows-1].innerHTML;
}

$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frm_staff_information #btnNew').hide();
  $('#frm_staff_information #btnSave').hide();
  $('#frm_staff_information #btnDelete').hide();
  $('#frm_staff_information #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frm_staff_information #cboSearch').prop('disabled', false);
  }

  if(intAddx){ // Insert New Permission
 	$('#frm_staff_information #btnNew').show();
 	$('#frm_staff_information #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frm_staff_information #btnSave').show();
 	$('#frm_staff_information #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frm_staff_information #btnDelete').show();
 	$('#frm_staff_information #cboSearch').prop('disabled', false);
  }


  // =================================
  // Validation
  // ---------------------------------
  $( "#frm_staff_information" ).validate( {
      /*rules: {
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
      }*/
  } );

  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frm_staff_information #btnNew").click(function(){  
    $("#frm_staff_information").get(0).reset();
    $("#frm_staff_information").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_staff_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frm_staff_information #btnSave").click(function(){  

  //---------------tblMainGrid1---------------------------
 		 var txtMedName ='';
		 var txtCategory   ='';
		 var txtPermanent	   ='';
		 var cboType='';
		 
		 value="[ ";
	$('#tblMainGrid1 .mainRow').each(function(){
		
      txtMedName	= $(this).find(".txtMedName").val();		
      txtCategory 		= $(this).find(".txtCategory").val();
	  txtPermanent		= $(this).find(".txtPermanent").val();
	  cboType		= $(this).find(".cboType").val();
		
      value += '{ "txtMedName":"'+txtMedName+'", "txtCategory": "'+txtCategory+'","txtPermanent":"'+txtPermanent+'","cboType":"'+cboType+'"},';
	});
	
	value = value.substr(0,value.length-1);
	value += " ]";
	
	//---------------------------------------------------------
	
	
	//---------------tblMainGrid3---------------------------
	
		 var txtDocName 		='';
		 var txtQualification   ='';
		 var txtBasic	  	    ='';
		 var txtPostGraduate    ='';
		 var txtYear            ='';
		 var txtUniversity      ='';
		 var txtCountry         ='';
		 var txtSlmcNo			='';
		 var txtSlmcDate		=''
		 
		 value2="[ ";
	$('#tblMainGrid3 .mainRow').each(function(){
		
      txtDocName	= $(this).find(".txtDocName").val();		
      txtQualification 		= $(this).find(".txtQualification").val();
	  txtBasic		= $(this).find(".txtBasic").val();
	  txtPostGraduate		= $(this).find(".txtPostGraduate").val();
	  txtYear		= $(this).find(".txtYear").val();
	  txtUniversity		= $(this).find(".txtUniversity").val();
	  txtCountry		= $(this).find(".txtCountry").val();
	  txtSlmcNo		= $(this).find(".txtSlmcNo").val();
	  txtSlmcDate		= $(this).find(".txtSlmcDate").val();
	  
		
      value2 += '{ "txtDocName":"'+txtDocName+'", "txtQualification": "'+txtQualification+'","txtBasic":"'+txtBasic+'","txtPostGraduate":"'+txtPostGraduate+'","txtYear":"'+txtYear+'","txtUniversity":"'+txtUniversity+'","txtCountry":"'+txtCountry+'","txtSlmcNo":"'+txtSlmcNo+'","txtSlmcDate":"'+txtSlmcDate+'"},';
	});
	
	value2 = value2.substr(0,value2.length-1);
	value2 += " ]";
	
	//---------------------------------------------------------
  
    var requestType = '';
    var id = '';
    if($("#frm_staff_information").valid()){   // test for validity
      
        requestType = 'edit';	
        id = $('#frm_staff_information #cboSearch').val();
      
      var url = "staffInformation-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frm_staff_information").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&officerDetail='+value+'&quelification='+value2,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frm_staff_information').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frm_staff_information #cboSearch').trigger('change');
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
  $("#frm_staff_information #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frm_staff_information #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frm_staff_information #cboSearch').val();
    }
    var url = "staffInformation-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frm_staff_information').get(0).reset();
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
  $("#frm_staff_information #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frm_staff_information #cboSearch").change(function(){  
    $("#frm_staff_information").validate().resetForm();
    var url = "staffInformation-db-get.php";
    if($(this).val()==''){
        $('#frm_staff_information').get(0).reset();return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
			
          $('#frm_staff_information').get(0).reset();
          $("#frm_staff_information #cboSearch").val($id);
          if(json){
          
            $('#frm_staff_information #txtPracHours').val(json.practice_hours);
			
			(json.group=='1')? $('#frm_staff_information #checkGroup').prop('checked', true) : $('#frm_staff_information #checkGroup').prop('checked', false);
			(json.induvidual=='1')? $('#frm_staff_information #checkIndividual').prop('checked', true) : $('#frm_staff_information #checkIndividual').prop('checked', false);
			(json.other=='1')? $('#frm_staff_information #checkOther').prop('checked', true) : $('#frm_staff_information #checkOther').prop('checked', false);
			
			
			
			  /*-----------------------------------------------------------------------------------------*/
			$('#tblMainGrid1 >tbody >tr').each(function(){
			if($(this).index()!=0 && $(this).index()!=1 )
			{
				$(this).remove();
			}
			});
			
			
			var name 		= "";
			var category 	= "";
			var place		= "";
			var type		= "";
			
			if(json.detailVal1!=null)
			{
				
				var rowId = $('#tblMainGrid1').find('tr').length;
				var tbl = document.getElementById('tblMainGrid1');
				rows = $('#tblMainGrid1').find('.mainRow').length + 1;
				for(var j=0;j<=json.detailVal1.length-1;j++)
				{
					name		= json.detailVal1[j].name;
					category	= json.detailVal1[j].category;
					place		= json.detailVal1[j].place;
					type		= json.detailVal1[j].type;
					
					if(j==0)
					{
						
						tbl.rows[1].cells[1].childNodes[0].value = name=='NULL'?'':name;
						tbl.rows[1].cells[2].childNodes[0].value = category=='NULL'?'':category;
						tbl.rows[1].cells[3].childNodes[0].value = place=='NULL'?'':place;
						tbl.rows[1].cells[4].childNodes[0].value = type=='NULL'?'':type;
						
						tbl.rows[1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
					else
					{
						tbl.insertRow(j+1);
						tbl.rows[j+1].className='mainRow';
						tbl.rows[j+1].innerHTML = tbl.rows[j].innerHTML;
						tbl.rows[j+1].cells[1].childNodes[0].value = name=='NULL'?'':name;					
						tbl.rows[j+1].cells[2].childNodes[0].value = category=='NULL'?'':category;
						tbl.rows[j+1].cells[3].childNodes[0].value = place=='NULL'?'':place;
						tbl.rows[j+1].cells[4].childNodes[0].value = type=='NULL'?'':type;
						
						tbl.rows[j+1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
				}
			}
			else
			{
				
			}
	    //--------------------------------------------------
		
		 /*-----------------------------------------------------------------------------------------*/
			$('#tblMainGrid3 >tbody >tr').each(function(){
			if($(this).index()!=0 && $(this).index()!=1 )
			{
				$(this).remove();
			}
			});
			
			
			var qualiName 		= "";
			var qualification 	= "";
			var basic			= "";
			var postGraduate	= "";
			var qualiYear		= "";
			var postUniversity		= "";
			var country			= "";
			var slmc_no			= "";
			var slmc_date		= "";
			
			
			if(json.detailVal3!=null)
			{
				var rowId = $('#tblMainGrid3').find('tr').length;
				var tbl = document.getElementById('tblMainGrid3');
				rows = $('#tblMainGrid3').find('.mainRow').length + 1;
				for(var j=0;j<=json.detailVal3.length-1;j++)
				{
					qualiName		= json.detailVal3[j].qualiName;
					qualification	= json.detailVal3[j].qualification;
					basic			= json.detailVal3[j].basic;
					postGraduate	= json.detailVal3[j].postGraduate;
					qualiYear		= json.detailVal3[j].qualiYear;
					postUniversity	= json.detailVal3[j].postUniversity;
					country			= json.detailVal3[j].country;
					slmcNo			= json.detailVal3[j].slmcNo;
					slmcDate		= json.detailVal3[j].slmcDate;
					
					
					if(j==0)
					{
						
						tbl.rows[1].cells[1].childNodes[0].value = qualiName=='NULL'?'':qualiName;
						tbl.rows[1].cells[2].childNodes[0].value = qualification=='NULL'?'':qualification;
						tbl.rows[1].cells[3].childNodes[0].value = basic=='NULL'?'':basic;
						tbl.rows[1].cells[4].childNodes[0].value = postGraduate=='NULL'?'':postGraduate;
						tbl.rows[1].cells[5].childNodes[0].value = qualiYear=='NULL'?'':qualiYear;
						tbl.rows[1].cells[6].childNodes[0].value = postUniversity=='NULL'?'':postUniversity;
						tbl.rows[1].cells[7].childNodes[0].value = country=='NULL'?'':country;
						tbl.rows[1].cells[8].childNodes[0].value = slmcNo=='NULL'?'':slmcNo;
						tbl.rows[1].cells[9].childNodes[0].value = slmcDate=='NULL'?'':slmcDate;
						
						tbl.rows[1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
					else
					{
						tbl.insertRow(j+1);
						tbl.rows[j+1].className='mainRow';
						tbl.rows[j+1].innerHTML = tbl.rows[j].innerHTML;
						tbl.rows[j+1].cells[1].childNodes[0].value = qualiName=='NULL'?'':qualiName;					
						tbl.rows[j+1].cells[2].childNodes[0].value = qualification=='NULL'?'':qualification;
						tbl.rows[j+1].cells[3].childNodes[0].value = basic=='NULL'?'':basic;
						tbl.rows[j+1].cells[4].childNodes[0].value = postGraduate=='NULL'?'':postGraduate;
						tbl.rows[j+1].cells[5].childNodes[0].value = qualiYear=='NULL'?'':qualiYear;
						tbl.rows[j+1].cells[6].childNodes[0].value = postUniversity=='NULL'?'':postUniversity;
						tbl.rows[j+1].cells[7].childNodes[0].value = country=='NULL'?'':country;
						tbl.rows[j+1].cells[8].childNodes[0].value = slmcNo=='NULL'?'':slmcNo;
						tbl.rows[j+1].cells[9].childNodes[0].value = slmcDate=='NULL'?'':slmcDate;
						
						tbl.rows[j+1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
				}
			}
			else
			{
				
			}
	    //--------------------------------------------------
			
          }
        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End
loadSearchCombo(searchId);
function delRow(event){
	
	var rowId = $(event.target).parent().parent().parent().find('.mainRow').length;
	if(rowId!=1)
	$(event.target).parent().parent().remove();
}

function loadSearchCombo($id){
	
	var url = "staffInformation-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frm_staff_information #cboSearch').html(httpobj.responseText);
	$('#frm_staff_information #cboSearch').val($id);
	$('#frm_staff_information #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


