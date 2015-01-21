<?
    class AddTemplate extends SmartObject {
    	var $oTemplate = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddTemplate::objectPreProcessor()");

    		global $myDB, $bSubmitted;    		

    		if ($bSubmitted == 1) {
    			if ($this->insertTemplate()) {
	   			    $this->redirectRequest("Objects.CampaignManager.ListTemplates");
    				return false;
    			}
    			else {
    				$bSubmitted = 0;
	   			    $this->redirectRequest("Objects.CampaignManager.AddTemplate");
    				return false;
    			}
    		}
    		else {
    			return true;
    		}
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddTemplate::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.AddTemplate");
    		return true;
    	}
    	function insertTemplate() {
    		global $template_title, $template_text, $template_id, $myDB, $oUser;

    		$this->oTemplate = new template($myDB);
    		$this->oTemplate->template_title = $template_title;
    		$this->oTemplate->template_text = $template_text;
    		$this->oTemplate->user_id = $oUser->user_id;
    		
    		if ($template_title == "") {
    			onError("You must enter a title.");
    			return false;
    		}
    		if ($template_text == "") {
    			onError("You must enter body text.");
    			return false;
    		}

    		return $this->oTemplate->insertObject();
    	}

    }
?>