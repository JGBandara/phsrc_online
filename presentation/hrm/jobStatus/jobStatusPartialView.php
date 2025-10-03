<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
//use presentation\hrm\classes\cls_hrm_trn_job_status;
//$model = new cls_hrm_trn_job_status($db);
  
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle"> Job Status</h5>
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
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_employment_type_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEmploymentType();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_start_date'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->ejs_start_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_end_date'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->ejs_end_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_statutory_classification_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getStatutoryClassification();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_employment_category_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEmploymentCategory();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_remarks'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->ejs_remarks;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_status'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_is_deleted'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getIsDeleted();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_company_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCompany();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_created_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_created_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_last_modified_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_last_modified_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_deleted_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['ejs_deleted_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedOn();?></label>
        </div>
                              
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
