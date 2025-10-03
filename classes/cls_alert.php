<?php

class cls_alert
{
	
	private $db;
	private $userComId;
	private $userLocId;
	private $userId;
    public $referenceId;
    public $typeId;
	public $remarks;
    public $notifyId;
    public $actionMultiple; // each and every person must have action for clear his alert
	
    /**
     * common Function Class Constructor
     * @param mixed $db
     * @param integer $userCompanyId, $userLocationId
     * @return mixed
     */
	function __construct($db, $userCompanyId, $userLocationId, $userId)
	{
		$this->db = $db;
		$this->userComId = $userCompanyId;
		$this->userLocId = $userLocationId;
		$this->userId = $userId;
        $this->referenceId = '';
        $this->typeId = '';
		$this->remarks = '';
        $this->notifyId = '';
        $this->actionMultiple = false;
	}

    // ===========================================================
    public function newAlert()
	{   
      $finalResult = true;
      //********************************************************************************
      // Alert
      if($this->actionMultiple){
        $sql = "update `sys_trn_alert_notify_party`
                set 
                  `rnp_status` = '0',
                  `rnp_is_deleted` = '1',
                  `rnp_last_modified_by` = '$this->userId',
                  `rnp_last_modified_on` = now()
                where rnp_alert_type_id='$this->typeId' and rnp_company_id='$this->userComId' and rnp_reference_id='$this->referenceId' and rnp_user_id='$this->userId' and rnp_status!='0' and rnp_is_deleted='0'";
      }
      else{
        $sql = "update `sys_trn_alert_notify_party`
                set 
                  `rnp_status` = '0',
                  `rnp_is_deleted` = '1',
                  `rnp_last_modified_by` = '$this->userId',
                  `rnp_last_modified_on` = now()
                where rnp_alert_type_id='$this->typeId' and rnp_company_id='$this->userComId' and rnp_reference_id='$this->referenceId' and rnp_status!='0' and rnp_is_deleted='0'";
        
      }
      $finalResult =  $finalResult && $this->db->runQuery2($sql);		

      if(is_array($this->notifyId)){
        foreach ($this->notifyId as $value) {
          if($value != "" && $value != 0){
            $sql = "insert into `sys_trn_alert_notify_party`
                        (`rnp_alert_type_id`, `rnp_user_id`, `rnp_reference_id`, `rnp_remarks`, 
                          `rnp_status`, `rnp_is_deleted`, `rnp_company_id`, `rnp_created_by`, `rnp_created_on`)
                    values
                        ('$this->typeId', '$value', '$this->referenceId', '$this->remarks',
                           '1', '0', '$this->userComId', '$this->userId', now())";
            $finalResult =  $finalResult && $this->db->runQuery2($sql);		
          }
        }
      }
      else{
        if($this->notifyId != "" && $this->notifyId != 0){
          $sql = "insert into `sys_trn_alert_notify_party`
                      (`rnp_alert_type_id`, `rnp_user_id`, `rnp_reference_id`, `rnp_remarks`, 
                        `rnp_status`, `rnp_is_deleted`, `rnp_company_id`, `rnp_created_by`, `rnp_created_on`)
                  values
                      ('$this->typeId', '$this->notifyId', '$this->referenceId', '$this->remarks',
                         '1', '0', '$this->userComId', '$this->userId', now())";
          $finalResult =  $finalResult && $this->db->runQuery2($sql);		
        }
      }
      return $finalResult;
	}
}
?>