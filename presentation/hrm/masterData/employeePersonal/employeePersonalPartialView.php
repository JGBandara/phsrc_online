<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
//use presentation\hrm\masterData\classes\cls_hrm_employee_personal;
//$model = new cls_hrm_employee_personal($db);
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle">Employee Personal Information</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="card">
      <div class="card-body">
 
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Id</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_id;?></label>
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
          <label class="col-sm-2 col-form-label-sm label">Initials</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_initials;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Middle Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_middle_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Surname</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_surname;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Name Denoted By Initials</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_name_denoted_by_initials;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Full Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_full_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Other Name</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_other_name;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">NIC No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_nic_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">NIC Issue Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_nic_issue_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Nationality</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_nationality;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Race</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_race;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Religion</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_religion;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Gender</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getGender();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Date Of Birth</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_date_of_birth;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Blood Group</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_blood_group;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Marital Status</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getMaritalStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Married Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_married_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Passport No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_passport_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Passport Type</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getPassportType();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Passport Issue Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_passport_issue_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Passport Issue Place</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_passport_issue_place;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Passport Expiry Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_passport_expiry_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Passport Countries</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_passport_countries;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Driving License No</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_driving_license_no;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Driving License Issue Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_driving_license_issue_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Driving License Expiry Date</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_driving_license_expiry_date;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Driving License Vehicle Class</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_driving_license_vehicle_class;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label">Remarks</label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->emp_remarks;?></label>
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
