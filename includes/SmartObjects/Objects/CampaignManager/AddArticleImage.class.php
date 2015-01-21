<?
	define("JUPLOAD_UPLOAD_DIRECTORY","/home/reclaiming/public_html/images/cm_thumbnails/");
	define("JUPLOAD_WEB_DIRECTORY","/images/cm_thumbnails/");
	
    class AddArticleImage extends SmartObject {
    	var $aCampaigns = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddArticleImage::objectPreProcessor()");
                
            global $oUser;
                
            if ($open = opendir(JUPLOAD_UPLOAD_DIRECTORY)) {
            	while (false !== ($file = readdir($open))) {
            		if ($file != "." && $file != "..") {
            			if (!is_dir(JUPLOAD_UPLOAD_DIRECTORY . $file)) {
            				$aSplit = split("-",$file);
            				if ($aSplit[0] == $oUser->user_id)
            					$this->aImages[] = $file;
            			}
            		}
            	}
            	closedir($open);
            }

    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddArticleImage::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.AddArticleImage");
    		return true;
    	}
    }
?>
