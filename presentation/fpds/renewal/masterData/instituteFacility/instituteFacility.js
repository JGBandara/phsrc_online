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
 
  $('#frm_institute_facility #btnSave').hide();
  
  $('#frm_institute_facility #btnDelete').hide();
 
  $('#frm_institute_facility #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frm_institute_facility #cboSearch').prop('disabled', false);
  }
  if(intAddx){ // Insert New Permission
 	$('#frm_institute_facility #btnNew').show();
 	$('#frm_institute_facility #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frm_institute_facility #btnSave').show();
 	$('#frm_institute_facility #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frm_institute_facility #btnDelete').show();
 	$('#frm_institute_facility #cboSearch').prop('disabled', false);
  }

  // =================================
  // Validation
  // ---------------------------------
  $( "#frm_institute_facility" ).validate( {
      rules: {
        cboSearch:"required",
        txtNoBed: {
                  required: true,
                },
        cbofacility: {
                  required: true,
                },
        txtValue: {
                  required: true,
                },
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // ----------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frm_institute_facility #btnNew").click(function(){  
    $("#frm_institute_facility").get(0).reset();
    $("#frm_institute_facility").validate().resetForm();
  });
  // --------------------------------------------------------
 
  // --------------------------------------------------------
  $("#frm_institute_facility #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frm_institute_facility #btnSave").click(function(){  
    
  //---------------tblMainGrid1---------------------------
 		 var cbofacility ='';
		 var txtValue   ='';
		 var txtDiscription	   ='';
		 
		 value="[ ";
	$('#tblMainGrid1 .mainRow').each(function(){
		
      cbofacility	= $(this).find(".cbofacility").val();		
      txtValue 		= $(this).find(".txtValue").val();
	  txtDiscription		= $(this).find(".txtDiscription").val();
		
      value += '{ "cbofacility":"'+cbofacility+'", "txtValue": "'+txtValue+'","txtDiscription":"'+txtDiscription+'"},';
	});
	
	value = value.substr(0,value.length-1);
	value += " ]";
	
	//---------------------------------------------------------
  
  //  var requestType = '';
    var id = '';
    if($("#frm_institute_facility").valid()){   // test for validity
      
      var  requestType = 'edit';	
        id = $('#frm_institute_facility #cboSearch').val();
      
      var url = "instituteFacility-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frm_institute_facility").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&facilityDetail='+value,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frm_institute_facility').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frm_institute_facility #cboSearch').trigger('change');
                        modalMsgBox("Success", json.msg);
                      //  location.reload();
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
  $("#frm_institute_facility #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frm_institute_facility #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frm_institute_facility #cboSearch').val();
    }
    var url = "instituteFacility-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frm_institute_facility').get(0).reset();
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
  $("#frm_institute_facility #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frm_institute_facility #cboSearch").change(function(){  
    $("#frm_institute_facility").validate().resetForm();
    var url = "instituteFacility-db-get.php";
    if($(this).val()==''){
        $('#frm_institute_facility').get(0).reset();return;	
    }
    $id = $(this).val();
    updateTabLink($id);
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frm_institute_facility').get(0).reset();
          $("#frm_institute_facility #cboSearch").val($id);
          if(json){ 
		  
		  
		  $('#txtNoBed').val(json.noBed);
		  $('#txtNoRoom').val(json.noRoom);
		  $('#txtNoWard').val(json.noWard);
		  $('#cboAtomicEnergy').val(json.radioSer);
		  $('#txtNoLicense').val(json.noLicense);
		   $('#txtclinicalDis').val(json.disposal);
		  $('#txtInsDress').val(json.instDress);
		  $('#cboEmgKit').val(json.emgKit);
		  
             
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
					facility		= json.detailVal1[j].facility;
					value	    = json.detailVal1[j].value;
					description	= json.detailVal1[j].description;
					
					if(j==0)
					{
						
						tbl.rows[1].cells[1].childNodes[0].value = facility=='NULL'?'':facility;
						tbl.rows[1].cells[2].childNodes[0].value = value=='NULL'?'':value;
						tbl.rows[1].cells[3].childNodes[0].value = description=='NULL'?'':description;
						
						tbl.rows[1].cells[1].childNodes[0].id= tbl.id+"id" + j+1;
					}
					else
					{
						tbl.insertRow(j+1);
						tbl.rows[j+1].className='mainRow';
						tbl.rows[j+1].innerHTML = tbl.rows[j].innerHTML;
						tbl.rows[j+1].cells[1].childNodes[0].value = facility=='NULL'?'':facility;					
						tbl.rows[j+1].cells[2].childNodes[0].value = value=='NULL'?'':value;
						tbl.rows[j+1].cells[3].childNodes[0].value = description=='NULL'?'':description;
						
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

 //loadSearchCombo(searchId);
function delRow(event){
	
	var rowId = $(event.target).parent().parent().parent().find('.mainRow').length;
	if(rowId!=1)
	$(event.target).parent().parent().remove();
}

function loadSearchCombo($id){
	var url = "instituteFacility-db-get.php?requestType=loadSearchCombo&id="+$id;
	var httpobj = $.ajax({url:url,async:false})
	$('#frm_institute_facility #cboSearch').html(httpobj.responseText);
	//$('#frm_institute_facility #cboSearch').val($id);
	$('#frm_institute_facility #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}

