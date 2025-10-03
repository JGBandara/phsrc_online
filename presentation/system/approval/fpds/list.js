// JavaScript Document
$(document).ready(function() {
$('#staffInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo').hide();	
	
load_detail();

	
function load_detail(){
	$('#lblAcction').text('')
			$('#btnReject,#btnApprove').show(); 
	
		$("#table-id").find("tr:gt(0)").remove();
		var url = "list-db-get.php";
		
		var httpobj = $.ajax({
			url:url,
			dataType:'json',
			data:'requestType=loadDetails',
			async:false,
			success:function(json){
				
				$id=json.id;
				$name=json.ownerName;
				$date=json.crDate;
				$payType=json.paymentType;
				$approveStatus=json.approveStatus;
				
									$('#table-id').append( "<tbody>" );
				for($i=0;$id.length>$i;$i++){
				
				if($approveStatus[$i]==1){
					
					$('#table-id').append( "<tr><td>"+$name[$i]+"</td><td>"+$payType[$i]+"</td><td>"+$date[$i]+"</td><td><center><button type='button' class='btn btn-success btn-md' data-toggle='modal'  data-target='#myModal' id='"+$id[$i]+"' >Approved</button></center></td></tr>" );
					
					}else if($approveStatus[$i]==2){
						$('#table-id').append( "<tr><td>"+$name[$i]+"</td><td>"+$payType[$i]+"</td><td>"+$date[$i]+"</td><td><center><button type='button' class='btn btn-danger btn-md' data-toggle='modal'  data-target='#myModal' id='"+$id[$i]+"' >Rejected</button></center></td></tr>" );
						
						}else{
							$('#table-id').append( "<tr><td>"+$name[$i]+"</td><td>"+$payType[$i]+"</td><td>"+$date[$i]+"</td><td><center><button type='button' class='btn btn-warning btn-md' data-toggle='modal'  data-target='#myModal' id='"+$id[$i]+"' >Pending&nbsp;</button></center></td></tr>" );

							}
					
				/*$('#frmItemCount #sheetSize'+$i).hide();
				$('#frmItemCount #paperSize'+$i).hide();
				$('#frmItemCount #singleSide'+$i).hide();
				$('#frmItemCount #doubleSide'+$i).hide();*/
				
					/*$('#table-id').append( "<tr><td>"+$name[$i]+"</td><td>"+$name[$i]+"</td><td>"+$name[$i]+"</td><td><button type='button' class='btn btn-info btn-lg' data-toggle='modal'  data-target='#myModal' id='"+$id[$i]+"' >Approved</button></td></tr>" );*/

				}
				$('#table-id').append( "</tbody>" );
			}
		});
	/*<img src='../../../../img/but_rejected.png' style='width:100px' data-target='#myModal'/>	
*/
	}
	
$('#butBasicInfo').click(function(){
	$('#basicInfo').show();
	$('#staffInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo').hide();	
	})
$('#butStaffInfo').click(function(){
	$('#staffInfo').show();
	$('#basicInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo').hide();	
	})	
$('#butInstituteInfo').click(function(){
	$('#instituteInfo').show();
	$('#basicInfo,#staffInfo,#facilityInfo,#documentList,#paymentInfo').hide();	
	})	
$('#butFacilityInfo').click(function(){
	$('#facilityInfo').show();
	$('#basicInfo,#staffInfo,#instituteInfo,#documentList,#paymentInfo').hide();	
	})	
$('#butDocInfo').click(function(){
	$('#documentList').show();
	$('#basicInfo,#staffInfo,#instituteInfo,#facilityInfo,#paymentInfo').hide();	
	})
$('#butPaymentInfo').click(function(){
	$('#paymentInfo').show();
	$('#basicInfo,#staffInfo,#instituteInfo,#facilityInfo,#documentList').hide();	
	})
	
	
$('.btn').click(function(){
	
	var id=this.id;
	
	
	var url = "list-db-get.php";
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadInstituteDetail&id='+id,
        async:false,
        success:function(json){
          
          if(json){ 
		  $('#txtId').val(json.aId);
		  $('#lblName').text(json.ownerName);
		  $('#lblRelationship').text(json.relationsip);
		  $('#lblAddress').text(json.owAddress);
		  $('#lblInsName').text(json.insName);
		  $('#lblInsAddress').text(json.insAddress);
		  $('#lblProvince').text(json.province);
		  $('#lblDistrict').text(json.district);
		  //-----------------------------------------------------------------------
		  $('#textSLMC').text(json.slmc);
		  $('#textIsGovOfficer').text(json.is_gov_officer);
		  $('#textIsname').text(json.gov_is_name);
		  $('#textPracHoure').text(json.prac_houre);
		  //-----------------------------------------------------------------------
		  $('#textRecKeep').text(json.rec_keeping);
		  $('#textVisitSpeciality').text(json.speciality_availability);
		  $('#textLabFacility').text(json.lab_facility);
		  $('#textXrayFacility').text(json.x_ray_facility);
		  $('#textEmargancyKit').text(json.em_kit_availability);
		  $('#textOtherFacility').text(json.other_facility);
		  $('#textOwnership').text(json.ownership);
		  $('#textPracticeType').text(json.prac_type);
		  $('#textSpeciality').text(json.speciality_info);
		  $('#textOwnership').text(json.disposal_method);
		  $('#textInstrumantDressing').text(json.instrument_dressings);
		  //-----------------------------------------------------------------------
		  $('#textAmount').text(json.payAmont);
		  $('#textPayDate').text(json.payDate);
		  $('#textBranch').text(json.payBranch);
		  $('#textPayType').text(json.payType);
		    var imageName=json.payImageName;
			
		   $('.avatar1-pic').attr('src','../../../../img/BankSlip/fpds/'+imageName); 
		  //-----------------------------------------------------------------------
		  
		  if(json.approvalStatus=='1'){
			  $('#lblAcction').text('Approved!')
			$("#lblAcction").css("color", "#060");
			$('#btnReject,#btnApprove').hide();
			  
			  }else if(json.approvalStatus=='2'){
				  $('#lblAcction').text('Rejected!')
			$("#lblAcction").css("color", "#C00");
			$('#btnReject,#btnApprove').hide();
				  }else{
					  
					$('#lblAcction').text('')
			$('#btnReject,#btnApprove').show();  
					  
					  }
		  
          }
        }
    });
	
	})


$('#btnApprove').click(function(){
	
	
		var requestType="approve";
		var id=$('#txtId').val();
	
	//	}
			var url="list-db-set.php";
			var obj=$.ajax({
				url:url,
				dataType:"json",
				type:'post', 
				data:"requestType="+requestType+'&id='+id,
				async:false,

				succuss:function(json){
					
					if(json.type=='pass'){
						alert();
					}
                    else if(json.type=='fail'){
                        modalMsgBox("Error", json.msg);
						return;
                    }
							
				}
           
				 
	
			})
			$('#lblAcction').text('Approved!')
			$("#lblAcction").css("color", "#060");
			$('#btnReject,#btnApprove').hide();
		//$("#btnClose").click();
		//$('#modal').modal('hide')
		load_detail();	
	});
	
	
	
	$('#btnReject').click(function(){
	
	
		var requestType="reject";
		var id=$('#txtId').val();
	
	//	}
			var url="list-db-set.php";
			var obj=$.ajax({
				url:url,
				dataType:"json",
				type:'post', 
				data:"requestType="+requestType+'&id='+id,
				async:false,

				succuss:function(json){
					
					if(json.type=='pass'){
						alert();
					}
                    else if(json.type=='fail'){
                        modalMsgBox("Error", json.msg);
						return;
                    }
							
				}
           
				 
	
			})
			$('#lblAcction').text('Rejected!')
			$("#lblAcction").css("color", "#C00");
			$('#btnReject,#btnApprove').hide();
		//$("#btnClose").click();
		//$('#modal').modal('hide')
		load_detail();	
	});

	
	
	
	$('#frmItemCount .btnSave').click(function(){
		
		location.reload(); 
		
		})
	
		$('#frmItemCount .btnCancel').click(function(){
		
		location.reload(); 
		
		})
	
	
	$('#frmItemCount #addSave').click(function(){
		
		
		var requestType="add";
	//	}
			var url="itemCount-db-set.php";
			var obj=$.ajax({
				url:url,
				dataType:"json",
				data:$("#frmItemCount").serialize()+"&requestType="+requestType,
				async:false,

				succuss:function(json){
							
							
							
				}
           
				

			});
		
		location.reload(); 
		
		})

	function save(a){

		$('#frmItemCount #btnSave'+a).click(function(){
			
			//alert();
			
			$id = a;
			$sheetName =$('#frmItemCount #sheetName'+a).val();
			$sheetSize=$('#frmItemCount #sheetSize'+a).val();
			$paperSize=$('#frmItemCount #paperSize'+a).val();
			$singleSide=$('#frmItemCount #singleSide'+a).val();
			$doubleSide=$('#frmItemCount #doubleSide'+a).val();
       
		//if(updated==1){
			//var requestType="edit";
			
		//}else{
			
			var requestType="edit";
	//	}
			var url="itemCount-db-set.php";
			var obj=$.ajax({
				url:url,
				dataType:"json",
				data:"&requestType="+requestType+"&sheetSize="+$sheetSize+"&paperSize="+$paperSize+"&singleSide="+$singleSide+"&doubleSide="+$doubleSide+"&id="+$id+'&sheetName='+$sheetName,
				async:false,

				succuss:function(json){
							
							
							
				}
           


			});
		//alert(id);
		
		
	})


	}	


});