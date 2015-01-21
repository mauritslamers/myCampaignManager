<?
    class UserManager extends SmartObject {
    	var $aUsers = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  UserManager::objectPreProcessor()");

    		global $myDB, $oUser;

    		if ($oUser->user_admin) {
	    		$oCollection = new ADODBDataCollection($myDB,"user");
    			$oCollection->loadObjects();
    			$this->aUsers = $oCollection->getCollectionAsArray();
    		}
    		else {
    			$this->redirectRequest("Objects.CampaignManager.ListCampaigns");
    			return false;
    		}

    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  UserManager::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.UserManager");
    		return true;
    	}
    }
?>