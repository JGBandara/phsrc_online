 <?php

class cls_reject
{
	
	private $db;
	private $userComId;
	private $userLocId;
	private $userId;
	public $cr;
	
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
		$this->cr= false;
	}

	public function reject($referenceId)
	{
   $sql = "update institute_payment_detail set payment_is_approval='0', reject_remark ='Resubmitted!' where payment_detail_institute_id='$referenceId' and payment_is_approval IN (2,12,9) ";
          $this->db->singleQuery($sql);
    }
        
	
}
?>
 
 
