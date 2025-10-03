<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
 */
use presentation\hrm\classes\cls_hrm_trn_language_skills;
//$model = new cls_hrm_trn_language_skills($db);
  
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle"> Language Skills</h5>
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
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_language_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLanguage();?></label>
        </div>
     
        <div class="form-group row mb-0">
            <div class="col text-info"><hr></div>
        </div>

        <div class="form-group row mb-0">
          <div class="col-sm-6 col-form-label-sm label">Skill Type</div>
          <div class="col-sm-6 col-form-label-sm label">Merit</div>
        </div>
        
        <?php
          $modelLanguageSkill = new cls_hrm_trn_language_skills($db);
          $modelLanguageSkill->lgs_is_deleted = 0;
          $modelLanguageSkill->lgs_employee_id = $model->lgs_employee_id;
          $modelLanguageSkill->lgs_language_id = $model->lgs_language_id;
          $modelLanguageSkill->lgs_company_id = $model->lgs_company_id;
          $modelSkills = $modelLanguageSkill->getModels();

          foreach ($modelSkills as $modelLanguageSkill) {
            ?>
        <div class="row">
          <div class="col-sm-6 col-form-label-sm data"><?php echo $modelLanguageSkill->getSkill();?></div>
          <div class="col-sm-6  col-form-label-sm data"><?php echo $modelLanguageSkill->getMerit();?></div>
        </div>
            <?php
          }
        ?>

        <div class="row">
            <div class="col text-info"><hr></div>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_remarks'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->lgs_remarks;?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_status'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getStatus();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_is_deleted'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getIsDeleted();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_company_id'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCompany();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_created_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_created_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getCreatedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_last_modified_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_last_modified_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getLastModifiedOn();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_deleted_by'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedBy();?></label>
        </div>
     
        <div class="form-group row mb-0">
          <label class="col-sm-2 col-form-label-sm label"><?php echo $model->attributeLabels()['lgs_deleted_on'];?></label>
          <label class="col-sm-10 col-form-label-sm data"><?php echo $model->getDeletedOn();?></label>
        </div>
                              
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
