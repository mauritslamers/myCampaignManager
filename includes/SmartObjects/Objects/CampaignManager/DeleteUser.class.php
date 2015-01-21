<?
    class DeleteUser extends SmartObject {
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  DeleteCampaign::objectPreProcessor()");

    		global $myDB, $user_id;

    		$oCollection = new ADODBDataCollection($myDB,"template");
    		$oCollection->addConditional("user_id = " . $user_id);
    		$oCollection->loadObjects();
    		$aTemplates = $oCollection->getCollectionAsArray();

    		$oCollection = new ADODBDataCollection($myDB,"campaign");
    		$oCollection->addConditional("user_id = " . $user_id);
    		$oCollection->loadObjects();
    		$aCampaigns = $oCollection->getCollectionAsArray();

    		foreach ($aCampaigns as $oCampaign) {
    		    $oCollection = new ADODBDataCollection($myDB,"campaign_article");
	    		$oCollection->addConditional("campaign_id = " . $oCampaign->campaign_id);
	    		$oCollection->loadObjects();
	    		$aArticles = $oCollection->getCollectionAsArray();
	    		foreach ($aArticles as $oArticle) {
	    			$oArticle->deleteObject();
	    		}
	    		$oCampaign->deleteObject();
    		}
    		foreach ($aTemplates as $oTemplate) {
    			$oTemplate->deleteObject();
    		}

    		$strQuery = "DELETE FROM cm_users WHERE user_id = " . $user_id;

    		$myDB->Query($strQuery);

   			$this->redirectRequest("Objects.CampaignManager.UserManager");
   			return false;
    	}

    }
?>