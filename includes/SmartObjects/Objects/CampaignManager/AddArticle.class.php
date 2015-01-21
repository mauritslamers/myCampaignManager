<?
    class AddArticle extends SmartObject {
    	var $oArticle = null;
    	var $aImages = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddArticle::objectPreProcessor()");

    		global $myDB, $bSubmitted;

    		$this->aImages = array();

    		if ($bSubmitted == 1) {
    			if ($this->insertArticle()) {
	   			    $this->redirectRequest("Objects.CampaignManager.EditCampaign");
    				return false;
    			}
    			else {
    				$bSubmitted = 0;
	   			    $this->redirectRequest("Objects.CampaignManager.AddArticle");
    				return false;
    			}
    		}
    		else {
    			$this->oArticle = new campaign_article($myDB);
    			$this->oArticle->importFromGlobalVars();
    			return true;
    		}
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddArticle::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.AddArticle");
    		return true;
    	}
    	function insertArticle() {
    		global $campaign_article_title, $campaign_article_type, $campaign_article_text, $campaign_article_sort_order, $campaign_article_toc, $campaign_id, $myDB;

    		$this->oArticle = new campaign_article($myDB);
    		$this->oArticle->campaign_article_title = $campaign_article_title;
    		$this->oArticle->campaign_article_type = $campaign_article_type;
    		$this->oArticle->campaign_article_text = $campaign_article_text;
    		$this->oArticle->campaign_article_sort_order = $campaign_article_sort_order;
    		if ($campaign_article_toc)
    			$this->oArticle->campaign_article_toc = 1;
    		else
    			$this->oArticle->campaign_article_toc = 0;
    		$this->oArticle->campaign_id = $campaign_id;

    		if ($campaign_article_title == "") {
    			onError("You must enter a title.");
    			return false;
    		}
    		if ($campaign_article_type == "") {
    			onError("You must select a type.");
    			return false;
    		}
    		if ($campaign_article_text == "") {
    			onError("You must enter body text.");
    			return false;
    		}
    		if ($campaign_article_sort_order == "") {
    			onError("You must enter a sort order.");
    			return false;
    		}

    		return $this->oArticle->insertObject();
    	}

    }
?>