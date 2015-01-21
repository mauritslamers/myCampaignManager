<?
    class DeleteTemplate extends SmartObject {
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  DeleteTemplate::objectPreProcessor()");

    		global $myDB, $template_id, $oUser;

    		$strQuery = "DELETE FROM cm_templates WHERE template_id = " . $template_id . " AND user_id = " . $oUser->user_id;
    		
    		$myDB->Query($strQuery);
    
   			$this->redirectRequest("Objects.CampaignManager.ListTemplates");
   			return false;
    	}

    }
?>
