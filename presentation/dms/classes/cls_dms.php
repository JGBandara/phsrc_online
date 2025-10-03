<?php
namespace presentation\dms\classes ;

use presentation\dms\masterData\classes\cls_dms_file_group;
use presentation\dms\masterData\classes\cls_dms_file_category;
use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_division;
use presentation\dms\classes\cls_dms_trn_file;
use Exception;

class cls_dms{
	
	private $db;
	private $userComId;
	private $userLocId;
	private $userId;
	private $comCode;
	private $locCode;
	private $divCode;
	
    /**
     * common Function Class Constructor
     * @param mixed $db
     * @param integer $userCompanyId, $userLocationId
     * @return mixed
     */
	function __construct($db, $userCompanyId, $userLocationId, $userId){
		$this->db = $db;
		$this->userComId = $userCompanyId;
		$this->userLocId = $userLocationId;
		$this->userId = $userId;
        
        $modelCompany = new cls_sys_companies($db);
        $modelCompany->syc_id = $this->userComId;
        $modelCompany->syc_is_deleted = 0;
        $modelCompany = $modelCompany->findModel();
        $this->comCode = $modelCompany->syc_code;
          
        $modelLocation = new cls_sys_location($db);
        $modelLocation->syl_id = $this->userLocId;
        $modelLocation->syl_is_deleted = 0;
        $modelLocation = $modelLocation->findModel();
        $this->locCode = $modelLocation->syl_code;
	}

    // ===========================================================
    private function fileUploadParameters($divisionId, $documentCategoryId, $referenceId, $referenceNo){      
      // Get Division Code If Applied
       // echo 'dfd';
      if($divisionId!=""){
        $modelDivision = new cls_hrm_division($this->db);
        $modelDivision->div_id = $divisionId;
        $modelDivision->div_is_deleted = 0;
        $modelDivision->div_company_id = $this->userComId;
        $modelDivision = $modelDivision->findModel();
        $this->divCode = $modelDivision->div_code;
      }
      // Get Document Category Details
      if($documentCategoryId!=""){
          //echo 'jdjd';
          
        $modelCategory = new cls_dms_file_category($this->db);
        $modelCategory->dfc_id = $documentCategoryId;
        $modelCategory->dfc_is_deleted = 0;
        $modelCategory->dfc_company_id = $this->userComId;
        $modelCategory = $modelCategory->findModel();
        $catCode = $modelCategory->dfc_code;
        $catName = $modelCategory->dfc_name;
        $catGroupId = $modelCategory->dfc_file_group_id;
        $catType = $modelCategory->dfc_is_related_to_system;
        $metaData = $modelCategory->dfc_meta_data;
        $preFixFormat = $modelCategory->dfc_prefix_format;
        $storeLocation = $modelCategory->dfc_url;

        // Get Version No
        $modelFile = new cls_dms_trn_file($this->db);
        $modelFile->dfi_reference_id = $referenceId;
        $modelFile->dfi_reference_no = $referenceNo;
        $modelFile->dfi_file_category_id = $documentCategoryId;
        $modelFile->dfi_company_id = $this->userComId;
        $version = $modelFile->getVersionNo();
        
        // Get Category Group
        if($catGroupId!=""){
          $modelGroup = new cls_dms_file_group($this->db);
          $modelGroup->dfg_company_id = $this->userComId;
          $modelGroup->dfg_id = $catGroupId;
          $modelGroup = $modelGroup->findModel();
          $categoryGroupName = $modelGroup->dfg_name;
        }
      }
      else{
        throw new Exception("Document Category is required.");
      }
      // Generate File Name
      $preFixArray = split("-", $preFixFormat);
      $fileName = "";
      foreach ($preFixArray as $preFix) {
        
//        {company_code}-{location_code}-{division_code}-{category_code}-{id}-{version}
        if($fileName!=""){
          $fileName .= "-";
        }
        switch ($preFix) {
          case "{company_code}":
              $fileName .= $this->comCode;
            break;
          case "{location_code}":
              $fileName .= $this->locCode;
            break;
          case "{division_code}":
              $fileName .= $this->divCode;
            break;
          case "{category_code}":
              $fileName .= $catCode;
            break;
          case "{ref_no}":
              $referenceNo = str_replace("/", "_", $referenceNo);
              $fileName .= $referenceNo;
              if($referenceNo ==""){
                throw new Exception("Reference No is required.");
              }
            break;
          case "{id}":
              $fileName .= $referenceId;
              if($referenceId==0 || $referenceId ==""){
                throw new Exception("Reference ID is required.");
              }
            break;
          case "{version}":
              $fileName .= $version;
            break;
          default:
            break;
        }
      }
      $response['meta_data'] = $metaData;
      $response['store_loc'] = $storeLocation;
      $response['file_name'] = $fileName;
      $response['version'] = $version;
      $response['cat_type'] = $catType;
      $response['cat_group_name'] = $categoryGroupName;
      return $response;
    }
    // ===========================================================
    public function upload($file, $divisionId, $documentCategoryId, $referenceNo, $referenceId, $metaData, $backwardSeperator){ 
        
        
      // Get File parameters
      $fileParam = $this->fileUploadParameters($divisionId, $documentCategoryId, $referenceId, $referenceNo);
      $metaDataCat = $fileParam['meta_data'];
      $storeLocation = $fileParam['store_loc'];
     $fileName = $fileParam['file_name'];
      $version = $fileParam['version'];
      $catType = $fileParam['cat_type'];
      $catGroupName = strtolower($fileParam['cat_group_name']);

      $errors = false;
      
      // Check Folder & if not exist create new
      $splitUrl = explode("/", $storeLocation);
      $newUrl = $backwardSeperator."drive/".$catGroupName;
       $storeUrl = "drive/".$catGroupName;
      
      // make group folder
      if(!file_exists($newUrl)){
        mkdir($newUrl, 0777);
      }
      
      foreach ($splitUrl as $k=>$folder) {
        $newUrl .= "/".$folder;
        $storeUrl .= "/".$folder;
        
        if(!file_exists($newUrl)){
          mkdir($newUrl, 0777);
        }
      }

      $fileOriginalName = $file['name'];
      $file_size =$file['size'];
      $file_tmp =$file['tmp_name'];
      $file_type=$file['type'];
      $file_ext=strtolower(end(explode('.',$fileOriginalName)));
           
      // 2 MB
      if($file_size > 5242880){
        $errors = true;
        throw new Exception("Maximum file size exceeded.");
      }
      
      if($metaData==""){
        $metaData = $metaDataCat;
      }
      else if($metaDataCat!=""){
          $metaData .= ', '.$metaDataCat;
      }

      if(!$errors){
        $remarks = "System Upload";
        if($catType == "1"){
          $remarks = "Manual Upload";
        }
        $url = $newUrl.$fileName.".".$file_ext;
        $storeUrl = $storeUrl.$fileName.".".$file_ext;
        if(move_uploaded_file($file_tmp,$url)){
          // Insert New approval Entry
          $sql = "insert into `dms_trn_file`
                      (`dfi_file_name`, `dfi_file_extension`, `dfi_store_location`, `dfi_url`, `dfi_reference_no`,
                        `dfi_reference_id`, `dfi_file_category_id`, `dfi_file_version`, `dfi_meta_data`, `dfi_remarks`,
                        `dfi_status`, `dfi_is_deleted`, `dfi_company_id`, `dfi_created_by`, `dfi_created_on`)
                  values 
                      ('$fileName', '$file_ext', '".$catGroupName."/".$storeLocation."', '$storeUrl', '$referenceNo', 
                        '$referenceId', '$documentCategoryId', '$version', '$metaData', '$remarks',  
                         '1', '0', '$this->userComId', '$this->userId', '". time()."')
                  ";	
          $this->db->singleQuery($sql);
          $entryId = $this->db->insertId;
          $response['url'] = $url;
          $response['id'] = $entryId;
          $response['file_name'] = $fileName.".".$file_ext;
          return $response;
        }
      }else{
          $response['url'] = "";
          $response['id'] = "";
          return $response;
      }
	}
//--------------------------------------------------------------------------------------------
    // ===========================================================
    public function unlink($fullUrl, $dmsFileId){  
      $finalResult = true;
      if(unlink($fullUrl)){
        $sql = "update `dms_trn_file`
                set 
                  `dfi_remarks` = concat(`dfi_remarks`,' - Deleted at uploading step.'),
                  `dfi_status` = '0',
                  `dfi_is_deleted` = '1',
                  `dfi_deleted_by` = '$this->userId',
                  `dfi_deleted_on` = '". time()."'
                where `dfi_id` = '$dmsFileId';";
        $this->db->singleQuery($sql);
        return true;
      }
      return false;
	}
    // ===========================================================
    public function unlinkByUser($fullUrl, $dmsFileId){  
      $finalResult = true;
      if(unlink($fullUrl)){
        $sql = "update `dms_trn_file`
                set 
                  `dfi_remarks` = concat(`dfi_remarks`,' - Deleted by User.'),
                  `dfi_status` = '0',
                  `dfi_is_deleted` = '1',
                  `dfi_deleted_by` = '$this->userId',
                  `dfi_deleted_on` = '". time()."'
                where `dfi_id` = '$dmsFileId';";
        $this->db->singleQuery($sql);
        return true;
      }
      return false;
	}
    // ===========================================================
    public function updateRemarks($remarks, $dmsFileId){  
      $finalResult = true;
      
      $sql = "update `dms_trn_file`
              set 
                `dfi_remarks` = concat(`dfi_remarks`,'\n','$remarks'),
                `dfi_last_modified_by` = '$this->userId',
                `dfi_last_modified_on` = '". time()."'
              where `dfi_id` = '$dmsFileId';";
      $finalResult = $finalResult &&  $this->db->singleQuery($sql);

      return $finalResult;
	}
}
//--------------------------------------------------------------------------------------------
?>