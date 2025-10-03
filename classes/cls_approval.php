<?php

class cls_approval
{
	
	private $db;
	private $userComId;
	private $userLocId;
	private $userId;
    public $leave;
	public $cr;
    public $employeeId;
	
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
        $this->leave = false;
		$this->cr= false;
        $this->employeeId = '';
	}

    // ===========================================================
    public function getReferenceId($approveId)
	{      
      $sql = "select a.apl_reference_id from sys_trn_approval a where a.apl_id='$approveId' and a.apl_company_id='$this->userComId'";
      $result = $this->db->runQuery($sql);
      if($row = mysqli_fetch_array($result)){
        return $row['apl_reference_id'];
      }
      else{
        throw new Exception("Invalid Reference.");
      }
    }
    // ===========================================================
    // $targetOfficer == Employee Id
    public function newApprovalEntrySpecified($type, $referenceId, $referenceNo, $targetOfficer)
	{      
      $finalStat = false;
      $sql = "select t.apt_id, t.apt_depth, t.apt_priviledges_page_id from sys_approval_types t where t.apt_name='$type'";
      $result = $this->db->runQuery2($sql);
      if($row = mysqli_fetch_array($result)){
        $typeId = $row['apt_id'];
        $pageId = $row['apt_priviledges_page_id'];
      }
      else{
        throw new Exception("Approve Type is not defined.");
      }
      // Previous Alocated approval entry
      $sql = "select apl_id
              from sys_trn_approval
              where `apl_approval_type_id`='$typeId' and `apl_reference_id`='$referenceId' and `apl_company_id`='$this->userComId'";
      $result = $this->db->runQuery2($sql);
      while($row = mysqli_fetch_array($result)){
        $oldApproveId = $row['apl_id'];
        // delete previous approval entry
        $sql = "update `sys_trn_approval`
                set 
                  `apl_remarks` = 'New approval entry is raised.',
                  `apl_is_deleted` = '1',
                  `apl_deleted_by` = '$this->userId',
                  `apl_deleted_on` = now() 
                where `apl_id`='$oldApproveId'";
        $this->db->runQuery2($sql);
        // Delete attention History
        $sql = "update `sys_trn_approval_attention`
                set 
                  `apn_remarks` = 'New approval entry is raised.',
                  `apn_is_deleted` = '1',
                  `apn_deleted_by` = '$this->userId',
                  `apn_deleted_on` = now()
                where `apn_approval_id`='$oldApproveId' and `apn_company_id`='$this->userComId';";
        $this->db->runQuery2($sql);
      }

      // get relevant users
      $sql = "select p.intUserId
              from menupermision p
                  inner join sys_users u on p.intUserId=u.intUserId
              where p.intMenuId='$pageId' and p.int1Approval='1' and u.empId='$targetOfficer'";
      $result = $this->db->runQuery2($sql); 
      if(mysqli_num_rows($result)>0){
         
        // Insert New approval Entry
        $sql = "insert into `sys_trn_approval`
                    (`apl_approval_type_id`, `apl_level`, `apl_reference_id`, `apl_reference_no`, `apl_remarks`, 
                      `apl_status`, `apl_is_deleted`, `apl_company_id`, `apl_created_by`, `apl_created_on`)
                values 
                    ('$typeId', '1', '$referenceId', '$referenceNo', 'New Approval Entry',
                       '1', '0', '$this->userComId', '$this->userId', now())
                ";	
        $this->db->runQuery2($sql);
        $approveId = $this->db->insertId;
        // Assign to users
        while($row = mysqli_fetch_array($result)){
          $attentionId = $row['intUserId'];
          $sql = "insert into `sys_trn_approval_attention`
                      (`apn_approval_id`, `apn_user_id`, `apn_remarks`, 
                        `apn_status`, `apn_is_deleted`, `apn_company_id`, `apn_created_by`, `apn_created_on`)
                  values 
                      ('$approveId', '$attentionId', 'Initial Attention', 
                         '1', '0', '$this->userComId', '$this->userId', now())
                  ";	
          $this->db->runQuery2($sql);
        }
      }
      else{
        throw new Exception("The permissions are not allocated. ($type)");
      }
      $finalStat = true;
      return $finalStat;
	}
//--------------------------------------------------------------------------------------------
    // ===========================================================
    // $approveHimSelf :: true || false
    public function newApprovalEntry($type, $referenceId, $referenceNo, $approveHimSelf)
	{      
      $finalStat = false;
      $sql = "select t.apt_id, t.apt_depth, t.apt_priviledges_page_id from sys_approval_types t where t.apt_name='$type'";
      $result = $this->db->runQuery2($sql);
      if($row = mysqli_fetch_array($result)){
        $typeId = $row['apt_id'];
        $pageId = $row['apt_priviledges_page_id'];
      }
      else{
        throw new Exception("Approve Type is not defined.");
      }
      // Previous Alocated approval entry
      $sql = "select apl_id
              from sys_trn_approval
              where `apl_approval_type_id`='$typeId' and `apl_reference_id`='$referenceId' and `apl_company_id`='$this->userComId'";
      $result = $this->db->runQuery2($sql);
      while($row = mysqli_fetch_array($result)){
        $oldApproveId = $row['apl_id'];
        // delete previous approval entry
        $sql = "update `sys_trn_approval`
                set 
                  `apl_remarks` = 'New approval entry is raised.',
                  `apl_is_deleted` = '1',
                  `apl_deleted_by` = '$this->userId',
                  `apl_deleted_on` = now() 
                where `apl_id`='$oldApproveId'";
        $this->db->runQuery2($sql);
        // Delete attention History
        $sql = "update `sys_trn_approval_attention`
                set 
                  `apn_remarks` = 'New approval entry is raised.',
                  `apn_is_deleted` = '1',
                  `apn_deleted_by` = '$this->userId',
                  `apn_deleted_on` = now()
                where `apn_approval_id`='$oldApproveId' and `apn_company_id`='$this->userComId';";
        $this->db->runQuery2($sql);
      }

      //Prevent Him Self Approval
      $where = "";
      if(!$approveHimSelf)$where = " and intUserId!='$this->userId'";
      
      // get relevant users
      //---------------------------------
      if($this->leave){
        $sql = "select p.intUserId, u.intDepartmentId
                from menupermision p
                    inner join adm_trn_leave_approve l on p.intUserId=l.lap_user_id and l.lap_company_id='$this->userComId' and l.lap_is_deleted='0'
                    inner join sys_users u on l.lap_user_id=u.intUserId
                where p.intMenuId='$pageId' and p.int1Approval='1' and u.empId!='$this->employeeId' and 
                    u.intDepartmentId in (select d.dpt_id
                          from hrm_mst_department d 
                          where l.lap_restrict_department='0' or 
                                  (d.dpt_id in (select u2.intDepartmentId from sys_users u2 where u2.empId='$this->employeeId')))";
      }
      else{
        $sql = "select p.intUserId
                from menupermision p
                where p.intMenuId='$pageId' and p.int1Approval='1' $where";
      }
      $result = $this->db->runQuery2($sql); 
      if(mysqli_num_rows($result)>0){
         
        // Insert New approval Entry
        $sql = "insert into `sys_trn_approval`
                    (`apl_approval_type_id`, `apl_level`, `apl_reference_id`, `apl_reference_no`, `apl_remarks`, 
                      `apl_status`, `apl_is_deleted`, `apl_company_id`, `apl_created_by`, `apl_created_on`)
                values 
                    ('$typeId', '1', '$referenceId', '$referenceNo', 'New Approval Entry',
                       '1', '0', '$this->userComId', '$this->userId', now())
                ";	
        $this->db->runQuery2($sql);
        $approveId = $this->db->insertId;
        // Assign to users
        while($row = mysqli_fetch_array($result)){
          $attentionId = $row['intUserId'];
          $sql = "insert into `sys_trn_approval_attention`
                      (`apn_approval_id`, `apn_user_id`, `apn_remarks`, 
                        `apn_status`, `apn_is_deleted`, `apn_company_id`, `apn_created_by`, `apn_created_on`)
                  values 
                      ('$approveId', '$attentionId', 'Initial Attention', 
                         '1', '0', '$this->userComId', '$this->userId', now())
                  ";	
          $this->db->runQuery2($sql);
        }
      }
      else{
        throw new Exception("The permissions are not allocated. ($type)");
      }
      $finalStat = true;
      return $finalStat;
	}
//--------------------------------------------------------------------------------------------
//============================================================================================
	public function approve($approveId, $referenceId, $remarks)
	{
        $sql = "select a.apl_id, a.apl_level, a.apl_approval_type_id, s.apt_depth, s.apt_priviledges_page_id, s.apt_next_approval_query, s.apt_complete_approval_query, a.apl_reference_no
                from sys_trn_approval a
                    inner join sys_trn_approval_attention t on a.apl_id=t.apn_approval_id
                    inner join sys_approval_types s on a.apl_approval_type_id=s.apt_id
                where a.apl_is_deleted='0' and t.apn_is_deleted='0' and a.apl_id='$approveId' and a.apl_reference_id='$referenceId' and t.apn_user_id='$this->userId' and a.apl_company_id='$this->userComId' and a.apl_status not in (0, 10, 20)";	
		$result = $this->db->runQuery2($sql);
		if($row = mysqli_fetch_array($result)){
          $approveId = $row['apl_id'];
          $currentLevel = $row['apl_level'];
          $referenceNo = $row['apl_reference_no'];
          $typeId = $row['apl_approval_type_id'];
          $approvalDepth = $row['apt_depth'];
          $referencePageId = $row['apt_priviledges_page_id'];
          $nextApprovalQuery = $row['apt_next_approval_query'];
          $completeApprovalQuery = $row['apt_complete_approval_query'];
          
          if($remarks==""){$remarks = "Approve";}
          // Insert Approve LogApprove
          $sql = "insert into `sys_trn_approval_log`
                      (`apv_approval_id`, `apv_user_id`, `apv_level`, `apv_remarks`, 
                        `apv_status`, `apv_is_deleted`, `apv_company_id`, `apv_created_by`, `apv_created_on`)
                  values
                      ('$approveId', '$this->userId', '$currentLevel', '$remarks', 
                        '1', '0', '$this->userComId', '$this->userId', now())";
          $this->db->runQuery2($sql);
          
          // Update approval Status
          $sql = "update `sys_trn_approval`
                  set 
                    `apl_status` = '20',
                    `apl_last_modified_by` = '$this->userId',
                    `apl_last_modified_on` = now()
                  where `apl_id` = '$approveId';";
          $this->db->runQuery2($sql);
          
          // Pass to next Approval if Needed
          // ==========================================
          // Check Approval Level
          if($approvalDepth > $currentLevel){
            // Check anyone has provisions to next approve
            $nextApprovalLevel = $currentLevel + 1;
            $approveLevelFieldName = "int".$nextApprovalLevel."Approval";
            $sql = "select p.intUserId
                    from menupermision p
                        inner join sys_users u on p.intUserId=u.intUserId
                        inner join hrm_mst_designation d on u.intDesignation=d.des_id
                    where p.intMenuId='$referencePageId' and p.$approveLevelFieldName='1' and 
                      d.des_rank <= (select d1.des_rank 
                                      from sys_users u1 
                                      inner join hrm_mst_designation d1 on u1.intDesignation=d1.des_id
                                      where u1.intUserId='$this->userId')";
            $result = $this->db->runQuery2($sql); 
            if(mysqli_num_rows($result)>0){
              // Insert Next approval Entry
              $sql = "insert into `sys_trn_approval`
                          (`apl_approval_type_id`, `apl_level`, `apl_reference_id`, `apl_reference_no`, `apl_remarks`, 
                            `apl_status`, `apl_is_deleted`, `apl_company_id`, `apl_created_by`, `apl_created_on`)
                      values 
                          ('$typeId', '$nextApprovalLevel', '$referenceId', '$referenceNo', 'Next Approval Entry',
                             '1', '0', '$this->userComId', '$this->userId', now())
                      ";	
              $this->db->runQuery2($sql);
              $newApproveId = $this->db->insertId;
              // Assign to users
              while($row = mysqli_fetch_array($result)){
                $attentionId = $row['intUserId'];
                $sql = "insert into `sys_trn_approval_attention`
                            (`apn_approval_id`, `apn_user_id`, `apn_remarks`, 
                              `apn_status`, `apn_is_deleted`, `apn_company_id`, `apn_created_by`, `apn_created_on`)
                        values 
                            ('$newApproveId', '$attentionId', 'Next Level Attention', 
                               '1', '0', '$this->userComId', '$this->userId', now())
                        ";	
                $this->db->runQuery2($sql);
              }
              // Update Next Level query
              $sql = str_replace("{id}", $referenceId, $nextApprovalQuery);
              $this->db->runQuery2($sql);
            }
            else{
              // Update complete query
              $sql = str_replace("{id}", $referenceId, $completeApprovalQuery);
              $this->db->runQuery2($sql);
//              throw new Exception("The permissions are not allocated.");
            }
          }
          else{
            // Update complete query
            $sql = str_replace("{id}", $referenceId, $completeApprovalQuery);
            $this->db->runQuery2($sql);
          }
		  if($this->cr){
			  $comment='CR Approved by';
				
				$sql1="INSERT INTO zhis_cr_log (cr_id,cr_no,comment,description,intCompanyId,strType,dtmDateUpdateOrDelete,intUserUpdateOrDelete)
VALUES
('{id}','$referenceNo','','$comment','$this->userComId','APPROVED',now(),'$this->userId')";
				$this->db->runQuery2($sql1);
			  }
        }
        else{
          throw new Exception("You don't have permissions to approve this.");
        }
        return true;
	}
//--------------------------------------------------------------------------------------------
//============================================================================================
	public function reject($approveId, $referenceId, $remarks)
	{
        $sql = "select a.apl_id, a.apl_level, a.apl_approval_type_id, s.apt_depth, s.apt_priviledges_page_id, s.apt_rejected_approval_query, a.apl_reference_no
                from sys_trn_approval a
                    inner join sys_trn_approval_attention t on a.apl_id=t.apn_approval_id
                    inner join sys_approval_types s on a.apl_approval_type_id=s.apt_id
                where a.apl_is_deleted='0' and t.apn_is_deleted='0' and a.apl_id='$approveId' and a.apl_reference_id='$referenceId' and t.apn_user_id='$this->userId' and a.apl_company_id='$this->userComId' and a.apl_status not in (0, 10, 20)";	
		$result = $this->db->runQuery2($sql);
		if($row = mysqli_fetch_array($result)){
          $approveId = $row['apl_id'];
          $currentLevel = $row['apl_level'];
          $typeId = $row['apl_approval_type_id'];
          $approvalDepth = $row['apt_depth'];
          $referencePageId = $row['apt_priviledges_page_id'];
          $rejectApprovalQuery = $row['apt_rejected_approval_query'];
          if($remarks==""){$remarks = "Rejected";}
          
          // Insert Rejected Log
          $sql = "insert into `sys_trn_approval_log`
                      (`apv_approval_id`, `apv_user_id`, `apv_level`, `apv_remarks`, 
                        `apv_status`, `apv_is_deleted`, `apv_company_id`, `apv_created_by`, `apv_created_on`)
                  values
                      ('$approveId', '$this->userId', '$currentLevel', '$remarks', 
                        '1', '0', '$this->userComId', '$this->userId', now())";
          $this->db->runQuery2($sql);
          
          // Update Rejected Status
          $sql = "update `sys_trn_approval`
                  set 
                    `apl_status` = '10',
                    `apl_last_modified_by` = '$this->userId',
                    `apl_last_modified_on` = now()
                  where `apl_id` = '$approveId';";
          $this->db->runQuery2($sql);
          
          // Update reject query
          $sql = str_replace("{id}", $referenceId, $rejectApprovalQuery);
          $this->db->runQuery2($sql);
        }
        else{
          throw new Exception("You don't have permissions to reject this.");
        }
        return true;
	}
}
?>