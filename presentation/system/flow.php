
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

	<link type="text/css" href="<?php echo $backwardSeperator;?>css/flow.css" rel="stylesheet" />
    <script type="text/javascript">
        function loadLoc(srcVal){
            document.location.assign(srcVal);
        }
        
    </script>
    <body>
        <div align="center">
          <br/>
            <div class="divFlow flowDms">

              <div class="row">
                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/upload/manualUpload.php')"
                     style="margin-left:80px; margin-top:120px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/upload_file.png)"></div>
                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/category/category.php')"
                     style="margin-left:320px; margin-top:120px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/doument_folder.png)"></div>
                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/privileges/privileges.php')"
                     style="margin-left:560px; margin-top:120px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/privileges_1.png)"></div>
              <!--====================================================-->
              <!--====================================================-->
                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/backup/downloadBackup.php')"
                     style="margin-left:80px; margin-top:320px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/backup_file.png)"></div>
                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/listing/dmsListing.php')"
                     style="margin-left:320px; margin-top:320px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/listing.png)"></div>
<!--                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/mail/mail.php')"
                     style="margin-left:320px; margin-top:320px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/mail_box.png)"></div>-->
                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/restore/backupRestore.php')"
                     style="margin-left:560px; margin-top:320px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/restore.png)"></div>
              <!--====================================================-->
              <!--====================================================-->
<!--                <div class="divItem col-1" 
                     onclick="loadLoc('<?php echo $backwardSeperator;?>presentation/dms/listing/dmsListing.php')"
                     style="margin-left:680px; margin-top:240px; background-image:url(<?php echo $backwardSeperator;?>images/flow/dms/listing.png)"></div>-->
              
            </div>
        </div>
    </body>
</html>
