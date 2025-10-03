
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset

  $('#mdLab').hide();
  $('#phos').hide();
  $('#mdCent').hide();
  $('#densu').hide();
  $('#ambser').hide();
  $('#instype_id').hide();
  //$('#frm_basic_information #personal').hide();
  // $('#frm_basic_information #btnNew').hide();
  // $('#frm_basic_information #btnSave').hide();
  // $('#frm_basic_information #btnDelete').hide();
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
        txtNo: {
                  required: true,
                  maxlength: 32
                },
        txtCallingName: {
                  required: true,
                  maxlength: 32
                },
        txtEpfNo: {
                  maxlength: 32
                },
        txtFingerPrintNo: {
                  maxlength: 32
                },
        dtpJoinedDate: {
                  dateISO: true
                },
        dtpPermanentDate: {
                  dateISO: true
                },
        dtpConfirmDate: {
                  dateISO: true
                },
        dtpResignedDate: {
                  dateISO: true
                },
        dtpRetirementDate: {
                  dateISO: true
                },
        txtImageName: {
                  maxlength: 64
                },
        txtRemarks: {
                  maxlength: 250
                },
        cboSearch:"required",
        cboStatus:"required",
        cboCompanyId:"required",
        
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
    var insTypeId = '';
    //alert('ok');
    if($("#frm_basic_information").valid()){   // test for validity
      
        requestType = 'add';	
        id = $('#frm_basic_information #cboSearch').val();
        insTypeId = $('#instype_id #insTypeId').val();
        //console.log(insTypeId);
        //alert('ok1');
      event.preventDefault();
      var form = $('#frm_basic_information');
      var frmData = false;
      if (window.FormData){
          frmData = new FormData(form[0]);
      }

      frmData.append('requestType',requestType);
      frmData.append('cboSearch',id);
      frmData.append('anStatus',anStatus);
      frmData.append('insTypeId',insTypeId);
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
                       // $('#frm_basic_information #cboSearch').trigger('change');
                        modalMsgBox("Success", json.msg);
						return;
					}
                    else if(json.type=='fail'){
                      //alert('ok2');
                        modalMsgBox("Error", json.msg);
						return;
                    }
				},
			error:function(xhr,status){
                    modalMsgBox("Error", "AJAX error "+xhr.status);
				}		
			});
    } else {
     // modalMsgBox("Error", "Validation Failed ...");
    }
  });

// --------------------------------------------------------
//      edit Function
// --------------------------------------------------------
  $("#frm_basic_information #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    var insTypeId = '';
    if($("#frm_basic_information").valid()){   // test for validity
      
        requestType = 'edit';	
        id = $('#frm_basic_information #cboSearch').val();
        insTypeId = $('#instype_id #insTypeId').val();
      
      event.preventDefault();
      var form = $('#frm_basic_information');
      var frmData = false;
      if (window.FormData){
          frmData = new FormData(form[0]);
      }

      frmData.append('requestType',requestType);
      frmData.append('cboSearch',id);
      frmData.append('anStatus',anStatus);
      frmData.append('insTypeId',insTypeId);
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
                     //   $('#frm_basic_information #cboSearch').trigger('change');
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
     // modalMsgBox("Error", "Validation Failed ...");
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

              //console.log(json.ins_type_id);
              //alert(json.ins_type_id);
              
              if(json.ins_type_id==1){
                $('#phos').show();
                $('#mdLab').hide();
                $('#mdCent').hide();
                $('#densu').hide();
                $('#ambser').hide();
                $('#frm_basic_information #phos_ownerame').val(json.phos_ownerame);
                $('#frm_basic_information #phos_nameceo').val(json.phos_nameceo);
                $('#frm_basic_information #phos_namemd').val(json.phos_namemd);
                $('#frm_basic_information #phos_mdreg').val(json.phos_mdreg);
                $('#frm_basic_information #phos_numberftdoc').val(json.phos_numberftdoc);
                $('#frm_basic_information #phos_namenursdirect').val(json.phos_namenursdirect);
                $('#frm_basic_information #phos_numbernurse').val(json.phos_numbernurse);
                $('#frm_basic_information #phos_udaappnumber').val(json.phos_udaappnumber);
                $('#frm_basic_information #phos_nursinghomedate').val(json.phos_nursinghomedate);
                $('#frm_basic_information #phos_consltroom').val(json.phos_consltroom);
                $('#frm_basic_information #phos_squareroom').val(json.phos_squareroom);
                $('#frm_basic_information #phos_exambed').val(json.phos_exambed);
                $('#frm_basic_information #phos_tablechair').val(json.phos_tablechair);
                $('#frm_basic_information #phos_washbasin').val(json.phos_washbasin);
                $('#frm_basic_information #phos_weighningscale').val(json.phos_weighningscale);
                $('#frm_basic_information #phos_ventillu').val(json.phos_ventillu);
                $('#frm_basic_information #phos_waitingperson').val(json.phos_waitingperson);
                $('#frm_basic_information #phos_waitingventi').val(json.phos_waitingventi);
                $('#frm_basic_information #phos_sampleexambed').val(json.phos_sampleexambed);
                $('#frm_basic_information #phos_floorarea').val(json.phos_floorarea);
                $('#frm_basic_information #phos_adeqsanit').val(json.phos_adeqsanit);
                $('#frm_basic_information #phos_armchair').val(json.phos_armchair);
                $('#frm_basic_information #phos_bed').val(json.phos_bed);
                $('#frm_basic_information #phos_swdisposal').val(json.phos_swdisposal);
                $('#frm_basic_information #phos_toifac').val(json.phos_toifac);
                $('#frm_basic_information #phos_adeqillu').val(json.phos_adeqillu);
                $('#frm_basic_information #phos_slmcpathologi').val(json.phos_slmcpathologi);
                $('#frm_basic_information #phos_slmcmicroi').val(json.phos_slmcmicroi);
                $('#frm_basic_information #phos_qualitycont').val(json.phos_qualitycont);
                $('#frm_basic_information #phos_xrayRoom').val(json.phos_xrayRoom);
                $('#frm_basic_information #phos_squarArea').val(json.phos_squarArea);
                $('#frm_basic_information #phos_wards').val(json.phos_wards);
                $('#frm_basic_information #phos_singleroom').val(json.phos_singleroom);
                $('#frm_basic_information #phos_doubleroom').val(json.phos_doubleroom);
                $('#frm_basic_information #phos_opt').val(json.phos_opt);
                $('#frm_basic_information #phos_oparmchair').val(json.phos_oparmchair);
                $('#frm_basic_information #phos_opbed').val(json.phos_opbed);
                $('#frm_basic_information #phos_opswdisposal').val(json.phos_opswdisposal);
                $('#frm_basic_information #phos_optoifac').val(json.phos_optoifac);
                $('#frm_basic_information #phos_medium').val(json.phos_medium);
                $('#frm_basic_information #phos_mdarmchair').val(json.phos_mdarmchair);
                $('#frm_basic_information #phos_mdbed').val(json.phos_mdbed);
                $('#frm_basic_information #phos_mdswdisposal').val(json.phos_mdswdisposal);
                $('#frm_basic_information #phos_mdtoifac').val(json.phos_mdtoifac);
                $('#frm_basic_information #phos_scrubingar').val(json.phos_scrubingar);
                $('#frm_basic_information #phos_recovery').val(json.phos_recovery);
                $('#frm_basic_information #phos_cssd').val(json.phos_cssd);
                $('#frm_basic_information #phos_lbroom').val(json.phos_lbroom);
                $('#frm_basic_information #phos_emertrolly').val(json.phos_emertrolly);
                $('#frm_basic_information #phos_spotlamp').val(json.phos_spotlamp);
                $('#frm_basic_information #phos_stethoscope').val(json.phos_stethoscope);
                $('#frm_basic_information #phos_surginstrmnt').val(json.phos_surginstrmnt);
                $('#frm_basic_information #phos_adjtoilet').val(json.phos_adjtoilet);
                $('#frm_basic_information #phos_wastdispos').val(json.phos_wastdispos);
                $('#frm_basic_information #phos_etunit').val(json.phos_etunit);
                $('#frm_basic_information #phos_facilities').val(json.phos_facilities);
                $('#frm_basic_information #phos_laryngoscope').val(json.phos_laryngoscope);
                $('#frm_basic_information #phos_icuunit').val(json.phos_icuunit);
                $('#frm_basic_information #phos_icuarmchair').val(json.phos_icuarmchair);
                $('#frm_basic_information #phos_icubed').val(json.phos_icubed);
                $('#frm_basic_information #phos_icuswdisposal').val(json.phos_icuswdisposal);
                $('#frm_basic_information #phos_icutoifac').val(json.phos_icutoifac);
                $('#frm_basic_information #phos_dsname').val(json.phos_dsname);
                $('#frm_basic_information #phos_dsregno').val(json.phos_dsregno);
                $('#frm_basic_information #phos_dsassistant').val(json.phos_dsassistant);
                $('#frm_basic_information #phos_dswaitingarea').val(json.phos_dswaitingarea);
                $('#frm_basic_information #phos_dssurgeryarea').val(json.phos_dssurgeryarea);
                $('#frm_basic_information #phos_dstoiltfac').val(json.phos_dstoiltfac);
                $('#frm_basic_information #phos_dsarmchair').val(json.phos_dsarmchair);
                $('#frm_basic_information #phos_dsbed').val(json.phos_dsbed);
                $('#frm_basic_information #phos_dsswdisposal').val(json.phos_dsswdisposal);
                $('#frm_basic_information #phos_dstoifac').val(json.phos_dstoifac);
                $('#frm_basic_information #phos_disposable').val(json.phos_disposable);
                $('#frm_basic_information #phos_consumable').val(json.phos_consumable);
                $('#frm_basic_information #phos_drugstorein').val(json.phos_drugstorein);
                $('#frm_basic_information #phos_drugstoreout').val(json.phos_drugstoreout);
                $('#frm_basic_information #phos_ambservices').val(json.phos_ambservices);
                $('#frm_basic_information #phos_pantry').val(json.phos_pantry);
                $('#frm_basic_information #phos_parking').val(json.phos_parking);
                $('#frm_basic_information #phos_wastdis').val(json.phos_wastdis);

              }else if(json.ins_type_id==2){
                $('#mdCent').show();
                $('#phos').hide();
                $('#mdLab').hide();
                $('#densu').hide();
                $('#ambser').hide();
                $('#frm_basic_information #mdc_owner').val(json.mdc_owner);
                $('#frm_basic_information #mdc_nameMediDire').val(json.mdc_nameMediDire);
                $('#frm_basic_information #mdc_mdReg').val(json.mdc_mdReg);
                $('#frm_basic_information #mdc_fultimeDoc').val(json.mdc_fultimeDoc);
                $('#frm_basic_information #mdc_parttimeDoc').val(json.mdc_parttimeDoc);
                $('#frm_basic_information #mdc_nurseinchrge').val(json.mdc_nurseinchrge);
                $('#frm_basic_information #mdc_nurseReg').val(json.mdc_nurseReg);
                $('#frm_basic_information #mdc_nurse').val(json.mdc_nurse);
                $('#frm_basic_information #mdc_businessReg').val(json.mdc_businessReg);
                $('#frm_basic_information #mdc_consultRoom').val(json.mdc_consultRoom);
                $('#frm_basic_information #mdc_checkNursingHome').val(mdc_checkNursingHome.mdc_owner);
                $('#frm_basic_information #mdc_examBed').val(json.mdc_examBed);
                $('#frm_basic_information #mdc_tableChair').val(json.mdc_tableChair);
                $('#frm_basic_information #mdc_washBasin').val(json.mdc_washBasin);
                $('#frm_basic_information #mdc_weighingscale').val(json.mdc_weighingscale);
                $('#frm_basic_information #mdc_ventilation').val(json.mdc_ventilation);
                $('#frm_basic_information #mdc_sanitaryFac').val(json.mdc_sanitaryFac);
                $('#frm_basic_information #mdc_waventilation').val(json.mdc_waventilation);
                $('#frm_basic_information #mdc_smexamBed').val(json.mdc_smexamBed);
                $('#frm_basic_information #mdc_floorarea').val(json.mdc_floorarea);
                $('#frm_basic_information #mdc_saniFac').val(json.mdc_saniFac);
                $('#frm_basic_information #mdc_scarmChair').val(json.mdc_scarmChair);
                $('#frm_basic_information #mdc_scbed').val(json.mdc_scbed);
                $('#frm_basic_information #mdc_scwasteDisposal').val(json.mdc_scwasteDisposal);
                $('#frm_basic_information #mdc_scToiletFac').val(json.mdc_scToiletFac);
                $('#frm_basic_information #mdc_scadeqIllum').val(json.mdc_scadeqIllum);
                $('#frm_basic_information #mdc_xrayRoom').val(json.mdc_xrayRoom);
                $('#frm_basic_information #mdc_squarArea').val(json.mdc_squarArea);
                $('#frm_basic_information #mdc_room').val(json.mdc_room);
                $('#frm_basic_information #mdc_roomsquare').val(json.mdc_roomsquare);
                $('#frm_basic_information #mdc_armchair').val(json.mdc_armchair);
                $('#frm_basic_information #mdc_eqbeds').val(json.mdc_eqbeds);
                $('#frm_basic_information #mdc_swdis').val(json.mdc_swdis);
                $('#frm_basic_information #mdc_toifac').val(json.mdc_toifac);
                $('#frm_basic_information #mdc_adill').val(json.mdc_adill);
                $('#frm_basic_information #mdc_cssdroom').val(json.mdc_cssdroom);
                $('#frm_basic_information #mdc_cssdsquare').val(json.mdc_cssdsquare);
                $('#frm_basic_information #mdc_numbermedi').val(json.mdc_numbermedi);
                $('#frm_basic_information #mdc_vehitype').val(json.mdc_vehitype);
                $('#frm_basic_information #mdc_numbervehi').val(json.mdc_numbervehi);
                $('#frm_basic_information #mdc_wdis').val(json.mdc_wdis);

              }else if(json.ins_type_id==3){
                $('#mdLab').show();
                $('#phos').hide();
                $('#mdCent').hide();
                $('#densu').hide();
                $('#ambser').hide();
                $('#frm_basic_information #lab_person').val(json.medl_person);
                $('#frm_basic_information #lab_pathologis').val(json.medl_pathologist);
                $('#frm_basic_information #lab_path_reg').val(json.medi_path_reg);
                $('#frm_basic_information #lab_pathWh').val(json.medi_path_whether);
                $('#frm_basic_information #lab_NameMicro').val(json.medi_microbiologist);
                $('#frm_basic_information #lab_micSlmc').val(json.medi_micro_reg);
                $('#frm_basic_information #lab_micWh').val(json.medi_micro_whether);
                $('#frm_basic_information #lab_nameChemi').val(json.medi_chem_pathologist);
                $('#frm_basic_information #lab_cemSlmc').val(json.medi_chem_path_reg);
                $('#frm_basic_information #lab_cemWh').val(json.medi_whether);
                $('#frm_basic_information #lab_qtyControl').val(json.medi_qlity);
                $('#frm_basic_information #lab_faciCemi').val(json.medi_facility);
                $('#frm_basic_information #lab_disposal').val(json.medi_disposal);
                $('#frm_basic_information #lab_cembisReg').val(json.medi_br);

              }else if(json.ins_type_id==4){
                $('#ambser').show();
                $('#phos').hide();
                $('#mdCent').hide();
                $('#densu').hide();
                $('#mdLab').hide();
                $('#frm_basic_information #txtambName').val(json.txtambName);
                $('#frm_basic_information #txtNoDoctor').val(json.txtNoDoctor);
                $('#frm_basic_information #txtNoNurs').val(json.txtNoNurs);
                $('#frm_basic_information #txtnoAmbulance').val(txtnoAmbulance.medl_person);
                $('#frm_basic_information #txtnoModel').val(json.txtnoModel);
                $('#frm_basic_information #txtfacility').val(json.txtfacility);
                $('#frm_basic_information #txtequipment').val(json.txtequipment);
                $('#frm_basic_information #txtDriverAv').val(json.txtDriverAv);
                $('#frm_basic_information #txtRMVreg').val(json.txtRMVreg);
              }else if(json.ins_type_id==7){
                $('#densu').show();
                $('#phos').hide();
                $('#mdCent').hide();
                $('#mdLab').hide();
                $('#ambser').hide();
                $('#frm_basic_information #densu_surgeonname').val(json.densu_surgeonname);
                $('#frm_basic_information #densu_surgeonreg').val(json.densu_surgeonreg);
                $('#frm_basic_information #densu_assisname').val(json.densu_assisname);
                $('#frm_basic_information #densu_surgeonfull').val(json.densu_surgeonfull);
                $('#frm_basic_information #densu_prachours').val(json.densu_prachours);
                $('#frm_basic_information #densu_examBed').val(json.densu_examBed);
                $('#frm_basic_information #densu_tableChair').val(json.densu_tableChair);
                $('#frm_basic_information #densu_washBasin').val(json.densu_washBasin);
                $('#frm_basic_information #densu_weighingscale').val(json.densu_weighingscale);
                $('#frm_basic_information #densu_ventilation').val(json.densu_ventilation);
                $('#frm_basic_information #densu_needles').val(json.densu_needles);
                $('#frm_basic_information #densu_siringer').val(json.densu_siringer);
                $('#frm_basic_information #densu_mask').val(json.densu_mask);
                $('#frm_basic_information #densu_gloves').val(json.densu_gloves);
                $('#frm_basic_information #densu_cups').val(json.densu_cups);
                $('#frm_basic_information #densu_apron').val(json.densu_apron);
                $('#frm_basic_information #densu_consumaterial').val(json.densu_consumaterial);
                $('#frm_basic_information #densu_prosthetic').val(json.densu_prosthetic);
                $('#frm_basic_information #densu_adeqwater').val(json.densu_adeqwater);
                $('#frm_basic_information #densu_hygenicdispos').val(json.densu_hygenicdispos);
                $('#frm_basic_information #densu_sysrecords').val(json.densu_sysrecords);
                $('#frm_basic_information #densu_patientwaiting').val(json.densu_patientwaiting);
                $('#frm_basic_information #densu_receptionarea').val(json.densu_receptionarea);
                $('#frm_basic_information #densu_surgeryarea').val(json.densu_surgeryarea);
                $('#frm_basic_information #densu_adeqtoilt').val(json.densu_adeqtoilt);
                $('#frm_basic_information #densu_modexamBed').val(json.densu_modexamBed);
                $('#frm_basic_information #densu_modtableChair').val(json.densu_modtableChair);
                $('#frm_basic_information #densu_modwashBasin').val(json.densu_modwashBasin);
                $('#frm_basic_information #densu_modweighingscale').val(json.densu_modweighingscale);
                $('#frm_basic_information #densu_modventilation').val(json.densu_modventilation);
                $('#frm_basic_information #densu_modneedles').val(json.densu_modneedles);
                $('#frm_basic_information #densu_modsiringer').val(json.densu_modsiringer);
                $('#frm_basic_information #densu_modmask').val(json.densu_modmask);
                $('#frm_basic_information #densu_modgloves').val(json.densu_modgloves);
                $('#frm_basic_information #densu_modcups').val(json.densu_modcups);
                $('#frm_basic_information #densu_modapron').val(json.densu_modapron);
                $('#frm_basic_information #densu_modconsumaterial').val(json.densu_modconsumaterial);
                $('#frm_basic_information #densu_modprosthetic').val(json.densu_modprosthetic);
                $('#frm_basic_information #densu_modadeqwater').val(json.densu_modadeqwater);
                $('#frm_basic_information #densu_modhygenicdispos').val(json.densu_modhygenicdispos);
                $('#frm_basic_information #densu_modsysrecords').val(json.densu_modsysrecords);
                $('#frm_basic_information #densu_autoclaves').val(json.densu_autoclaves);
                $('#frm_basic_information #densu_lightcure').val(json.densu_lightcure);
                $('#frm_basic_information #densu_scalars').val(json.densu_scalars);
                $('#frm_basic_information #densu_airrotors').val(json.densu_airrotors);
                $('#frm_basic_information #densu_xrayfaci').val(json.densu_xrayfaci);
                $('#frm_basic_information #densu_amalgamators').val(json.densu_amalgamators);
                $('#frm_basic_information #densu_intracam').val(json.densu_intracam);
                $('#frm_basic_information #densu_refrigerator').val(json.densu_refrigerator);
                $('#frm_basic_information #densu_storagefaci').val(json.densu_storagefaci);
                $('#frm_basic_information #densu_excelneedles').val(json.densu_excelneedles);
                $('#frm_basic_information #densu_excelsiringer').val(json.densu_excelsiringer);
                $('#frm_basic_information #densu_excelmask').val(json.densu_excelmask);
                $('#frm_basic_information #densu_excelgloves').val(json.densu_excelgloves);
                $('#frm_basic_information #densu_excelcups').val(json.densu_excelcups);
                $('#frm_basic_information #densu_excelapron').val(json.densu_excelapron);
                $('#frm_basic_information #densu_excelrestorative').val(json.densu_excelrestorative);
                $('#frm_basic_information #densu_excelprosthetic').val(json.densu_excelprosthetic);
              }else{
                $('#densu').hide();
                $('#phos').hide();
                $('#mdCent').hide();
                $('#mdLab').hide();
                $('#ambser').hide();
              }
              //|| json.ins_type_id==8
              $('#instype_id #insTypeId').val(json.ins_type_id);

              $('#frm_basic_information #txtambName').val(json.txtambName);
              $('#frm_basic_information #txtNoDoctor').val(json.txtNoDoctor);
              $('#frm_basic_information #txtNoNurs').val(json.txtNoNurs);
              $('#frm_basic_information #txtnoAmbulance').val(json.txtnoAmbulance);
              $('#frm_basic_information #txtnoModel').val(json.txtnoModel);
              $('#frm_basic_information #txtfacility').val(json.txtfacility);
              $('#frm_basic_information #txtequipment').val(json.txtequipment);
              $('#frm_basic_information #txtDriverAv').val(json.txtDriverAv);
              $('#frm_basic_information #txtRMVreg').val(json.txtRMVreg);

            
              $('#frm_basic_information #txtdlName').val(json.txtdlName);
              $('#frm_basic_information #txtdlTName').val(json.txtdlTName);
              $('#frm_basic_information #txtQlifications').val(json.txtQlifications);
              $('#frm_basic_information #txtfaciAv').val(json.txtfaciAv);
              $('#frm_basic_information #txtwastDisposal').val(json.txtwastDisposal);
              $('#frm_basic_information #txtbusinessReg').val(json.txtbusinessReg);

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
//	$('#frm_basic_information #cboSearch').trigger('change');
}
// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}


