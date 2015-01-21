<?
    class EditArticle extends SmartObject {
    	var $oArticle = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditArticle::objectPreProcessor()");

    		global $myDB, $bSubmitted, $campaign_article_id, $campaign_id;

	   		$this->oArticle = new campaign_article($myDB);
	   		$this->oArticle->loadObject("campaign_article_id",$campaign_article_id,false);

    		if ($bSubmitted == 1) {
    			if ($this->updateArticle()) {
	   			    $this->redirectRequest("Objects.CampaignManager.EditCampaign");
    				return false;
    			}
    			else {
		    		$this->oArticle = new campaign_article($myDB);
		    		$this->oArticle->importFromGlobalVars();

    				$bSubmitted = 0;
	   			    $this->redirectRequest("Objects.CampaignManager.EditArticle");
    				return false;
    			}
    		}
    		else {
		   		if ($this->oArticle->campaign_article_id <= 0) {
		   			onError("The specified article no longer exists.");
		   			$this->redirectRequest("Objects.CampaignManager.EditCampaign");
		   			return false;
		   		}
    			return true;
    		}
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditArticle::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.EditArticle");
    		return true;
    	}
    	function updateArticle() {
    		global $campaign_article_title, $campaign_article_type, $campaign_article_text, $campaign_article_sort_order, $campaign_article_toc, $campaign_id, $myDB;

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

    		return $this->oArticle->updateObject();
    	}

    }
?>