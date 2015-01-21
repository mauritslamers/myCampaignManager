<?
    class ImageUpload extends SmartObject {
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ImageUpload::objectPreProcessor()");

   			return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ImageUpload::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.ImageUpload");
    		return true;
    	}

    }
?>
