<?
    class ListTemplates extends SmartObject {
    	var $aTemplates = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ListTemplates::objectPreProcessor()");

    		global $myDB, $oUser;
    		
    		$oCollection = new ADODBDataCollection($myDB,"template");
    		$oCollection->addConditional("user_id = " . $oUser->user_id);
    		$oCollection->loadObjects();
    		$this->aTemplates = $oCollection->getCollectionAsArray();  		

    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ListTemplates::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.ListTemplates");
    		return true;
    	}
    }
?>
