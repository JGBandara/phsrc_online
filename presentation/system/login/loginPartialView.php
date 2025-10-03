<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-17
 */
//use presentation\system\classes\cls_sys_trn_login;
//$model = new cls_sys_trn_login($db);
  
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle">Login</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="card">
      <div class="card-body">
 
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['tlg_user_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getUser();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['tlg_company_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCompany();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['tlg_location_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLocation();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['tlg_ip_address'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->tlg_ip_address;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['tlg_login_datetime'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->tlg_login_datetime;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['tlg_login_out_datetime'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->tlg_login_out_datetime;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['tlg_remarks'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->tlg_remarks;?></label>
        </div>
                              
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
