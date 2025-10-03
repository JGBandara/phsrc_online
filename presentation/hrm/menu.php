
<?php

$mainPath = $_SESSION['MAIN_PATH'];
  $intUser = $_SESSION['loginId'];

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
<!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[1020] || false || $menu[1021] || $menu[1022] || $menu[1023]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQualification" aria-expanded="true" aria-controls="collapseQualification">
    <i class="fas fa-fw fa-list"></i>
    <span>Qualification</span>
  </a>
  <div id="collapseQualification" class="collapse" aria-labelledby="headingQualification" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Qualification:</h6>-->
      
      <?php if($menu[1021] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/academicQualification/academicQualification.php">Academic</a>
      <?php } ?> 
            
      <?php if($menu[1022] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/otherQualification/otherQualification.php">Other</a>
      <?php } ?> 
            
      <?php if($menu[1023] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/languageSkills/languageSkills.php">Language Skills</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?><!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[1050] || false || $menu[1051] || $menu[1052]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExtra" aria-expanded="true" aria-controls="collapseExtra">
    <i class="fas fa-fw fa-list"></i>
    <span>Extra</span>
  </a>
  <div id="collapseExtra" class="collapse" aria-labelledby="headingExtra" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Extra:</h6>-->
      
      <?php if($menu[1051] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/membership/membership.php">Memberships</a>
      <?php } ?> 
            
      <?php if($menu[1052] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/extraCurricularActivities/extraCurricularActivities.php">Curricular Activities</a>
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
<?php if($menu[1000] || false || $menu[1001] || $menu[1002] || $menu[1003] || $menu[1004] || $menu[1005] || $menu[1006] || $menu[1007] || $menu[1008] || $menu[1009] || $menu[1010] || $menu[1011] || $menu[1012]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
    <i class="fas fa-fw fa-list"></i>
    <span>Employee</span>
  </a>
  <div id="collapseEmployee" class="collapse" aria-labelledby="headingEmployee" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Employee:</h6>-->
      
      <?php if($menu[1001] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employeeInformation/employeeInformation.php">Employee Information</a>
      <?php } ?> 
            
      <?php if($menu[1002] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employeePersonal/employeePersonal.php">Personal Information</a>
      <?php } ?> 
            
      <?php if($menu[1003] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employeeResidential/employeeResidential.php">Residential Information</a>
      <?php } ?> 
            
      <?php if($menu[1004] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employeeEmergency/employeeEmergency.php">Emergency Contact</a>
      <?php } ?> 
            
      <?php if($menu[1005] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employeeBankAccount/employeeBankAccount.php">Bank Account</a>
      <?php } ?> 
            
      <?php if($menu[1006] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employeeDependence/employeeDependence.php">Dependence Information</a>
      <?php } ?> 
            
      <?php if($menu[1007] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employeeFiles/employeeFiles.php">Documents</a>
      <?php } ?> 
            
      <?php if($menu[1008] || true){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/employee/profile.php">Profile</a>
      <?php } ?> 
            
      <?php if($menu[1009] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/jobStatus/jobStatus.php">Job Status</a>
      <?php } ?> 
            
      <?php if($menu[1010] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/jobDetails/jobDetails.php">Job Details</a>
      <?php } ?> 
            
      <?php if($menu[1011] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/assignJobDuties/assignJobDuties.php">Assign Job Duties</a>
      <?php } ?> 
            
      <?php if($menu[1012] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/transportDetails/transportDetails.php">Transport Details</a>
      <?php } ?> 
      </div>
  </div>
</li>
<?php } ?><!-- Nav Item - Pages Collapse Menu -->
<?php if($menu[1030] || false || $menu[1031] || $menu[1033] || $menu[1032] || $menu[1034] || $menu[1035] || $menu[1036] || $menu[1037] || $menu[1038] || $menu[1039]){ ?><li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData" aria-expanded="true" aria-controls="collapseMasterData">
    <i class="fas fa-fw fa-list"></i>
    <span>Master Data</span>
  </a>
  <div id="collapseMasterData" class="collapse" aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header">Master Data:</h6>-->
      
      <?php if($menu[1031] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/division/division.php">Division</a>
      <?php } ?> 
            
      <?php if($menu[1033] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/serviceCategory/serviceCategory.php">Service Category</a>
      <?php } ?> 
            
      <?php if($menu[1032] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/designation/designation.php">Designation</a>
      <?php } ?> 
            
      <?php if($menu[1034] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/salaryScale/salaryScale.php">Salary Scale</a>
      <?php } ?> 
            
      <?php if($menu[1035] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/duty/duty.php">Duty</a>
      <?php } ?> 
            
      <?php if($menu[1036] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/academicQualificationType/academicQualificationType.php">Academic Qual. Type</a>
      <?php } ?> 
            
      <?php if($menu[1037] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/academicQualificationStream/academicQualificationStream.php">Academic Qual. Stream
</a>
      <?php } ?> 
            
      <?php if($menu[1038] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/otherQualificationCategory/otherQualificationCategory.php">Other Qual. Category</a>
      <?php } ?> 
            
      <?php if($menu[1039] || false){ ?>      <a class="collapse-item" href="<?php echo $mainPath;?>presentation/hrm/masterData/academicQualificationSubject/academicQualificationSubject.php">Academic Qual. Subject</a>
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