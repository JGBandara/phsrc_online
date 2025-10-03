
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
  $('#frm_staff_information #btnSave').hide();
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


  // =================================
  // Validation
  // ---------------------------------
  $( "#frm_staff_information" ).validate( {
      rules: {
        cboSearch:"required",
        txtSLMC: {
                  required: true,
                  maxlength: 100
                },
		cboGovOfficer:"required",
        cboStatus:"required",
        cboCompanyId:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );

  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_staff_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
    if($('#frm_staff_information #cboSearch').val()==''||$('#frm_staff_information #cboSearch').val()==null){
	 $('#frm_staff_information #btnSave').hide();
	  }else{ 
	  $('#frm_basic_information #btnSave').show();
	  }
  
  $("#frm_staff_information #btnSave").click(function(){  

  //---------------tblMainGrid1---------------------------
 		 var txtSurgeonName ='';
		 var txtPrivet   ='';
		 var txtWorkPlace	   ='';
		 var txtPrivetPracI='';
		 var txtPrivetPracII='';
		 
		 value="[ ";
	$('#tblMainGrid1 .mainRow').each(function(){
		
      txtSurgeonName	= $(this).find(".txtSurgeonName").val();		
      txtPrivet 		= $(this).find(".txtPrivet").val();
	  txtWorkPlace		= $(this).find(".txtWorkPlace").val();
	  txtPrivetPracI		= $(this).find(".txtPrivetPracI").val();
	  txtPrivetPracII		= $(this).find(".txtPrivetPracII").val();
		
      value += '{ "txtSurgeonName":"'+txtSurgeonName+'", "txtPrivet": "'+txtPrivet+'","txtWorkPlace":"'+txtWorkPlace+'","txtPrivetPracI":"'+txtPrivetPracI+'","txtPrivetPracII":"'+txtPrivetPracII+'"},';
	});
	
	value = value.substr(0,value.length-1);
	value += " ]";
	
	//---------------------------------------------------------
	//---------------tblMainGrid2---------------------------
	
		 var txtDenSergeonName ='';
		 var txtGeneralTel     ='';
		 var txtFaxNo	  	   ='';
		 var txtMobileNo	   ='';
		 var txtEmail          ='';
		 value1="[ ";
	$('#tblMainGrid2 .mainRow').each(function(){
		
      txtDenSergeonName	= $(this).find(".txtDenSergeonName").val();		
      txtGeneralTel 		= $(this).find(".txtGeneralTel").val();
	  txtFaxNo		= $(this).find(".txtFaxNo").val();
	  txtMobileNo		= $(this).find(".txtMobileNo").val();
	  txtEmail		= $(this).find(".txtEmail").val();
		
      value1 += '{ "txtDenSergeonName":"'+txtDenSergeonName+'", "txtGeneralTel": "'+txtGeneralTel+'","txtFaxNo":"'+txtFaxNo+'","txtMobileNo":"'+txtMobileNo+'","txtEmail":"'+txtEmail+'"},';
	});
	
	value1 = value1.substr(0,value1.length-1);
	value1 += " ]";
	
	//---------------------------------------------------------
	
	//---------------tblMainGrid3---------------------------
	
		 var txtSurgName 		='';
		 var txtQualification   ='';
		 var txtBasic	  	    ='';
		 var txtPostGraduate    ='';
		 var txtYear            ='';
		 var txtUniversity      ='';
		 var txtCountry         ='';
		 
		 value2="[ ";
	$('#tblMainGrid3 .mainRow').each(function(){
		
      txtSurgName	= $(this).find(".txtSurgName").val();		
      txtQualification 		= $(this).find(".txtQualification").val();
	  txtBasic		= $(this).find(".txtBasic").val();
	  txtPostGraduate		= $(this).find(".txtPostGraduate").val();
	  txtYear		= $(this).find(".txtYear").val();
	  txtUniversity		= $(this).find(".txtUniversity").val();
	  txtCountry		= $(this).find(".txtCountry").val();
	  
		
      value2 += '{ "txtSurgName":"'+txtSurgName+'", "txtQualification": "'+txtQualification+'","txtBasic":"'+txtBasic+'","txtPostGraduate":"'+txtPostGraduate+'","txtYear":"'+txtYear+'","txtUniversity":"'+txtUniversity+'","txtCountry":"'+txtCountry+'"},';
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
			data:$("#frm_staff_information").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&sergDetail='+value+'&communication='+value1+'&quelification='+value2,
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
  
  // =====================================================
  // ===============  Search  combo Content Load =========
  // =====================================================
  $("#frm_staff_information #cboSearch").focus(function(){  
  $('#frm_staff_information #btnSave').show();
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
          //  $('#frm_staff_information #cboId').val(json[0].emr_id);
            $('#frm_staff_information #txtSLMC').val(json.slmc_no);
            $('#frm_staff_information #cboGovOfficer').val(json.is_gov_officer);
            $('#frm_staff_information #txtGovInstitute').val(json.ins_name);
            $('#frm_staff_information #txtPracHours').val(json.practice_hours);
			
			(json.full_time=='1')? $('#frm_staff_information #checkFullTime').prop('checked', true) : $('#frm_staff_information #checkFullTime').prop('checked', false);
			(json.group=='1')? $('#frm_staff_information #checkGroup').prop('checked', true) : $('#frm_staff_information #checkGroup').prop('checked', false);
			(json.induvidual=='1')? $('#frm_staff_information #checkIndividual').prop('checked', true) : $('#frm_staff_information #checkIndividual').prop('checked', false);
			(json.nursing_home=='1')? $('#frm_staff_information #checkNursingHome').prop('checked', true) : $('#frm_staff_information #checkNursingHome').prop('checked', false);
			(json.pvt_dental=='1')? $('#frm_staff_information #checkPrivetDental').prop('checked', true) : $('#frm_staff_information #checkPrivetDental').prop('checked', false);
			
			
			  /*-----------------------------------------------------------------------------------------*/
			$('#tblMainGrid1 >tbody >tr').each(function(){
			if($(this).index()!=0 && $(this).index()!=1 )
			{
				$(this).remove();
			}
			});
			
			
			var name 		= "";
			var private 	= "";
			var workplace	= "";
			var practice_i	= "";
			var practice_ii	= "";
			
			if(json.detailVal1!=null)
			{
				var rowId = $('#tblMainGrid1').find('tr').length;
				var tbl = document.getElementById('tblMainGrid1');
				rows = $('#tblMainGrid1').find('.mainRow').length + 1;
				for(var j=0;j<=json.detailVal1.length-1;j++)
				{
					name		= json.detailVal1[j].name;
					private	    = json.detailVal1[j].private;
					workplace	= json.detailVal1[j].workplace;
					practice_i	= json.detailVal1[j].practice_i;
					practice_ii	= json.detailVal1[j].practice_ii;
					
					if(j==0)
					{
						
						tbl.rows[1].cells[1].childNodes[0].value = name=='NULL'?'':name;
						tbl.rows[1].cells[2].childNodes[0].value = private=='NULL'?'':private;
						tbl.rows[1].cells[3].childNodes[0].value = workplace=='NULL'?'':workplace;
						tbl.rows[1].cells[4].childNodes[0].value = practice_i=='NULL'?'':practice_i;
						tbl.rows[1].cells[5].childNodes[0].value = practice_ii=='NULL'?'':practice_ii;
						
						tbl.rows[1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
					else
					{
						tbl.insertRow(j+1);
						tbl.rows[j+1].className='mainRow';
						tbl.rows[j+1].innerHTML = tbl.rows[j].innerHTML;
						tbl.rows[j+1].cells[1].childNodes[0].value = name=='NULL'?'':name;					
						tbl.rows[j+1].cells[2].childNodes[0].value = private=='NULL'?'':private;
						tbl.rows[j+1].cells[3].childNodes[0].value = workplace=='NULL'?'':workplace;
						tbl.rows[j+1].cells[4].childNodes[0].value = practice_i=='NULL'?'':practice_i;
						tbl.rows[j+1].cells[5].childNodes[0].value = practice_ii=='NULL'?'':practice_ii;
						
						tbl.rows[j+1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
				}
			}
			else
			{
				
			}
	    //--------------------------------------------------
		
		  /*-----------------------------------------------------------------------------------------*/
			$('#tblMainGrid2 >tbody >tr').each(function(){
			if($(this).index()!=0 && $(this).index()!=1 )
			{
				$(this).remove();
			}
			});
			
			
			var comName 		= "";
			var genNo 	= "";
			var fax	= "";
			var mobNo	= "";
			var email	= "";
			
			if(json.detailVal2!=null)
			{
				var rowId = $('#tblMainGrid2').find('tr').length;
				var tbl = document.getElementById('tblMainGrid2');
				rows = $('#tblMainGrid2').find('.mainRow').length + 1;
				for(var j=0;j<=json.detailVal2.length-1;j++)
				{
					comName		= json.detailVal2[j].comName;
					genNo	    = json.detailVal2[j].genNo;
					fax			= json.detailVal2[j].fax;
					mobNo		= json.detailVal2[j].mobNo;
					email		= json.detailVal2[j].email;
					
					if(j==0)
					{
						
						tbl.rows[1].cells[1].childNodes[0].value = comName=='NULL'?'':comName;
						tbl.rows[1].cells[2].childNodes[0].value = genNo=='NULL'?'':genNo;
						tbl.rows[1].cells[3].childNodes[0].value = fax=='NULL'?'':fax;
						tbl.rows[1].cells[4].childNodes[0].value = mobNo=='NULL'?'':mobNo;
						tbl.rows[1].cells[5].childNodes[0].value = email=='NULL'?'':email;
						
						tbl.rows[1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
					else
					{
						tbl.insertRow(j+1);
						tbl.rows[j+1].className='mainRow';
						tbl.rows[j+1].innerHTML = tbl.rows[j].innerHTML;
						tbl.rows[j+1].cells[1].childNodes[0].value = comName=='NULL'?'':comName;					
						tbl.rows[j+1].cells[2].childNodes[0].value = genNo=='NULL'?'':genNo;
						tbl.rows[j+1].cells[3].childNodes[0].value = fax=='NULL'?'':fax;
						tbl.rows[j+1].cells[4].childNodes[0].value = mobNo=='NULL'?'':mobNo;
						tbl.rows[j+1].cells[5].childNodes[0].value = email=='NULL'?'':email;
						
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
					postUniversity		= json.detailVal3[j].postUniversity;
					country			= json.detailVal3[j].country;
					
					if(j==0)
					{
						
						tbl.rows[1].cells[1].childNodes[0].value = qualiName=='NULL'?'':qualiName;
						tbl.rows[1].cells[2].childNodes[0].value = qualification=='NULL'?'':qualification;
						tbl.rows[1].cells[3].childNodes[0].value = basic=='NULL'?'':basic;
						tbl.rows[1].cells[4].childNodes[0].value = postGraduate=='NULL'?'':postGraduate;
						tbl.rows[1].cells[5].childNodes[0].value = qualiYear=='NULL'?'':qualiYear;
						tbl.rows[1].cells[6].childNodes[0].value = postUniversity=='NULL'?'':postUniversity;
						tbl.rows[1].cells[7].childNodes[0].value = country=='NULL'?'':country;
						
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
						tbl.rows[j+1].cells[4].childNodes[0].value = postUniversity=='NULL'?'':postUniversity;
						tbl.rows[j+1].cells[5].childNodes[0].value = country=='NULL'?'':country;
						
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


