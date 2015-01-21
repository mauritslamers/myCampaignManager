<?
    class AddCampaign extends SmartObject {
    	var $aCampaignsDetails = null;
    	var $oCampaign = null;
    	var $aTemplates = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddCampaign::objectPreProcessor()");

    		global $myDB, $bSubmitted, $oUser;
    		
    		$oCollection = new ADODBDataCollection($myDB,"template");
    		$oCollection->addConditional("user_id = " . $oUser->user_id);
    		$oCollection->loadObjects();
    		$this->aTemplates = $oCollection->getCollectionAsArray();  		

    		if ($bSubmitted == 1) {
    			if ($this->insertCampaign()) {
	   			    $this->redirectRequest("Objects.CampaignManager.ListCampaigns");
    				return false;
    			}
    			else {
    				$bSubmitted = 0;
	   			    $this->redirectRequest("Objects.CampaignManager.AddCampaign");
    				return false;
    			}
    		}
    		else {
    			return true;
    		}
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddCampaign::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.AddCampaign");
    		return true;
    	}
    	function convertDate($strDate) {
    		$aDate = split('-',$strDate);
    		return $aDate[1] . "/" . $aDate[2] . "/" . $aDate[0];
    	}
    	function insertCampaign() {
    		global $campaign_name, $template_id, $myDB, $oUser;
    		if ($campaign_name == "") {
    			onError("You must enter a name.");
    		}
    		$oCampaign = new campaign($myDB);
    		$oCampaign->campaign_name = $campaign_name;
    		$oCampaign->template_id = $template_id;
    		$oCampaign->campaign_create_date = date("Y-m-d");
    		$oCampaign->user_id = $oUser->user_id;
    		return $oCampaign->insertObject();
    	}

    }
?>
