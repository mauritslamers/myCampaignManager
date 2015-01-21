<?
    class ListCampaigns extends SmartObject {
    	var $aCampaigns = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ListCampaigns::objectPreProcessor()");

    		global $myDB, $oUser;
    		
    		$oCollection = new ADODBDataCollection($myDB,"campaign");
    		$oCollection->addConditional("user_id = " . $oUser->user_id);
    		$oCollection->setOrderBy("campaign_create_date DESC");
    		$oCollection->loadObjects();
    		$this->aCampaigns = $oCollection->getCollectionAsArray();  		

    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ListCampaigns::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.ListCampaigns");
    		return true;
    	}
    	function convertDate($strDate) {
    		$aDate = split('-',$strDate);
    		return $aDate[1] . "/" . $aDate[2] . "/" . $aDate[0];
    	}

    }
?>
