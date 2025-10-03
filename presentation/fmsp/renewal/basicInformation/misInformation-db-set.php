<?php 
	
	$backwardseperator = "../../../../";
	/*$mainPath 	= $_SESSION['mainPath'];
	$userId 	= $_SESSION['userId'];*/
	$requestType 	= $_REQUEST['requestType'];
	$requstTypeSub = $_REQUEST['requstTypeSub'];
	include "{$backwardseperator}dataAccess/misconnector.php";
	$response = array('type'=>'', 'msg'=>'');
	
	/////////// parameters /////////////////////////////
	$requestType 	= $_REQUEST['requestType'];
	//$id 			= $_REQUEST['cboSearch'];

	$insId			= trim($_REQUEST['insId']);
	$mobNo	= $_REQUEST['mobNo'];
	
	/////////// location insert part /////////////////////

	/////////// location update part /////////////////////
	if($requestType=='edit')
	{
            //$mobNo='0711899110';
            $alphabet = "0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
  //$acTime =  DATE_ADD(date('Y-m-d H:i:s'), INTERVAL 30 MINUTE);
   date_default_timezone_set("Asia/Colombo");
		$start = date('Y-m-d H:i:s');
               $acTime =  date('Y-m-d H:i:s',strtotime(' +5 minutes',strtotime($start)));
   
		 $sql = "UPDATE `reg_ins_comm` SET code='".implode($pass)."',active_time='$acTime' WHERE (`institute_id`='$insId')";
		$result =mysqli_query($conn,$sql);
		if(($result)){
                    
                    $msg="Your one-time confirmation code for PHSRC system authorization is: ".implode($pass)."";
          
	 
	 require_once "{$backwardseperator}classes/ESMSWS.php";
$session=createSession('','esmsusr_1f7m','3esotc9','');
sendMessages($session,'PHSRC',$msg,array($mobNo),1); 
closeSession($session);
                    
                    
			$response['type'] 		= 'pass';
                        $response['acTime']             = $acTime;
			$response['msg'] 		= 'Updated successfully.';
		}
		else{
			$response['type'] 		= 'fail';
			$response['msg'] 		= $db->errormsg;
			$response['q'] 			=$sql;
		}
	}
	/////////// location delete part /////////////////////
	else if($requestType=='delete')
	{
		$sql = "DELETE FROM `mst_locations` WHERE (`intId`='$id')  ";
		$result = $db->RunQuery($sql);
		if(($result)){
			$response['type'] 		= 'pass';
			$response['msg'] 		= 'Deleted successfully.';
		}
		else{
			$response['type'] 		= 'fail';
			$response['msg'] 		= $db->errormsg;
			$response['q'] 			=$sql;
		}
	}
	echo json_encode($response);
?>