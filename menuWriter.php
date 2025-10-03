<?php
session_start(); 

$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

include "dataAccess/connector.php";
      
// Get Behaviour Order
$sql = "select syc_menu_order
        from sys_companies
        where syc_id='$userCompanyId'";
$result = $db->singleQuery($sql);
$row = mysqli_fetch_array($result);
$menuBehaviour = array_map('trim', explode(',', $row['syc_menu_order']));

// Get Modules
$sql = "select distinct(sym_module) as 'module'
          from sys_menus 
          where sym_status='1' and sym_module!='common'
          order by sym_module asc ";
$resultModules  = $db->singleQuery($sql);
while($rowModule = mysqli_fetch_array($resultModules)){
  ob_start(); 
  $moduleName = $rowModule['module'];
  echo '
<?php

$mainPath = $_SESSION[\'MAIN_PATH\'];
  $intUser = $_SESSION[\'loginId\'];

?>';
  ?>
  <!--    ...........................................
          ......HEADER MENUS START HEAR .............
          ...........................................
  -->
<?php 
  echo '<?php 
require_once($backwardSeparator.\'dataAccess/connector.php\');

$sql = "select syp_menu_id from sys_permission where syp_user_id= \'$intUser\'  and syp_company_id=\'$userCompanyId\'";
$result = $db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
  $id 	= $row[\'syp_menu_id\'];
  $menu[$id] = true;	  
}
// print_r($menu);
?>';
echo ' <style type="text/css">
    .logo {
      display: block;
      text-indent: -9999px;
      width: 40px;
      height: 40px;
      background: url(<?php echo $backwardSeparator;?>img/core/phsrc_gif.gif);
      background-size: 30px 38px;
      background-color: white;
    }
  </style>';
  ?>

<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo '<?php echo $mainPath;?>';?>main.php">
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
  <a class="nav-link" href="<?php echo '<?php echo $mainPath;?>';?>main.php">
    <i class="fas fa-fw fa-home"></i>
    <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
  <?php
//  Behaviour Order
    foreach ($menuBehaviour as $behaviour) {
?>
<!-- Heading -->
<div class="sidebar-heading">
  <?php echo $behaviour;?>
</div>
<?php
      $sql = "select * 
              from sys_menus
              where sym_parent_id = '0' and sym_status=1 and sym_show_menu=1 and sym_module='$moduleName' and sym_behaviour='$behaviour' 
              order by sym_order_by asc";
      $resultParent = $db->singleQuery($sql);
      while($rowP = mysqli_fetch_array($resultParent)){
        $parentId = $rowP['sym_id'];
        $withoutPermission = $rowP['sym_without_permission'];
        $parentName = $rowP['sym_name'];
        $controllerId = str_replace(' ', '', $parentName);
        // Get Child Menus
        $sql = "select * 
                from sys_menus
                where sym_parent_id = '$parentId' and sym_status=1 and sym_show_menu=1 and sym_module='$moduleName' and sym_behaviour='$behaviour' 
                order by sym_order_by asc";
        $resultMenu = $db->singleQuery($sql);
        $parentCondition = "";
        while($rowC = mysqli_fetch_array($resultMenu)){
          $parentCondition .= ' || $menu['.$rowC['sym_id'].']';
        }
        ?>
<!-- Nav Item - Pages Collapse Menu -->
<?php
echo '<?php if($menu['.$parentId.'] || '.($withoutPermission?'true':'false'). $parentCondition.'){ ?>';
?>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?php echo $controllerId;?>" aria-expanded="true" aria-controls="collapse<?php echo $controllerId;?>">
    <i class="fas fa-fw <?php echo $rowP['sym_awesome_icon'];?>"></i>
    <span><?php echo $parentName;?></span>
  </a>
  <div id="collapse<?php echo $controllerId;?>" class="collapse" aria-labelledby="heading<?php echo $controllerId;?>" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!--<h6 class="collapse-header"><?php echo $parentName;?>:</h6>-->
<?php
        $resultMenu = $db->singleQuery($sql);
        while($rowC = mysqli_fetch_array($resultMenu)){
          $childId = $rowC['sym_id'];
          $withoutPermission = $rowC['sym_without_permission'];
          ?>
      <?php
      echo '
      <?php if($menu['.$childId.'] || '.($withoutPermission?'true':'false').'){ ?>';
      ?>
      <a class="collapse-item" href="<?php echo '<?php echo $mainPath;?>'.$rowC['sym_url'];?>"><?php echo $rowC['sym_name'];?></a>
      <?php echo '<?php } ?> 
';?>
      <?php
        }// Menu Child Loop End
        ?>
</div>
  </div>
</li>
<?php echo '<?php } ?>';?>
<?php
      }// Parent Loop End
      echo ' 
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) -->';

    }// Behaviour Loop End
  ?>
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
  
  <?php
  echo '<?php $_SESSION[\'header\']= ob_get_clean();echo  $_SESSION[\'header\'];  ?>';
  $value = ob_get_clean();
//            echo $value;
  switch ($moduleName) {
    case "system":
      $fileName = "presentation/system/menu.php";
      break;
    case "hrm":
      $fileName = "presentation/hrm/menu.php";
      break;
    case "dms":
      $fileName = "presentation/dms/menu.php";
      break;
	case "fpds":
      $fileName = "presentation/fpds/menu.php";
      break; 
    case "fpdm":
      $fileName = "presentation/fpdm/menu.php";
      break;  
	case "fmsp":
      $fileName = "presentation/fmsp/menu.php";
      break; 
	case "pas":
      $fileName = "presentation/pas/menu.php";
      break;
	case "mcdc":
      $fileName = "presentation/mcdc/menu.php";
      break;
	case "opmi":
      $fileName = "presentation/opmi/menu.php";
      break;
	case "ppds":
      $fileName = "presentation/ppds/menu.php";
      break;
	case "pgdm":
      $fileName = "presentation/pgdm/menu.php";
      break;
	case "pmsp":
      $fileName = "presentation/pmsp/menu.php";
      break;
	case "phnh":
      $fileName = "presentation/phnh/menu.php";
      break;
	case "pml":
      $fileName = "presentation/pml/menu.php";
      break;

    default:
      break;
  }

    $file = fopen($fileName,"w");
    fwrite($file,$value);
    fclose($file);
    echo $sql1;
    echo $sql2;
    echo $fileName."<br/>";
} // Module While Loop end
        ?>
  <a href="./main.php">Goto Main</a>

