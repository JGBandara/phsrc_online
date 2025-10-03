<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05
 */
session_start();
$mainPath = $_SESSION['MAIN_PATH'];
//echo $xprojectPath ;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Permission Denied</title>
<link href="<?php echo $backwardSeparator;?>css/sb-admin-2.css" rel="stylesheet"/>
<style type="text/css">
  body {
   min-height:100vh;
}

.flex-fill {
   flex:1 1 auto;
}
</style>
</head>

<body>
  <body id="page-top" class="d-flex flex-column">  
    <header>
    </header>
    <main class="container-fluid flex-fill">
      <!-- Main Content -->
      <div id="content">
        <div class="row align-top py-5">
          <div class="col-1"></div>
          <div class="card border-left-danger col-10 text-danger shadow py-2">
            <div class="text-left">
              <h1 class="h4 text-danger mb-4">Permission is Denied ...</h1>
            </div>
            <ul>
              <li>Please contact your Administrator.</li>
              <li>Please click <a href="<?php echo $mainPath;?>main.php"><span id="butClose">here</span></a> to close this page.</li>
            </ul>
          </div>
          <div class="col-1"></div>
        </div>
      </div>
    </main>
    <footer>
    </footer>

</body>
</body>
</html>
