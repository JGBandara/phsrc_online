<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
 */
//use presentation\hrm\masterData\classes\cls_hrm_employee_dependence;
//$model = new cls_hrm_employee_dependence($db);
  
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle">Employee Dependence Information</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="card">
      <div class="card-body">
 
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Employee No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEmployeeInformation()->emi_no;?></label>
        </div>
        
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Calling Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEmployeeInformation()->emi_calling_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_full_name'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_full_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_date_of_birth'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_date_of_birth;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_nic_no'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_nic_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_telephone'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_telephone;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_entitled_death_donation'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEntitledDeathDonation();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_entitled_medical_benifits'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEntitledMedicalBenefits();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_provident_fund_nominee'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getProvidentFundNominee();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_living'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLiving();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_work_type'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getWorkType();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_working_address'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_working_address;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_working_telephone'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_working_telephone;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_permanent_address'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_permanent_address;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_mobile'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_mobile;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_same_office'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getSameOffice();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_marital_status_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getMaritalStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_remarks'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emd_remarks;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_status'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_is_deleted'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getIsDeleted();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_company_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCompany();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_created_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_created_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_last_modified_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_last_modified_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_deleted_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['emd_deleted_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedOn();?></label>
        </div>
                              
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
