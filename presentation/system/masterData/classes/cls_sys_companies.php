<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_country;
use presentation\system\masterData\classes\cls_sys_currency;

/**
 * This is the model class for table "sys_companies".
 * @property integer $syc_id
* @property string $syc_code
* @property string $syc_name
* @property integer $syc_country_id
* @property string $syc_web_site
* @property string $syc_remarks
* @property string $syc_account_no
* @property string $syc_registration_no
* @property string $syc_vat_no
* @property string $syc_svat_no
* @property string $syc_working_day_type
* @property integer $syc_base_currency_id
* @property integer $syc_tax_applicable
* @property integer $syc_nopay_consider
* @property string $syc_menu_order
* @property integer $syc_status
* @property integer $syc_is_deleted
* @property integer $syc_created_by
* @property integer $syc_created_on
* @property integer $syc_last_modified_by
* @property integer $syc_last_modified_on
* @property integer $syc_deleted_by
* @property integer $syc_deleted_on
*/
class cls_sys_companies {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_companies';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syc_id' => 'Id', 
            'syc_code' => 'Code', 
            'syc_name' => 'Name', 
            'syc_country_id' => 'Country Id', 
            'syc_web_site' => 'Web Site', 
            'syc_remarks' => 'Remarks', 
            'syc_account_no' => 'Account No', 
            'syc_registration_no' => 'Registration No', 
            'syc_vat_no' => 'Vat No', 
            'syc_svat_no' => 'Svat No', 
            'syc_working_day_type' => 'Working Day Type', 
            'syc_base_currency_id' => 'Base Currency Id', 
            'syc_tax_applicable' => 'Tax Applicable', 
            'syc_nopay_consider' => 'Nopay Consider', 
            'syc_menu_order' => 'Menu Order', 
            'syc_status' => 'Status', 
            'syc_is_deleted' => 'Is Deleted', 
            'syc_created_by' => 'Created By', 
            'syc_created_on' => 'Created On', 
            'syc_last_modified_by' => 'Last Modified By', 
            'syc_last_modified_on' => 'Last Modified On', 
            'syc_deleted_by' => 'Deleted By', 
            'syc_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syc_id)){
      $condition[] = "syc_id='$this->syc_id'";
    }if(!is_null($this->syc_code)){
      $condition[] = "syc_code='$this->syc_code'";
    }if(!is_null($this->syc_name)){
      $condition[] = "syc_name='$this->syc_name'";
    }if(!is_null($this->syc_country_id)){
      $condition[] = "syc_country_id='$this->syc_country_id'";
    }if(!is_null($this->syc_web_site)){
      $condition[] = "syc_web_site='$this->syc_web_site'";
    }if(!is_null($this->syc_remarks)){
      $condition[] = "syc_remarks='$this->syc_remarks'";
    }if(!is_null($this->syc_account_no)){
      $condition[] = "syc_account_no='$this->syc_account_no'";
    }if(!is_null($this->syc_registration_no)){
      $condition[] = "syc_registration_no='$this->syc_registration_no'";
    }if(!is_null($this->syc_vat_no)){
      $condition[] = "syc_vat_no='$this->syc_vat_no'";
    }if(!is_null($this->syc_svat_no)){
      $condition[] = "syc_svat_no='$this->syc_svat_no'";
    }if(!is_null($this->syc_working_day_type)){
      $condition[] = "syc_working_day_type='$this->syc_working_day_type'";
    }if(!is_null($this->syc_base_currency_id)){
      $condition[] = "syc_base_currency_id='$this->syc_base_currency_id'";
    }if(!is_null($this->syc_tax_applicable)){
      $condition[] = "syc_tax_applicable='$this->syc_tax_applicable'";
    }if(!is_null($this->syc_nopay_consider)){
      $condition[] = "syc_nopay_consider='$this->syc_nopay_consider'";
    }if(!is_null($this->syc_menu_order)){
      $condition[] = "syc_menu_order='$this->syc_menu_order'";
    }if(!is_null($this->syc_status)){
      $condition[] = "syc_status='$this->syc_status'";
    }if(!is_null($this->syc_is_deleted)){
      $condition[] = "syc_is_deleted='$this->syc_is_deleted'";
    }if(!is_null($this->syc_created_by)){
      $condition[] = "syc_created_by='$this->syc_created_by'";
    }if(!is_null($this->syc_created_on)){
      $condition[] = "syc_created_on='$this->syc_created_on'";
    }if(!is_null($this->syc_last_modified_by)){
      $condition[] = "syc_last_modified_by='$this->syc_last_modified_by'";
    }if(!is_null($this->syc_last_modified_on)){
      $condition[] = "syc_last_modified_on='$this->syc_last_modified_on'";
    }if(!is_null($this->syc_deleted_by)){
      $condition[] = "syc_deleted_by='$this->syc_deleted_by'";
    }if(!is_null($this->syc_deleted_on)){
      $condition[] = "syc_deleted_on='$this->syc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syc_id, syc_code, syc_name, syc_country_id, syc_web_site, syc_remarks, syc_account_no, syc_registration_no, syc_vat_no, syc_svat_no, syc_working_day_type, syc_base_currency_id, syc_tax_applicable, syc_nopay_consider, syc_menu_order, syc_status, syc_is_deleted, syc_created_by, syc_created_on, syc_last_modified_by, syc_last_modified_on, syc_deleted_by, syc_deleted_on
          from sys_companies
          where ".$conditionStr."
          order by syc_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syc_id'].'" '; 
      if($this->syc_id == $row['syc_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syc_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syc_id)){
      $condition[] = "syc_id='$this->syc_id'";
    }if(!is_null($this->syc_code)){
      $condition[] = "syc_code='$this->syc_code'";
    }if(!is_null($this->syc_name)){
      $condition[] = "syc_name='$this->syc_name'";
    }if(!is_null($this->syc_country_id)){
      $condition[] = "syc_country_id='$this->syc_country_id'";
    }if(!is_null($this->syc_web_site)){
      $condition[] = "syc_web_site='$this->syc_web_site'";
    }if(!is_null($this->syc_remarks)){
      $condition[] = "syc_remarks='$this->syc_remarks'";
    }if(!is_null($this->syc_account_no)){
      $condition[] = "syc_account_no='$this->syc_account_no'";
    }if(!is_null($this->syc_registration_no)){
      $condition[] = "syc_registration_no='$this->syc_registration_no'";
    }if(!is_null($this->syc_vat_no)){
      $condition[] = "syc_vat_no='$this->syc_vat_no'";
    }if(!is_null($this->syc_svat_no)){
      $condition[] = "syc_svat_no='$this->syc_svat_no'";
    }if(!is_null($this->syc_working_day_type)){
      $condition[] = "syc_working_day_type='$this->syc_working_day_type'";
    }if(!is_null($this->syc_base_currency_id)){
      $condition[] = "syc_base_currency_id='$this->syc_base_currency_id'";
    }if(!is_null($this->syc_tax_applicable)){
      $condition[] = "syc_tax_applicable='$this->syc_tax_applicable'";
    }if(!is_null($this->syc_nopay_consider)){
      $condition[] = "syc_nopay_consider='$this->syc_nopay_consider'";
    }if(!is_null($this->syc_menu_order)){
      $condition[] = "syc_menu_order='$this->syc_menu_order'";
    }if(!is_null($this->syc_status)){
      $condition[] = "syc_status='$this->syc_status'";
    }if(!is_null($this->syc_is_deleted)){
      $condition[] = "syc_is_deleted='$this->syc_is_deleted'";
    }if(!is_null($this->syc_created_by)){
      $condition[] = "syc_created_by='$this->syc_created_by'";
    }if(!is_null($this->syc_created_on)){
      $condition[] = "syc_created_on='$this->syc_created_on'";
    }if(!is_null($this->syc_last_modified_by)){
      $condition[] = "syc_last_modified_by='$this->syc_last_modified_by'";
    }if(!is_null($this->syc_last_modified_on)){
      $condition[] = "syc_last_modified_on='$this->syc_last_modified_on'";
    }if(!is_null($this->syc_deleted_by)){
      $condition[] = "syc_deleted_by='$this->syc_deleted_by'";
    }if(!is_null($this->syc_deleted_on)){
      $condition[] = "syc_deleted_on='$this->syc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syc_id, syc_code, syc_name, syc_country_id, syc_web_site, syc_remarks, syc_account_no, syc_registration_no, syc_vat_no, syc_svat_no, syc_working_day_type, syc_base_currency_id, syc_tax_applicable, syc_nopay_consider, syc_menu_order, syc_status, syc_is_deleted, syc_created_by, syc_created_on, syc_last_modified_by, syc_last_modified_on, syc_deleted_by, syc_deleted_on
          from sys_companies
          where ".$conditionStr."
          order by syc_id asc";
    $result = $this->db->singleQuery($sql);

    if(mysqli_num_rows($result)){
      $arr = [];
      while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
      }
      return $arr;
    }

    return null;
  }
  /**
  * @inheritdoc
  */
  public function findModel(){
    $result = $this->getRecords();
    if(is_null($result)){
      return new self($this->db);
    }
    
    $model = new cls_sys_companies($this->db);
  
    $model->syc_id = $result[0]['syc_id'];
    $model->syc_code = $result[0]['syc_code'];
    $model->syc_name = $result[0]['syc_name'];
    $model->syc_country_id = $result[0]['syc_country_id'];
    $model->syc_web_site = $result[0]['syc_web_site'];
    $model->syc_remarks = $result[0]['syc_remarks'];
    $model->syc_account_no = $result[0]['syc_account_no'];
    $model->syc_registration_no = $result[0]['syc_registration_no'];
    $model->syc_vat_no = $result[0]['syc_vat_no'];
    $model->syc_svat_no = $result[0]['syc_svat_no'];
    $model->syc_working_day_type = $result[0]['syc_working_day_type'];
    $model->syc_base_currency_id = $result[0]['syc_base_currency_id'];
    $model->syc_tax_applicable = $result[0]['syc_tax_applicable'];
    $model->syc_nopay_consider = $result[0]['syc_nopay_consider'];
    $model->syc_menu_order = $result[0]['syc_menu_order'];
    $model->syc_status = $result[0]['syc_status'];
    $model->syc_is_deleted = $result[0]['syc_is_deleted'];
    $model->syc_created_by = $result[0]['syc_created_by'];
    $model->syc_created_on = $result[0]['syc_created_on'];
    $model->syc_last_modified_by = $result[0]['syc_last_modified_by'];
    $model->syc_last_modified_on = $result[0]['syc_last_modified_on'];
    $model->syc_deleted_by = $result[0]['syc_deleted_by'];
    $model->syc_deleted_on = $result[0]['syc_deleted_on'];
    return $model;
  }
  /**
  * @return Tax Applicable
  */
  public function getTaxApplicable(){
    return ($this->syc_tax_applicable=='1')?'Yes':'No';
  }
  /**
  * @return No Pay Consider
  */
  public function getNoPayConsider(){
    return ($this->syc_nopay_consider=='1')?'Yes':'No';
  }
  /**
  * @return Country
  */
  public function getCountry(){
    $model = new cls_sys_country($this->db);
    $model->syt_id = $this->syc_country_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syt_name;
  }
  /**
  * @return Base Currency
  */
  public function getBaseCurrency(){
    $model = new cls_sys_currency($this->db);
    $model->syy_id = $this->syc_base_currency_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_code;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syc_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syc_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syc_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syc_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syc_created_on))?$this->syc_created_on:date("Y-m-d H:i:s",$this->syc_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syc_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syc_last_modified_on))?$this->syc_last_modified_on:date("Y-m-d H:i:s",$this->syc_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syc_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syc_deleted_on))?$this->syc_deleted_on:date("Y-m-d H:i:s",$this->syc_deleted_on);
  }
}
?>

