<?
    class EditCampaign extends SmartObject {
    	var $aCampaignArticles = null;
    	var $oCampaign = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditCampaign::objectPreProcessor()");

    		global $myDB, $campaign_id, $oUser;
    		
    		if ($campaign_id > 0) {
    		
	      		$oCampaign = new campaign($myDB);
	      		$aFields = array("campaign_id" => $campaign_id, "user_id" => $oUser->user_id);
    			$oCampaign->loadObjectEx($aFields,false);
    			$this->oCampaign = $oCampaign;
    			
    			$oCollection = new ADODBDataCollection($myDB,"campaign_article");
    			$oCollection->addConditional("campaign_id = " . $campaign_id);
    			$oCollection->setOrderBy("campaign_article_sort_order ASC");
    			$oCollection->loadObjects();
    			$this->aCampaignArticles = $oCollection->getCollectionAsArray();  		
    
    			return true;
    		}
    		else {
    			$this->redirectRequest("Objects.CampaignManager.ListCampaigns");
    			return false;
    		}
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditCampaign::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.EditCampaign");
    		return true;
    	}
    	function convertDate($strDate) {
    		$aDate = split('-',$strDate);
    		return $aDate[1] . "/" . $aDate[2] . "/" . $aDate[0];
    	}

    }
?>
