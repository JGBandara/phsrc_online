<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
//use presentation\hrm\masterData\classes\cls_hrm_employee_residential;
//$model = new cls_hrm_employee_residential($db);
  
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle">Employee Residential Information</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="card">
      <div class="card-body">
 
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Id</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_id;?></label>
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
          <label class="col-sm-2 col-form-label-sm label">Permanent Address</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_address;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Street</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_street;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent City</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_city;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Postal Code</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_postal_code;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Telephone</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_telephone;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Mobile No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_mobile_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Email</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_email;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Country</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getPermanentCountry();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Province</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getPermanentProvince();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent District</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getPermanentDistrict();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent DS Division</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getPermanentDsDivision();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Permanent Electorate</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_permanent_electorate;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Address</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_address;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Street</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_street;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current City</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_city;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Postal Code</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_postal_code;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Telephone General Line</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_telephone_general_line;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Telephone Direct Line</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_telephone_direct_line;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Mobile No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_mobile_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Fax</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_fax;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Email</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_email;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Country</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCurrentCountry();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Province</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCurrentProvince();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current District</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCurrentDistrict();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current DS Division</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCurrentDsDivision();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Current Electorate</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_current_electorate;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Remarks</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emr_remarks;?></label>
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
