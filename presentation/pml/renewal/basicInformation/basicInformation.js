
var anStatus = "Auto";
$( document ).ready( function () {
	window.location.href = "#popup1"; 
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frm_basic_information #btnSave').hide();
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

$('#sendPg').hide();
$('#codePg').hide();
$('#errpg').show();

  
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
        cboProvince: {
                  required: true,
                },
        cboDistrict: {
                 required: true,
                },
        cboStatus:"required",
        cboCompanyId:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
 

  // --------------------------------------------------------


  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_basic_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
    // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_basic_information #btnDocument").click(function(){  
    window.location.assign("../employeeFiles/employeeFiles.php?no="+$('#txtRegNo').val()+"&id="+$('#txtInsId').val());
  });
  // ---------------------------------------------------------
  // ---------------------------------------------------------
  //        Search Function
  // ---------------------------------------------------------
  

 $("#frm_basic_information #btnSearch").click(function(){  
    
	 var url = "misInformation-db-get.php";
   		$id = $('#txtSearch').val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frm_basic_information').get(0).reset();
          $("#frm_basic_information #txtSearch").val($id);
          if(json){ 
              
              if(json.reg_no!=undefined){
                 
                 $('#sendPg').show();
                 $('#codePg').hide();
                 $('#errpg').hide();     
                  
              }else{
                  
                $('#sendPg').hide();
                 $('#codePg').hide();
                 $('#errpg').show();    
                  
              }
		
                $insId=json.insId;
                $mob_no=json.mob_no;
                return $insId,$mob_no;
//              $('#txtInsName').val(json.ins_name);
//              $('#txtRegNo').val(json.reg_no);
//              $('#txtInsId').val(json.insId);
//              $('#txtAddress').val(json.address);
//              $('#txtTelephone').val(json.telephone);
//              $('#txtFax').val(json.fax);
//              $('#txtEmail').val(json.email);
//              $('#txtWeb').val(json.web);
//			  
//              $('#txtDate').val(json.Start_date);
//              $('#txtOtherInfo').val(json.discription);
//              $('#txtSLMC').val(json.slmc_no);
//              $('#txtProvince').val(json.province_name);
//              $('#txtDistrict').val(json.district_id);
//              $('#txtOwnership').val(json.ownership_type);
//              $('#txtRecordKeeping').val(json.record_keeping);
//			  
//              $('#txtBussReg').val(json.bis_registration);
//              $('#txtHrPractice').val(json.hours_of_prctices);
          }
        }
    });
 
	
  }); 
  
  
  $('#btnSendCode').click(function(){
       
			var requestType = 'edit';
		
		
		///////////////set to locations array /////////////////////////
		
		
		var url = "misInformation-db-set.php";
     	var obj = $.ajax({
			url:url,
			dataType: "json",  
			data:'&requestType='+requestType+'&insId='+$insId+'&mobNo='+$mob_no,
		
			async:false,
			
			success:function(json){
					
					if(json.type=='pass')
					{
					$('#sendPg').hide();
                 $('#codePg').show();
                 $('#errpg').hide(); 	
                  
				 // Set the date we're counting down to
var countDownDate = new Date(json.acTime).getTime();

// Update the count down every 1 second
var x = setInterval(function() {
$('#frmFeedbackActivate .loader').show();
$('#lblRmTime').show();
  // Get today's date and time
 // var now = new Date().getTime();
 var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  /*document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";*/
  document.getElementById("lblRmTime").innerHTML =  minutes + "m " + seconds + "s ";
   $('#frmFeedbackActivate #finalResult').hide();
	$('#lblTm').hide(); 
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("lblRmTime").innerHTML = "TIME EXPIRED";
	location.reload();
  }
}, 1000);
				 
					}
					//var t=setTimeout("alertx()",3000);
				},
			error:function(xhr,status){
								
				}		
			
            
  });
  });
  
  $("#frm_basic_information #btnConfirm").click(function(){  
    
	 var url = "misInformation-db-get.php";
   		$id = $('#txtCode').val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadconf&id='+$id+'&insId='+$insId,
        async:false,
        success:function(json){
         // $('#frm_basic_information').get(0).reset();
         // $("#frm_basic_information #txtSearch").val($id);
          if(json){ 
             
             
                 window.location.assign("../masterData/basicInformation/basicInformation.php?id="+json.institute_id);  
                  
              
		
//                $insId=json.insId;
//                $mob_no=json.mob_no;
//                return $insId,$mob_no;
//              $('#txtInsName').val(json.ins_name);
//              $('#txtRegNo').val(json.reg_no);
//              $('#txtInsId').val(json.insId);
//              $('#txtAddress').val(json.address);
//              $('#txtTelephone').val(json.telephone);
//              $('#txtFax').val(json.fax);
//              $('#txtEmail').val(json.email);
//              $('#txtWeb').val(json.web);
//			  
//              $('#txtDate').val(json.Start_date);
//              $('#txtOtherInfo').val(json.discription);
//              $('#txtSLMC').val(json.slmc_no);
//              $('#txtProvince').val(json.province_name);
//              $('#txtDistrict').val(json.district_id);
//              $('#txtOwnership').val(json.ownership_type);
//              $('#txtRecordKeeping').val(json.record_keeping);
//			  
//              $('#txtBussReg').val(json.bis_registration);
//              $('#txtHrPractice').val(json.hours_of_prctices);
          }
        }
    });
 
	
  }); 
  
  
  
  
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  if($('#frm_basic_information #cboSearch').val()==''||$('#frm_basic_information #cboSearch').val()==null){
	 $('#frm_basic_information #btnSave').hide();
	  }else{ 
	  $('#frm_basic_information #btnSave').show();
	  }
  
  
  $("#frm_basic_information #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frm_basic_information").valid()){   // test for validity

        requestType = 'edit';	
        id = $('#frm_basic_information #cboSearch').val();
     
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
  
 
  // =====================================================
  // ===============  Search  combo Content Load =========
  // =====================================================
  $("#frm_basic_information #cboSearch").focus(function(){  
   $('#frm_basic_information #btnSave').show();
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
              $('#frm_basic_information #txtAddress').val(json.owAddress);
              $('#frm_basic_information #txtInsName').val(json.insName);
              $('#frm_basic_information #txtInsAddress').val(json.insAddress);
              $('#frm_basic_information #cboProvince').val(json.province);
              $('#frm_basic_information #cboDistrict').val(json.district);
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
	
	var url = "basicInformation-db-get.php?requestType=loadSearchCombo1";
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


