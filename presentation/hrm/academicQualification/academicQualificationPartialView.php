<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
use presentation\hrm\classes\cls_hrm_trn_academic_qualification;
use presentation\hrm\classes\cls_hrm_trn_academic_qualification_details;
//$model = new cls_hrm_trn_academic_qualification($db);
$modelDetails = new cls_hrm_trn_academic_qualification_details($db);
  
?><div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="partialViewModalTitle"> Academic Qualification</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="card">
      <div class="card-body">
 
              <div class="row"> 
                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom">Employee No</div>
                <div class="col-sm-4 p-2"><?php echo $model->getEmployeeInformation()->emi_no;?></div>

                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom">Calling Name</div>
                <div class="col-sm-4 p-2"><?php echo $model->getEmployeeInformation()->emi_calling_name;?></div>
              </div> 
              <div class="row"> 
                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_type_id'];?></div>
                <div class="col-sm-4 p-2"><?php echo $model->getType();?></div>
                
                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_stream_id'];?></div>
                <div class="col-sm-4 p-2"><?php echo $model->getStream();?></div>
              </div> 
              <div class="row"> 
                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_year'];?></div>
                <div class="col-sm-4 p-2"><?php echo $model->eaq_year;?></div>
       
                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_index_no'];?></div>
                <div class="col-sm-4 p-2"><?php echo $model->eaq_index_no;?></div>
              </div> 
              <div class="row"> 
                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_institute'];?></div>
                <div class="col-sm-10 p-2"><?php echo $model->eaq_institute;?></div>
              </div> 
              <div class="row"> 
                <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_remarks'];?></div>
                <div class="col-sm-10 p-2"><?php echo $model->eaq_remarks;?></div>
      </div> 
              <div class="row"> 
                <div class="col-sm-6">&nbsp;</div>
              </div>                          
            <div class="row p-1 border-dark border-bottom border-2 mb-2">
                <div class="col"><hr></div>
                <div class="col-auto h3">Details</div>
                <div class="col"><hr></div>
            </div>
            <div class="row">
 
              <div class="col-sm-4 p-2 bg-gray-200 border-white border-1 border"><?php echo $modelDetails->attributeLabels()['eaqd_subject_id'];?></div> 
              <div class="col-sm-4 p-2 bg-gray-200 border-white border-1 border"><?php echo $modelDetails->attributeLabels()['eaqd_grade'];?></div> 
              <div class="col-sm-4 p-2 bg-gray-200 border-white border-1 border"><?php echo $modelDetails->attributeLabels()['eaqd_remarks'];?></div>
            </div>
    <?php
    $detailsObjectArray = $model->getDetailModelsAcademicQualification();
    foreach ($detailsObjectArray as $detailObject) {
    ?>
            <div class="row"> 
              <div class="col-sm-4 p-1"><?php echo $detailObject->getSubject();?></div> 
              <div class="col-sm-4 p-1"><?php echo $detailObject->eaqd_grade;?></div> 
              <div class="col-sm-4 p-1"><?php echo $detailObject->eaqd_remarks;?></div>        
            </div>
  <?php
    }
    ?>
            <div class="row p-1 border-dark border-bottom border-2 mb-2">
                <div class="col"><hr></div>
            </div>
 
              <div class="row"> 
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_status'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getStatus();?></div>
     
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_is_deleted'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getIsDeleted();?></div>
            </div> 
              <div class="row"> 
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_location_id'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getLocation();?></div>
     
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_company_id'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getCompany();?></div>
            </div> 
              <div class="row"> 
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_created_by'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getCreatedBy();?></div>
     
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_created_on'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getCreatedOn();?></div>
            </div> 
              <div class="row"> 
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_last_modified_by'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getLastModifiedBy();?></div>
     
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_last_modified_on'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getLastModifiedOn();?></div>
            </div> 
              <div class="row"> 
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_deleted_by'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getDeletedBy();?></div>
     
              <div class="col-sm-2 p-2 bg-gray-200 border-white border-bottom"><?php echo $model->attributeLabels()['eaq_deleted_on'];?></div>
              <div class="col-sm-4 p-2"><?php echo $model->getDeletedOn();?></div>
            </div>                          
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
