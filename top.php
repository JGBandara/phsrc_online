<?php
$profileImage = $_SESSION["profileImage"];
$loggedUserName = $_SESSION["loginFullName"];

require "{$backwardSeparator}autoLoad.php";
$userLocationId = $_SESSION['locationId'];
use presentation\system\masterData\classes\cls_sys_user_location;
$modelUserLoc = new cls_sys_user_location($db);
//----------------------province---------------------------------------
//$response = file_get_contents('http://phsrc.lk/mis/api/province.php');
//---------------------------------------------------------------------
?>
<style>

.badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: red;
  color: white;
}

</style>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a>
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- ================================================= -->
    <!-- Nav Item - Alerts -->
    <!-- ------------------------------------------------- -->
    <?php
      $sql = "select *
              from sys_trn_alert 
                  inner join sys_trn_alert_notify on sal_id=san_alert_id
              where san_read_status='2' and sal_status='1' and sal_is_deleted='0' and sal_company_id='$userCompanyId' and san_user_id='$userId'";
     // $resultAlert = $db->singleQuery($sql);
      $numAlerts = mysqli_num_rows($resultAlert);
      $alertCountStr = $numAlerts;
      if($numAlerts>9){
        $alertCountStr = '9+';
      }
    ?>
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <?php
		 $sql="SELECT
count(institute_registration.ins_application_id) as appCount
FROM
institute_registration
Inner Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id and payment_is_approval=1
          order by ins_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
	
		
		 ?>
        <span style="color:#F00"> <i class="fas fa-bell fa-fw"></i></span>
        <?php } ?>
<!--         Counter - Alerts -->
        <span class="badge badge-danger badge-counter" style="display: <?php echo ($numAlerts==0)?'none':'block';?>;"><?php echo $alertCountStr;?></span>
      </a>
<!--       Dropdown - Alerts -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Alerts Center
        </h6>
        
        
        <?php
        if($userLocationId!=1){
		   $sql="SELECT
count(institute_registration.ins_application_id) as appCount
FROM
institute_registration
Inner Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id and institute_payment_detail.payment_is_approval=0 and institute_payment_detail.is_renew=0 and institute_registration.ins_province_id=$userLocationId
          order by ins_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
	
	if($row['appCount']!=0){
		
		 ?>
        <a class="dropdown-item text-center small text-gray-500" href="<?php echo $backwardSeparator;?>presentation/system/approval/newRegistrationApproval/index.php">New Registration Alerts&nbsp;&nbsp; <sup> <span class="badge"><b><?php echo $row['appCount']?></b></span></sup></a>
        <?php }
		 }?>
          <?php
		 $sql="SELECT
     count(institute_registration.ins_application_id) as appCount
     FROM
     institute_registration
     Inner Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id and institute_payment_detail.payment_is_approval=0 and institute_payment_detail.is_renew=1 and institute_registration.ins_province_id=$userLocationId
               order by ins_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
	
		
		 ?>
        <a class="dropdown-item text-center small text-gray-500" href="<?php echo $backwardSeparator;?>presentation/system/approval/renewalApproval/index.php">Renewal Registration Alerts&nbsp;&nbsp;<sup> <span class="badge"><b><?php echo $row['appCount']?></b></span></sup></a>
        <?php } 
        }else{ ?>
        <a class="dropdown-item text-center small text-gray-500" href="#">Customer Alerts</a>
        <?php } ?>
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $loggedUserName;?></span>
        <img class="img-profile rounded-circle" src="<?php echo $backwardSeparator,'img/profile/32/user.png';?>">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?php echo $backwardSeparator;?>presentation/hrm/masterData/employee/profile.php">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <a class="dropdown-item" href="<?php echo $backwardSeparator;?>presentation/system/masterData/user/passwordChange.php">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Change Password
        </a>
        <div class="dropdown-divider"></div>
        <?php
        $modelUserLoc->syo_status = 1;
        $modelUserLoc->syo_is_deleted = 0;
        $modelUserLoc->syo_user_id = $userId;
        $modelUserLoc->syo_company_id = $userCompanyId;
        $modelLocations = $modelUserLoc->getModels();
        
        foreach ($modelLocations as $modelUserLoc) {
          ?>
        <a class="dropdown-item" href="<?php echo $backwardSeparator."changeLocation.php?id=".$modelUserLoc->syo_location_id?>">
          <i class="fas <?php echo ($modelUserLoc->syo_location_id==$userLocationId)?"fa-check": "";?> fa-sm fa-fw mr-2 text-gray-400"></i>
          <?php echo $modelUserLoc->getLocation()?>
        </a>
          <?php
        }
        
        ?>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

</nav>
