var anStatus = "Auto";
$( document ).ready( function () {
$('input[name^=txtArrears]').on('keyup', calculate);
	$('#txtRegFee').keyup(function(){
		
		var reg_amount=$(this).val();
		var stamp_fee = reg_amount*0.1;
		var total_amount=	+reg_amount+	+stamp_fee;
		$('#txtStampFee').val(stamp_fee.toFixed(2));
		$('#txtAmount').val(total_amount.toFixed(2));
		})
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frm_payment_information #btnNew').hide();
  $('#frm_payment_information #btnSave').hide();
  $('#frm_payment_information #btnPrint').hide();
  $('#frm_payment_information #btnDelete').hide();
  $('#frm_payment_information #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frm_payment_information #cboSearch').prop('disabled', false);
  }

  if(intAddx){ // Insert New Permission
 	$('#frm_payment_information #btnNew').show();
 	$('#frm_payment_information #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frm_payment_information #btnSave').show();
 	$('#frm_payment_information #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frm_payment_information #btnDelete').show();
 	$('#frm_payment_information #cboSearch').prop('disabled', false);
  }

  
  // =================================
  // Validation
  // ---------------------------------
 $( "#frm_payment_information" ).validate( {
      rules: {
		cboSearch:"required",
        cboPayType: {
         required: true
                },
        txtYear: {
         required: true
                },
        txtPaymentDate:{
         required: true
        }
        
},
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // ----------------------------------------------------------
  //        Active Tab
  // ----------------------------------------------------------
/*  $('.employee-tab a').each(function(){
    $href = $(this).attr('href');
    $url = $href.split('?')[0];
    $tempPath = backwardSeparator + xprojectPath;
    if($url==$tempPath){
      $(this).addClass('active');
    }
    else{
      $(this).removeClass('active');
    }
  });*/

  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
 /* $('#frm_payment_information #chkAutoManual').click(function(){
    if($('#frm_payment_information #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frm_payment_information #emi_no').val('');
      $('#frm_payment_information #emi_no').prop("readonly",true);
      $('#frm_payment_information #emi_no').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frm_payment_information #emi_no').val('');
      $('#frm_payment_information #emi_no').prop("readonly",false);
      $('#frm_payment_information #emi_no').rules("add", {
                                                    required: true,
                                                  });
    }
  });*/
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frm_payment_information #btnNew").click(function(){  
   $("#msgPayment").text("");
    $("#frm_payment_information").get(0).reset();
    $("#frm_payment_information").validate().resetForm();
  });
  // --------------------------------------------------------

  						
 $('#cboBoardType').change(function(){
	
  if($(this).val()=='Small'){
    $('#txtArrears').val('12000');
    }else{
      $('#txtArrears').val('2000');
   
      }
      calculate();
  })


$('#cboPayType').change(function(){
	
	if($(this).val()=='Online'){
		$('.hideOnline').hide();
		$('.hideOnlineSlip').hide();
		}else{
		$('.hideOnline').show();
		$('.hideOnlineSlip').show();
			}
	
	})

  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frm_payment_information #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frm_payment_information #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frm_payment_information").valid()){   // test for validity
      if($('#frm_payment_information #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frm_payment_information #cboSearch').val();
      }
      event.preventDefault();
      var form = $('#frm_payment_information');
      var frmData = false;
      if (window.FormData){
          frmData = new FormData(form[0]);
      }

      frmData.append('requestType',requestType);
      frmData.append('cboSearch',id);
      frmData.append('anStatus',anStatus);
      var url = "payments-db-set.php";
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
						$('#frm_payment_information').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frm_payment_information #cboSearch').trigger('change');
                        modalMsgBox("Success", json.msg);
						if(json.payType=='Online'){
					  window.open("../../../../payment/index.php","_self");
					  }
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
  //---------------------------------------------------------
  //			Payment
  //---------------------------------------------------------
 	$('#btnPayment').click(function(){
		$('#amountPay').val('100');
		window.open("../../../PaymentGateway/HostedCheckoutReturnToMerchant_NVP.php","_self");
		
		})
  // --------------------------------------------------------
  //      Delete Function
  // --------------------------------------------------------
  $("#frm_payment_information #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frm_payment_information #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frm_payment_information #cboSearch').val();
    }
    var url = "payments-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frm_payment_information').get(0).reset();
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
  $("#frm_payment_information #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frm_payment_information #cboSearch").change(function(){  
    $("#frm_payment_information").validate().resetForm();
    var url = "payments-db-get.php";
    if($(this).val()==''){
        $('#frm_payment_information').get(0).reset();
        $('#frm_payment_information .avatar-pic').attr('src',backwardSeparator+'img/profile/avatar.jpg'); 
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
          $('#frm_payment_information').get(0).reset();
          $("#frm_payment_information #cboSearch").val($id);
          if(json){ 
		  if(json.paymentSuccess==1){
                  $msg='Already paid LKR '+json.payAmount+'.';
                  $("#msgPayment").text($msg);
              }else{
                  $("#msgPayment").text("");
              }
			$('#frm_payment_information #txtYear').val(json.regYear);
                                $('#frm_payment_information #txtRegFee').val(json.payregFee);
                                 $('#frm_payment_information #txtStampFee').val(json.paystFee);
                                 $('#frm_payment_information #txtArrears').val(json.payarreas);
              $('#frm_payment_information #txtAmount').val(json.payAmount);
             $('#frm_payment_information #txtPaymentDate').val(json.paymentDate);
              $('#frm_payment_information #txtPaymentBranch').val(json.paymentBranch);
			  $('#frm_payment_information #cboPayType').val(json.paymentType);
        $('#frm_payment_information #cboBoardType').val(json.board_type);
			  var imageName=json.payImageName;
			  //alert(imageName)
			   $('#frm_payment_information .avatar1-pic').attr('src',backwardSeparator+'img/BankSlip/'+imageName); 
                           
                         $pymentAm=parseFloat(json.totAmount); 
                         $payarreas=parseFloat(json.payarreas); 
                         $('#frm_payment_information #txtRegFee').val($pymentAm);
                         
                         $('#frm_payment_information #txtStampFee').val(2000);
                     
                         $pymentTotal=$payarreas+$pymentAm+parseFloat(2000);
                         $('#frm_payment_information #txtAmount').val($pymentTotal);
                         const currentYear = new Date().getFullYear();
                         document.getElementById('txtYear').value = '2025';
                         ////Check box checked
                         $("#frm_payment_information #confirm").prop( "checked", true );
			
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
	$("#msgPayment").text("");
	var url = "payments-db-get.php?requestType=loadSearchCombo&id="+$id;
	var httpobj = $.ajax({url:url,async:false})
	$('#frm_payment_information #cboSearch').html(httpobj.responseText);
	//$('#frm_payment_information #cboSearch').val($id);
	$('#frm_payment_information #cboSearch').trigger('change');
}
function calculate(){
       $regamount=parseFloat($('#frm_payment_information #txtRegFee').val());
       $addAmount= parseFloat($('#frm_payment_information #txtArrears').val());
       $stAmount= parseFloat($('#frm_payment_information #txtStampFee').val());
       $finalSum=$regamount+$addAmount+$stAmount;
       //alert($finalSum);
       $('#frm_payment_information #txtAmount').val($finalSum);
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


