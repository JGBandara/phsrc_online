
<?php

$mainPath = $_SESSION['MAIN_PATH'];
  $intUser = $_SESSION['loginId'];

?>  <!--    ...........................................
          ......HEADER MENUS START HEAR .............
          ...........................................
  -->
<?php 
require_once($backwardSeparator.'dataAccess/connector.php');

$sql = "select syp_menu_id from sys_permission where syp_user_id= '$intUser'  and syp_company_id='$userCompanyId'";
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
<!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[40] || false || $menu[41] || $menu[50] || $menu[51] || $menu[52] || $menu[53] || $menu[54] || $menu[42]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseApproval" aria-expanded="true" aria-controls="collapseApproval">
    <i class="fas fa-fw fa-list"></i>
    <span>Approval</span>
  </a>
  <div id="collapseApproval" class="collapse" aria-labelledby="headingApproval" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Approval:</h6>-->
      
      <?php if($menu[41] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/approval/newRegistrationApproval/index.php">New Registration Approval</a>
      <?php } ?> 
            
      <?php if($menu[50] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/approval/checkList/basicInformation/basicInformation.php">Check List</a>
      <?php } ?> 
            
      <?php if($menu[51] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/approval/checkList/employeeFiles/employeeFiles.php">Check List Upload</a>
      <?php } ?> 
            
      <?php if($menu[52] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/approval/renewalApprovalCheck/index.php">Approval Check</a>
      <?php } ?> 
            
      <?php if($menu[53] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/approval/renewalApprovalRecommandation/index.php">Approval Recommandation</a>
      <?php } ?> 
            
      <?php if($menu[54] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/approval/renewalListing/index.php">Approval Progress</a>
      <?php } ?> 
            
      <?php if($menu[42] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/approval/renewalApproval/index.php">Renewal Approval</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?> 
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) --><!-- Heading -->
<div class="sidebar-heading">
  report</div>
<!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[30] || false || $menu[31]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAlert" aria-expanded="true" aria-controls="collapseAlert">
    <i class="fas fa-fw fa-list"></i>
    <span>Alert</span>
  </a>
  <div id="collapseAlert" class="collapse" aria-labelledby="headingAlert" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Alert:</h6>-->
      
      <?php if($menu[31] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/alert/alert.php">Listing</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?><!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[14] || false || $menu[15]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLog" aria-expanded="true" aria-controls="collapseLog">
    <i class="fas fa-fw fa-list"></i>
    <span>Log</span>
  </a>
  <div id="collapseLog" class="collapse" aria-labelledby="headingLog" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Log:</h6>-->
      
      <?php if($menu[15] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/login/login.php">System Access</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?> 
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) --><!-- Heading -->
<div class="sidebar-heading">
  master</div>
<!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[2] || false || $menu[3]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocations" aria-expanded="true" aria-controls="collapseLocations">
    <i class="fas fa-fw fa-store"></i>
    <span>Locations</span>
  </a>
  <div id="collapseLocations" class="collapse" aria-labelledby="headingLocations" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Locations:</h6>-->
      
      <?php if($menu[3] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/location/location.php">Location</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?><!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[4] || true || $menu[5] || $menu[6] || $menu[7] || $menu[8]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
    <i class="fas fa-fw fa-users"></i>
    <span>Users</span>
  </a>
  <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Users:</h6>-->
      
      <?php if($menu[5] || true){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/user/user.php">User</a>
      <?php } ?> 
            
      <?php if($menu[6] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/user/passwordReset.php">Reset Password</a>
      <?php } ?> 
            
      <?php if($menu[7] || true){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/user/passwordChange.php">Change Password</a>
      <?php } ?> 
            
      <?php if($menu[8] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/userLocation/userLocation.php">User Locations</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?><!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[9] || false || $menu[10] || $menu[11] || $menu[12] || $menu[13]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePermission" aria-expanded="true" aria-controls="collapsePermission">
    <i class="fas fa-fw fa-key"></i>
    <span>Permission</span>
  </a>
  <div id="collapsePermission" class="collapse" aria-labelledby="headingPermission" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Permission:</h6>-->
      
      <?php if($menu[10] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/permission/permission.php">Assign</a>
      <?php } ?> 
            
      <?php if($menu[11] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/role/role.php">Role</a>
      <?php } ?> 
            
      <?php if($menu[12] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/rolePermission/rolePermission.php">Role Permission</a>
      <?php } ?> 
            
      <?php if($menu[13] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/applyRole/applyRole.php">Apply Role</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?><!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[16] || false || $menu[17] || $menu[18] || $menu[19] || $menu[20] || $menu[21]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfiguration" aria-expanded="true" aria-controls="collapseConfiguration">
    <i class="fas fa-fw fa-cogs"></i>
    <span>Configuration</span>
  </a>
  <div id="collapseConfiguration" class="collapse" aria-labelledby="headingConfiguration" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Configuration:</h6>-->
      
      <?php if($menu[17] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/status/status.php">Status</a>
      <?php } ?> 
            
      <?php if($menu[18] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/company/company.php">Company</a>
      <?php } ?> 
            
      <?php if($menu[19] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/alertCategory/alertCategory.php">Alert Category</a>
      <?php } ?> 
            
      <?php if($menu[20] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/alertType/alertType.php">Alert Type</a>
      <?php } ?> 
            
      <?php if($menu[21] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/system/masterData/communicationLanguage/communicationLanguage.php">Comm. Language</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?><!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[24] || false || $menu[25]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDMS" aria-expanded="true" aria-controls="collapseDMS">
    <i class="fas fa-fw fa-list"></i>
    <span>DMS</span>
  </a>
  <div id="collapseDMS" class="collapse" aria-labelledby="headingDMS" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">DMS:</h6>-->
      
      <?php if($menu[25] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/dms/index.php">Document Category</a>
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