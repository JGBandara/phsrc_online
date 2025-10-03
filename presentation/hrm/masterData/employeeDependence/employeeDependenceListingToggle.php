<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
 */
?><div class="modal fade" id="hrm_employee_dependenceToggleModal" tabindex="-1" role="dialog" aria-labelledby="toggleModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listingToggleModalTitle">Employee Dependence Information : Toggle column visibility</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">

            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="1">Employee No</a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="2">Calling Name</a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="3"><?php echo $model->attributeLabels()['emd_full_name'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="4"><?php echo $model->attributeLabels()['emd_date_of_birth'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="5"><?php echo $model->attributeLabels()['emd_nic_no'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="6"><?php echo $model->attributeLabels()['emd_telephone'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="7"><?php echo $model->attributeLabels()['emd_entitled_death_donation'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="8"><?php echo $model->attributeLabels()['emd_entitled_medical_benifits'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="9"><?php echo $model->attributeLabels()['emd_provident_fund_nominee'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="10"><?php echo $model->attributeLabels()['emd_living'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="11"><?php echo $model->attributeLabels()['emd_work_type'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="12"><?php echo $model->attributeLabels()['emd_working_address'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="13"><?php echo $model->attributeLabels()['emd_working_telephone'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="14"><?php echo $model->attributeLabels()['emd_permanent_address'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="15"><?php echo $model->attributeLabels()['emd_mobile'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="16"><?php echo $model->attributeLabels()['emd_same_office'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="17"><?php echo $model->attributeLabels()['emd_marital_status_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="18"><?php echo $model->attributeLabels()['emd_remarks'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="19"><?php echo $model->attributeLabels()['emd_status'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="20"><?php echo $model->attributeLabels()['emd_is_deleted'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="21"><?php echo $model->attributeLabels()['emd_company_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="22"><?php echo $model->attributeLabels()['emd_created_by'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="23"><?php echo $model->attributeLabels()['emd_created_on'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="24"><?php echo $model->attributeLabels()['emd_last_modified_by'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="25"><?php echo $model->attributeLabels()['emd_last_modified_on'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="26"><?php echo $model->attributeLabels()['emd_deleted_by'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="27"><?php echo $model->attributeLabels()['emd_deleted_on'];?></a>            
            </div>
                              
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
