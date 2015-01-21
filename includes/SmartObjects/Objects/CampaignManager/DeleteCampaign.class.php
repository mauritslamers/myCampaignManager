<?
    class DeleteCampaign extends SmartObject {
    	var $aCampaignsDetails = null;
    	var $oCampaign = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  DeleteCampaign::objectPreProcessor()");

    		global $myDB, $campaign_id;

    		$strQuery1 = "DELETE FROM cm_campaigns WHERE campaign_id = " . $campaign_id;
    		$strQuery2 = "DELETE FROM cm_campaign_details WHERE campaign_id = " . $campaign_id;
    		
    		$myDB->Query($strQuery1);
    		$myDB->Query($strQuery2);
    
   			$this->redirectRequest("Objects.CampaignManager.ListCampaigns");
   			return false;
    	}

    }
?>
