<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
?><div class="modal fade" id="hrm_trn_job_statusToggleModal" tabindex="-1" role="dialog" aria-labelledby="toggleModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listingToggleModalTitle"> Job Status : Toggle column visibility</h5>
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
              <a class="toggle-vis btn btn-outline-warning" data-column="3"><?php echo $model->attributeLabels()['ejs_employment_type_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="4"><?php echo $model->attributeLabels()['ejs_start_date'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="5"><?php echo $model->attributeLabels()['ejs_end_date'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="6"><?php echo $model->attributeLabels()['ejs_statutory_classification_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="7"><?php echo $model->attributeLabels()['ejs_employment_category_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="8"><?php echo $model->attributeLabels()['ejs_remarks'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="9"><?php echo $model->attributeLabels()['ejs_status'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="10"><?php echo $model->attributeLabels()['ejs_is_deleted'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="11"><?php echo $model->attributeLabels()['ejs_company_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="12"><?php echo $model->attributeLabels()['ejs_created_by'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="13"><?php echo $model->attributeLabels()['ejs_created_on'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="14"><?php echo $model->attributeLabels()['ejs_last_modified_by'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="15"><?php echo $model->attributeLabels()['ejs_last_modified_on'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="16"><?php echo $model->attributeLabels()['ejs_deleted_by'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="17"><?php echo $model->attributeLabels()['ejs_deleted_on'];?></a>            
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
