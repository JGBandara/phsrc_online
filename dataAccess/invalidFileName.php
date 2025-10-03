<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05
 */
session_start();
$mainPath = $_SESSION['MAIN_PATH'];
$backwardSeparator = "";
//echo $xprojectPath ;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invalid File Name</title>
<link href="css/sb-admin-2.css" rel="stylesheet"/>
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
              <h1 class="h4 text-danger mb-4">File Not Found ...</h1>
            </div>
            <ul>
              <li>System can't find the file.</li>
              <li>Please click <a href="<?php echo $mainPath;?>main.php"><span id="butClose">here</span></a> to go main page.</li>
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
