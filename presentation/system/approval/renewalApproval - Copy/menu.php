
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05
 */
//session_start();
$mainPath = $_SESSION['MAIN_PATH'];
  $intUser = $_SESSION['loginId'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));
//ob_start();
?>  <!--    ...........................................
          ......HEADER MENUS START HEAR .............
          ...........................................
  -->
<?php 
require_once($backwardSeparator.'dataAccess/connector.php');

$sql = "select syp_menu_id from sys_permission where syp_user_id= '$intUser' and syp_location_id='$userLocationId' and syp_company_id='$userCompanyId'";
$result = $db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
  $id 	= $row['syp_menu_id'];
  $menu[$id] = true;	  
}
// print_r($menu);
?> <style type="text/css">
    .logo {
      display: block;
      text-indent: -9999px;
      width: 40px;
      height: 40px;
      background: url(<?php echo $backwardSeparator;?>img/core/phsrc_gif.gif);
      background-size: 30px 38px;
      background-color: white;
    }
  </style>
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $mainPath;?>main.php">
  <!--<div class="sidebar-brand-icon rotate-n-15">-->
    <!--<i class="fas fa-list-alt"></i>-->
  <div class="sidebar-brand-icon rotate-n-15 rounded-circle logo">

  </div>
  <div class="sidebar-brand-text mx-3">Online Registration</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Home -->
<li class="nav-item active">
  <a class="nav-link" href="<?php echo $mainPath;?>main.php">
    <i class="fas fa-fw fa-home"></i>
    <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
  <!-- Heading -->
<div class="sidebar-heading">
  transaction</div>
 
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) --><!-- Heading -->
<div class="sidebar-heading">
  report</div>
 
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) --><!-- Heading -->
<div class="sidebar-heading">
  master</div>
<!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[1200] || false || $menu[1201] || $menu[1203] || $menu[1204] || $menu[1205] || $menu[1207] || $menu[1209]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNewRegistration" aria-expanded="true" aria-controls="collapseNewRegistration">
    <i class="fas fa-fw fa-list"></i>
    <span>New Registration</span>
  </a>
  <div id="collapseNewRegistration" class="collapse" aria-labelledby="headingNewRegistration" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">New Registration:</h6>-->
      
      <?php if($menu[1201] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/fpds/masterData/basicInformation/basicInformation.php">Basic Information</a>
      <?php } ?> 
            
      <?php if($menu[1203] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/fpds/masterData/staffInformation/staffInformation.php">Staff Information</a>
      <?php } ?> 
            
      <?php if($menu[1204] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/fpds/masterData/instituteInformation/instituteInformation.php">Institution Information</a>
      <?php } ?> 
            
      <?php if($menu[1205] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/fpds/masterData/InstituteFacility/InstituteFacility.php">Facilities</a>
      <?php } ?> 
            
      <?php if($menu[1207] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/fpds/masterData/employeeFiles/employeeFiles.php">Documents</a>
      <?php } ?> 
            
      <?php if($menu[1209] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/fpds/masterData/payments/payments.php">Payments</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?> 
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) --><div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
  
  <?php $_SESSION['header']= ob_get_clean();echo  $_SESSION['header'];  ?>