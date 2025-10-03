<?php

class cls_auto_number
{
	
	private $db;
	private $userComId;
	private $userLocId;
	
    /**
     * common Function Class Constructor
     * @param mixed $db
     * @param integer $userCompanyId, $userLocationId
     * @return mixed
     */
	function __construct($db, $userCompanyId, $userLocationId)
	{
		$this->db = $db;
		$this->userComId = $userCompanyId;
		$this->userLocId = $userLocationId;
	}

    // ===========================================================
    public function getAutoNo($type)
	{      
      $lockWaitDelay = 30;
      $lockValidPrevTime = time() - $lockWaitDelay; //30 secounds
        $sql = "select a.atn_id
				from sys_auto_number a
				where a.atn_company_id='$this->userComId' and a.atn_location_id='$this->userLocId' and a.atn_type='$type' and a.atn_year='".Date("Y")."'
				";	
		$result = $this->db->runQuery2($sql);
		if($row = mysqli_fetch_array($result)){
          $id = $row['atn_id'];
          
          // Check Lock Status
          $sql = "select a.atn_no
                  from sys_auto_number a
                  where a.atn_id='$id' and (a.atn_lock=0 or (a.atn_lock<'$lockValidPrevTime' && a.atn_lock=1))
                  ";	
          $resultLock = $this->db->runQuery2($sql);
          if($rowLock = mysqli_fetch_array($resultLock)){
            $no = $rowLock['atn_no'];
          }
          else{
            throw new Exception("Another Process is Executing. Pls try after ".$lockWaitDelay." seconds.");
          }
        }else{
          $no = 1;
          $sql = "insert into `sys_auto_number`
                    (`atn_type`, `atn_location_id`, `atn_company_id`, `atn_no`, `atn_year`)
                  values 
                    ('$type', '$this->userLocId', '$this->userComId', '1', '".Date("Y")."')";
          $result = $this->db->runQuery2($sql);
          $id = $this->db->insertId;
        }
		
		$sql = "UPDATE `sys_auto_number` a
                SET a.atn_no=a.atn_no+1,
                    a.atn_lock = 1,
                    a.atn_locked_on = '". time()."'
                where a.atn_id='$id'";
		$this->db->runQuery2($sql);	
		return $no;
	}
//--------------------------------------------------------------------------------------------
//============================================================================================
	public function encodeNo($no, $preFix)
	{
        $sql = "select c.com_code, l.loc_code
                from sys_companies c
                    inner join sys_locations l on c.com_id=l.loc_company_id
                where l.loc_id='$this->userLocId' and c.com_id='$this->userComId'";	
		$result = $this->db->runQuery2($sql);
		$row = mysqli_fetch_array($result);
        $comCode = $row['com_code'];
        $locCode = $row['loc_code'];
        
		$noWithFormat = $comCode."/".$locCode."/".Date("Y")."-".$preFix."/".$no;
		return $noWithFormat;
	}
    // ===========================================================
    // If Transaction Rollback , The Auto number reset
    public function setAutoNoRollback($type, $no)
	{      
      $sql = "select a.atn_id, a.atn_no-1 as 'no'
              from sys_auto_number a
              where a.atn_company_id='$this->userComId' and a.atn_location_id='$this->userLocId' and a.atn_type='$type' and a.atn_year='".Date("Y")."'
              ";	
      $result = $this->db->runQuery($sql);
      if($row = mysqli_fetch_array($result)){
        $id = $row['atn_id'];
        $reservedNo = $row['no'];
        // Check if not issued another no
        if($reservedNo == $no){
          $sql = "UPDATE `sys_auto_number` a
                  SET a.atn_no='$no',
                      a.atn_lock = 0
                  where a.atn_id='$id'";
          $this->db->runQuery($sql);	         
        }
      }
	}
    // ===========================================================
    // If Transaction Commit , The Auto number lock release
    public function setAutoNoCommit($type, $no)
	{      
      $sql = "select a.atn_id, a.atn_no-1 as 'no'
              from sys_auto_number a
              where a.atn_company_id='$this->userComId' and a.atn_location_id='$this->userLocId' and a.atn_type='$type' and a.atn_year='".Date("Y")."'
              ";	
      $result = $this->db->runQuery($sql);
      if($row = mysqli_fetch_array($result)){
        $id = $row['atn_id'];
        $reservedNo = $row['no'];
        // Check if not issued another no
        if($reservedNo == $no){
          $sql = "UPDATE `sys_auto_number` a
                  SET 
                      a.atn_lock = 0
                  where a.atn_id='$id'";
          $this->db->runQuery($sql);	         
        }
      }
	}
// ===========================================================
		public function getLatestAccPeriod($companyId)
		{
			$sql = "SELECT
					MAX(mst_financeaccountingperiod.intId) AS accId,
					mst_financeaccountingperiod.dtmStartingDate,
					mst_financeaccountingperiod.dtmClosingDate,
					mst_financeaccountingperiod.intStatus,
					mst_financeaccountingperiod_companies.intCompanyId,
					mst_financeaccountingperiod_companies.intPeriodId
					FROM
					mst_financeaccountingperiod
					Inner Join mst_financeaccountingperiod_companies ON mst_financeaccountingperiod_companies.intPeriodId = mst_financeaccountingperiod.intId
					WHERE
					mst_financeaccountingperiod_companies.intCompanyId =  '$companyId' AND mst_financeaccountingperiod.intStatus = '1'
					ORDER BY
					mst_financeaccountingperiod.intId DESC
					";	
				$result = $this->db->runQuery2($sql);
				$row = mysqli_fetch_array($result);
				$latestAccPeriodId = $row['accId'];	
				return $latestAccPeriodId;
		}
		
		public function encodeFinanceNo($invoiceNumber,$accountPeriod,$companyId,$locationId,$date,$preFix)
		{
			$sql = "SELECT
					mst_financeaccountingperiod.intId,
					mst_financeaccountingperiod.dtmStartingDate,
					mst_financeaccountingperiod.dtmClosingDate,
					mst_financeaccountingperiod.intStatus
					FROM
					mst_financeaccountingperiod
					WHERE
					mst_financeaccountingperiod.intId =  '$accountPeriod'
					";	
			$result = $this->db->runQuery2($sql);
			$row = mysqli_fetch_array($result);
			if($row['dtmStartingDate'] <= $date && $date <= $row['dtmClosingDate'])
			{
					$startDate = substr($row['dtmStartingDate'],0,4);
					$closeDate = substr($row['dtmClosingDate'],0,4);
			}
			else
			{
				$sql = "SELECT
						mst_financeaccountingperiod.intId,
						mst_financeaccountingperiod.dtmStartingDate,
						mst_financeaccountingperiod.dtmClosingDate,
						mst_financeaccountingperiod.intStatus
						FROM
						mst_financeaccountingperiod
						WHERE
						mst_financeaccountingperiod.dtmStartingDate <= '$date' AND
						mst_financeaccountingperiod.dtmClosingDate >=  '$date'
						";	
					$result = $this->db->runQuery2($sql);
					$row = mysqli_fetch_array($result);
					$startDate = substr($row['dtmStartingDate'],0,4);
					$closeDate = substr($row['dtmClosingDate'],0,4);
			}
					$sql = "SELECT
						sys_companies.com_code AS company,
						sys_companies.com_id,
						sys_locations.loc_company_id,
						sys_locations.loc_code AS location,
						sys_locations.loc_id
						FROM
						sys_companies
						Inner Join sys_locations ON sys_locations.loc_company_id = sys_companies.com_id
						WHERE
						sys_locations.loc_id =  '$locationId' AND
						sys_companies.com_id =  '$companyId'
						";
					$result = $this->db->runQuery2($sql);
					$row = mysqli_fetch_array($result);
					$companyCode = $row['company'];
					$locationCode = $row['location'];
					$invoiceFormat = $companyCode."/".$locationCode."/".$startDate."-".$preFix."/".$invoiceNumber;
					return $invoiceFormat;
		}
// ===========================================================
}
?>