<?php
use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_location;
$modelCompany = new cls_sys_companies($db);
$modelLocation = new cls_sys_location($db);
?>
<?php 
	session_start();
	$projectName = $_SESSION['PROJECT_NAME'];
?>
<script type="text/javascript">
var projectName = '<?php echo $projectName; ?>' ;
</script>
<table width="100%" border="0" align="center" cellpadding="0">
  <tr>
    <td width="100%" colspan="3" style="padding-bottom: 10px;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
		<td class="tophead">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td width="15%">
                  <img src="<?php echo $backwardSeparator?>img/core/report_logo.png" alt="" class="mainImage" width="120" height="120" />
              </td>
              <td width="1%" class="normalfnt">&nbsp;</td>
              <td align="center" valign="top" width="68%" class="topheadBLACK">
          <?php
          $modelCompany->syc_id = $userCompanyId;
          $modelCompany = $modelCompany->findModel();
          
          $modelLocation->syl_id = $userLocationId;
          $modelLocation = $modelLocation->findModel();

          $companyName		= $modelCompany->syc_name;
          $locationName		= $row["syc_name"];
          $locationAddress1	= $modelLocation->syl_address;
          $locationStreet	= $modelLocation->syl_street;
          $locationCity		= $modelLocation->syl_city;
          $companyCountry	= $modelCompany->getCountry();
          $locationZipCode	= $modelLocation->syl_zip_code;
          $locationPhone	= $modelLocation->syl_phone_no;
          $locationFax		= $modelLocation->syl_fax_no;
          $locationEmail	= $modelLocation->syl_email;
          $companyWeb		= $modelCompany->syc_web_site;

          ?>
          <div style="">
            <b style="font-size: 2em;"><?php echo $companyName; ?></b><br/>
            <b style="font-size: 1em;"><?php echo $locationName; ?></b><br/>
            <p class="normalfntMid">
<?php echo $locationAddress1.", ".$locationStreet.", ".$locationCity."<br>".$companyCountry."."."<br><b>Tel : </b>".$locationPhone." <b>Fax : </b>".$locationFax." <br><b>E-Mail : </b>".$locationEmail." <br><b>Web : </b>".$companyWeb;?>
            </p>

          </div>
		</td>
		<td width="16%" class="tophead" >&nbsp;</td>
	</tr>
	</table></td>
	</tr>
	</table></td>
	</tr>
</table>