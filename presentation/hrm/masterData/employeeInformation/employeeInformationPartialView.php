<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
//use presentation\hrm\masterData\classes\cls_hrm_employee_information;
//
//$model = new cls_hrm_employee_information($db);
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle">Employee Information</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="card">
      <div class="card-body">
 
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Calling Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_calling_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Epf No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_epf_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Finger Print No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_finger_print_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Joined Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_joined_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_permanent_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Confirm Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_confirm_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Confirm Status</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getConfirmStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Medical Status</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getMedicalStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Resigned Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_resigned_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Retirement Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_retirement_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Image Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_image_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Remarks</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emi_remarks;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Status</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Is Deleted</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getIsDeleted();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Company Id</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCompany();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Created By</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Created On</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Last Modified By</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Last Modified On</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Deleted By</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Deleted On</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedOn();?></label>
        </div>
                              
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
