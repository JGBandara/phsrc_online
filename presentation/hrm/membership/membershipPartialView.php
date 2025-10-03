<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
//use presentation\hrm\classes\cls_hrm_trn_membership;
//$model = new cls_hrm_trn_membership($db);
  
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle"> Membership</h5>
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
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_name'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->mem_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_type'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->mem_type;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_category'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->mem_category;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_date_of_commencement'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->mem_date_of_commencement;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_renewal_date'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->mem_renewal_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_remarks'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->mem_remarks;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_status'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_is_deleted'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getIsDeleted();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_company_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCompany();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_created_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_created_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_last_modified_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_last_modified_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_deleted_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['mem_deleted_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedOn();?></label>
        </div>
                              
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
