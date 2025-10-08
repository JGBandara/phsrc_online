
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
  $('#frm_staff_information #btnList').hide();
  $('#frm_staff_information #btnSave').hide();
  $('#frm_staff_information #btnPrint').hide();
  $('#frm_staff_information #btnDelete').hide();
  $('#frm_staff_information #btnApprove').hide();
  $('#frm_staff_information #btnReject').hide();
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
      rules: {
        cboSearch:"required",
        txtDocName: {
                  required: true
                },
        txtQulifications: {
                  required: true
                },
        txtInstitute: {
                  required: true
                },
        txtRegisterd: {
                  required: true
                },
        cboPosition: {
                  required: true
                },
        txtName: {
                  required: true
                },
        txtContact: {
                  required: true
                },
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
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
 //========================Transfers========================
		var Name 		= "";
		var Qulifications 	= "";
		var Institute 		= "";
		var Country 	= "";
		var PostGraduate 		= "";
		var Speciality 	= "";
		var Registerd 	= "";
	value="[ ";
	$('#tblMainGrid1 .mainRow').each(function(){
		
		Name	 = encodeURIComponent($(this).find(".Name").val());
		Qulifications = encodeURIComponent($(this).find(".Qulifications").val());
		Institute	 = encodeURIComponent($(this).find(".Institute").val());
		Country = encodeURIComponent($(this).find(".Country").val());
		PostGraduate	 = encodeURIComponent($(this).find(".PostGraduate").val());
		Speciality = encodeURIComponent($(this).find(".Speciality").val());
		Registerd = encodeURIComponent($(this).find(".Registerd").val());
			
		value += '{ "Name": "'+Name+'", "Qulifications": "'+Qulifications+'","Institute":"'+Institute+'","Country":"'+Country+'","PostGraduate":"'+PostGraduate+'","Speciality":"'+Speciality+'","Registerd":"'+Registerd+'"},';
	});
	
	value = value.substr(0,value.length-1);
	value += " ]";
	//=========================================================
	//===================Employee Dependence===================
		var Position 		= "";
		var Namee 	= "";
		var Contact 		= "";
		var Information 	= "";
	value2="[ ";
	$('#tblMainGrid2 .mainRow').each(function(){
		
		Position		= encodeURIComponent($(this).find(".Position").val());
		Namee 	= encodeURIComponent($(this).find(".Name").val());
		Contact 		= encodeURIComponent($(this).find(".Contact").val());
		Information	= encodeURIComponent($(this).find(".Information").val());
			
		value2 += '{ "Position": "'+Position+'", "Name": "'+Namee+'", "Contact": "'+Contact+'", "Information": "'+Information+'"},';
	});
	
	value2 = value2.substr(0,value2.length-1);
	value2 += " ]";
	//=========================================================
	
  
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
			data:$("#frm_staff_information").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&staffDetail='+value+'&manaDetail='+value2,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frm_staff_information').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frm_staff_information #cboSearch').trigger('change');
                        modalMsgBox("Success", json.msg);
                        //location.reload();
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
			
			var Name 			= "";
			var Qulification 	= "";
			var institute 	= "";
			var country="";
			var post_gradu="";
			var speciality="";
			var Register_id="";
			
			if(json.detailVal1!=null)
			{
				var rowId = $('#tblMainGrid1').find('tr').length;
				var tbl = document.getElementById('tblMainGrid1');
				rows = $('#tblMainGrid1').find('.mainRow').length + 1;
				for(var j=0;j<=json.detailVal1.length-1;j++)
				{
					
					Name			= json.detailVal1[j].Name;
					Qulification		= json.detailVal1[j].Qulification;
					institute	= json.detailVal1[j].institute;
					country=json.detailVal1[j].country;
					post_gradu=json.detailVal1[j].post_gradu;
					speciality=json.detailVal1[j].speciality;
					Register_id=json.detailVal1[j].Register_id;
					
					if(j==0)
					{
						tbl.rows[1].cells[1].childNodes[0].value = Name=='NULL'?'':Name;
						tbl.rows[1].cells[2].childNodes[0].value = Qulification=='NULL'?'':Qulification;
						tbl.rows[1].cells[3].childNodes[0].value = institute=='NULL'?'':institute;
						tbl.rows[1].cells[4].childNodes[0].value = country=='NULL'?'':country;
						tbl.rows[1].cells[5].childNodes[0].value = post_gradu=='NULL'?'':post_gradu;
						tbl.rows[1].cells[6].childNodes[0].value = speciality=='NULL'?'':speciality;
						tbl.rows[1].cells[7].childNodes[0].value = Register_id=='NULL'?'':Register_id;
						
						tbl.rows[1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
					else
					{
						tbl.insertRow(j+1);
						tbl.rows[j+1].className='mainRow';
						tbl.rows[j+1].innerHTML = tbl.rows[j].innerHTML;
						tbl.rows[j+1].cells[1].childNodes[0].value = Name=='NULL'?'':Name;					
						tbl.rows[j+1].cells[2].childNodes[0].value = Qulification=='NULL'?'':Qulification;
						tbl.rows[j+1].cells[3].childNodes[0].value = institute=='NULL'?'':institute;
						tbl.rows[j+1].cells[4].childNodes[0].value = country=='NULL'?'':country;
						tbl.rows[j+1].cells[5].childNodes[0].value = post_gradu=='NULL'?'':post_gradu;
						tbl.rows[j+1].cells[6].childNodes[0].value = speciality=='NULL'?'':speciality;
						tbl.rows[j+1].cells[7].childNodes[0].value = Register_id=='NULL'?'':Register_id;
						
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
			
			
			var position = "";
			var name 	= "";
			var contact	= "";
			var info	= "";
			
			if(json.detailVal2!=null)
			{
				var rowId = $('#tblMainGrid2').find('tr').length;
				var tbl = document.getElementById('tblMainGrid2');
				rows = $('#tblMainGrid2').find('.mainRow').length + 1;
				for(var j=0;j<=json.detailVal2.length-1;j++)
				{
					position		= json.detailVal2[j].position;
					name	    = json.detailVal2[j].name;
					contact			= json.detailVal2[j].contact;
					info		= json.detailVal2[j].info;
					
					if(j==0)
					{
						
						tbl.rows[1].cells[1].childNodes[0].value = position=='NULL'?'':position;
						tbl.rows[1].cells[2].childNodes[0].value = name=='NULL'?'':name;
						tbl.rows[1].cells[3].childNodes[0].value = contact=='NULL'?'':contact;
						tbl.rows[1].cells[4].childNodes[0].value = info=='NULL'?'':info;
						
						tbl.rows[1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
					else
					{
						tbl.insertRow(j+1);
						tbl.rows[j+1].className='mainRow';
						tbl.rows[j+1].innerHTML = tbl.rows[j].innerHTML;
						tbl.rows[j+1].cells[1].childNodes[0].value = position=='NULL'?'':position;					
						tbl.rows[j+1].cells[2].childNodes[0].value = name=='NULL'?'':name;
						tbl.rows[j+1].cells[3].childNodes[0].value = contact=='NULL'?'':contact;
						tbl.rows[j+1].cells[4].childNodes[0].value = info=='NULL'?'':info;
						
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
	
	 var url = "staffInformation-db-get.php?requestType=loadSearchCombo&id="+$id;
	var httpobj = $.ajax({url:url,async:false});
	$('#frm_staff_information #cboSearch').html(httpobj.responseText);
	//$('#frm_staff_information #cboSearch').val($id);
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


