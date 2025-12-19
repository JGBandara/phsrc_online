
<?php

$mainPath = $_SESSION['MAIN_PATH'];
  $intUser = $_SESSION['loginId'];

?>  <!--    ...........................................
          ......HEADER MENUS START HEAR .............
          ...........................................
  -->
<?php 
require_once($backwardSeparator.'dataAccess/connector.php');

$sql = "select syp_menu_id from sys_permission where syp_view ='1' AND syp_user_id= '$intUser'  and syp_company_id='$userCompanyId'";
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
<?php if($menu[9004] || false || $menu[9005]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUpload" aria-expanded="true" aria-controls="collapseUpload">
    <i class="fas fa-fw fa-list"></i>
    <span>Upload</span>
  </a>
  <div id="collapseUpload" class="collapse" aria-labelledby="headingUpload" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Upload:</h6>-->
      
      <?php if($menu[9005] || true){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/dms/file/file.php">Manual</a>
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
 
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) --><!-- Heading -->
<div class="sidebar-heading">
  master</div>
<!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[9000] || false || $menu[9001] || $menu[9002] || $menu[9003]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFile" aria-expanded="true" aria-controls="collapseFile">
    <i class="fas fa-fw fa-list"></i>
    <span>File</span>
  </a>
  <div id="collapseFile" class="collapse" aria-labelledby="headingFile" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">File:</h6>-->
      
      <?php if($menu[9001] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/dms/masterData/fileGroup/fileGroup.php">Group</a>
      <?php } ?> 
            
      <?php if($menu[9002] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/dms/masterData/fileCategory/fileCategory.php">Category</a>
      <?php } ?> 
            
      <?php if($menu[9003] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/dms/masterData/filePermission/filePermission.php">Permission</a>
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