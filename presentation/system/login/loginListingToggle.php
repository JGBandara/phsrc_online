<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-17
 */
?><div class="modal fade" id="sys_trn_loginToggleModal" tabindex="-1" role="dialog" aria-labelledby="toggleModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listingToggleModalTitle">Login : Toggle column visibility</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">

            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="1"><?php echo $model->attributeLabels()['tlg_user_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="2"><?php echo $model->attributeLabels()['tlg_company_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="3"><?php echo $model->attributeLabels()['tlg_location_id'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="4"><?php echo $model->attributeLabels()['tlg_ip_address'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="5"><?php echo $model->attributeLabels()['tlg_login_datetime'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="6"><?php echo $model->attributeLabels()['tlg_login_out_datetime'];?></a>            
            </div>
    
            <div class="form-group float-left mr-2 mb-1">
              <a class="toggle-vis btn btn-outline-warning" data-column="7"><?php echo $model->attributeLabels()['tlg_remarks'];?></a>            
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
