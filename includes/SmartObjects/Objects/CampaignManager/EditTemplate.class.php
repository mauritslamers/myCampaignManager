<?
    class EditTemplate extends SmartObject {
    	var $oTemplate = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditTemplate::objectPreProcessor()");

    		global $myDB, $bSubmitted, $template_id, $oUser;
    		
	   		$this->oTemplate = new template($myDB);
	   		$aFields = array("template_id" => $template_id, "user_id" => $oUser->user_id);
	   		$this->oTemplate->loadObject("template_id",$template_id,false);
	   		if ($this->oTemplate->template_id <= 0) {
	   			onError("The specified template no longer exists.");
	   			$this->redirectRequest("Objects.CampaignManager.ListTemplates");
	   			return false;
	   		}
	   		


    		if ($bSubmitted == 1) {
    			if ($this->updateTemplate()) {
	   			    $this->redirectRequest("Objects.CampaignManager.ListTemplates");
    				return false;
    			}
    			else {
    				$bSubmitted = 0;
	   			    $this->redirectRequest("Objects.CampaignManager.EditTemplate");
    				return false;
    			}
    		}
    		else {
    			return true;
    		}
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditTemplate::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.EditTemplate");
    		return true;
    	}
    	function updateTemplate() {
    		global $template_title, $template_text, $oUser, $myDB;

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

    		return $this->oTemplate->updateObject();
    	}

    }
?>