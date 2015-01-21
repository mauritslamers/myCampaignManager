<?
    class PreviewArticle extends SmartObject {
    	var $oCampaign = null;
    	var $oArticle = null;
    	var $oTemplate = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  PreviewArticle::objectPreProcessor()");

    		global $myDB, $bSubmitted, $campaign_article_id, $campaign_id;

	      	$this->oCampaign = new campaign($myDB);
    		$this->oCampaign->loadObject("campaign_id",$campaign_id,false);

    		$this->oTemplate = new template($myDB);
    		$this->oTemplate->loadObject("template_id",$this->oCampaign->template_id,false);
    		
	   		$this->oArticle = new campaign_article($myDB);
	   		$this->oArticle->loadObject("campaign_article_id",$campaign_article_id,false);
	   		if ($this->oArticle->campaign_article_id <= 0) {
	   			onError("The specified article no longer exists.");
	   			$this->redirectRequest("Objects.CampaignManager.EditCampaign");
	   			return false;
	   		}
	    	return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  PreviewArticle::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.PreviewArticle");
    		return true;
    	}

    }
?>