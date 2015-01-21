<?
    class DeleteArticle extends SmartObject {
    	var $aArticlesDetails = null;
    	var $oArticle = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  DeleteArticle::objectPreProcessor()");

    		global $myDB, $campaign_article_id, $campaign_id, $oUser;

    		$strQuery = "SELECT * FROM cm_campaigns, cm_campaign_articles WHERE cm_campaigns.campaign_id = $campaign_id AND " .
    		  			"cm_campaign_articles.campaign_id =  cm_campaigns.campaign_id AND " .
    		  			"cm_campaign_articles.campaign_article_id = $campaign_article_id";
    		$myRS = $myDB->Query($strQuery);
    		if ($myRS !== false) {
    			if ($oTmp = $myRS->FetchNextObject(false)) {
    				if ($oUser->user_id == $oTmp->user_id) {
    					$strQuery1 = "DELETE FROM cm_campaign_articles WHERE campaign_article_id = " . $campaign_article_id;
			    		$myDB->Query($strQuery1);
			    	}
			    	else {
			    		onError("Unable to delete the article.");
			    	}
    			}
    		}
   			$this->redirectRequest("Objects.CampaignManager.EditCampaign");
   			return false;
    	}

    }
?>
