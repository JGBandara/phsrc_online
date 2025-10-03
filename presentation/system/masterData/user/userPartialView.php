<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
//use presentation\system\masterData\classes\cls_sys_users;
//$model = new cls_sys_users($db);

?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle">User</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="card">
      <div class="card-body">
 
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">User Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->syu_user_name;?></label>
        </div>
          
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Full Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->syu_full_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Division</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDivision();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Contact No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->syu_contact_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Designation</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDesignation();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Email</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->syu_email;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Employee No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEmployeeInformation()->emi_no;?></label>
        </div>
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Calling Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getEmployeeInformation()->emi_calling_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Remarks</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->syu_remarks;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Status</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Company</label>
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
