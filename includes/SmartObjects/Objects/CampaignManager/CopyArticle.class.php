<?
    class CopyArticle extends SmartObject {
    	var $aCampaigns = null;
    	var $oArticle = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  CopyArticle::objectPreProcessor()");

    		global $myDB, $bSubmitted, $campaign_id, $campaign_article_id, $oUser;

    		$oArticle = new campaign_article($myDB);
    		$oArticle->loadObject("campaign_article_id",$campaign_article_id,false);
    		if ($oArticle->campaign_article_id <= 0) {
    			onError("Unable to load the specified article.");
    			$this->redirectRequest("Objects.CampaignManager.EditCampaign");
    			return false;
    		}
    		else
    			$this->oArticle = $oArticle;

    		if ($bSubmitted == 1 && $campaign_id > 0 && $campaign_article_id > 0) {
    			$this->doCopyArticle();
    			$bSubmitted = 0;
    			$this->redirectRequest("Objects.CampaignManager.EditCampaign");
    			return false;
    		}
    		else {
    			$oCollection = new ADODBDataCollection($myDB,"campaign");
    			$oCollection->addConditional("user_id = " . $oUser->user_id);
    			$oCollection->loadObjects();
    			$this->aCampaigns = $oCollection->getCollectionAsArray();
    			if (sizeof($this->aCampaigns) <= 0) {
    				onError("You must first create a new campaign.");
    				$this->redirectRequest("Objects.CampaignManager.ListCampaigns");
    				return false;
    			}

    			return true;
    		}
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  CopyArticle::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.CopyArticle");
    		return true;
    	}
    	function doCopyArticle() {
    		global $myDB, $campaign_id, $campaign_article_id;
    		$oArticle = new campaign_article($myDB);
    		$oArticle->loadObject("campaign_article_id",$campaign_article_id, false);
   			$oArticle->campaign_id = $campaign_id;
   			$oArticle->campaign_article_id = 0;
   			$nResult = $oArticle->insertObject();
   			if ($nResult === false)
    			return false;
    		else
    			return true;
    	}
    	function doCopyCampaign() {
    		global $myDB, $campaign_id;
    		$oCampaign = new campaign($myDB);
    		$oCollection = new ADODBDataCollection($myDB,"campaign_article");
    		$oCollection->addConditional("campaign_id = " . $campaign_id);
    		$oCollection->loadObjects();
    		$aArticles = $oCollection->getCollectionAsArray();
    		foreach ($aArticles as $oArticle) {
    			$oArticle->campaign_id = $nNewCampaignID;
    			$oArticle->campaign_article_id = 0;
    			$oArticle->insertObject();
    		}
    		return false;
    	}

    }
?>
