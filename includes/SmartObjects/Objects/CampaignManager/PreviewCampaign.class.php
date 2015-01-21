<?
    class PreviewCampaign extends SmartObject {
    	var $aCampaignArticles = null;
    	var $oCampaign = null;
    	var $oTemplate = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  PreviewCampaign::objectPreProcessor()");

    		global $myDB, $bSubmitted, $campaign_detail_id, $campaign_id;

	      	$this->oCampaign = new campaign($myDB);
    		$this->oCampaign->loadObject("campaign_id",$campaign_id,false);

    		$this->oTemplate = new template($myDB);
    		$this->oTemplate->loadObject("template_id",$this->oCampaign->template_id,false);

    		$oCollection = new ADODBDataCollection($myDB,"campaign_article");
    		$oCollection->addConditional("campaign_id = " . $campaign_id);
    		$oCollection->setOrderBy("campaign_article_sort_order ASC");
    		$oCollection->loadObjects();
    		$this->aCampaignArticles = $oCollection->getCollectionAsArray();

    		if (sizeof($this->aCampaignArticles) <= 0 || $this->oCampaign->campaign_id == 0)
    			return false;
    		else
	    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  PreviewCampaign::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.PreviewCampaign");
    		return true;
    	}
    	function getCompiledCampaign() {
			$strBuffer = "";
			$strBuffer = $this->oTemplate->getRenderedTemplate($this->aCampaignArticles);
    		return $strBuffer;
    	}
    }
?>