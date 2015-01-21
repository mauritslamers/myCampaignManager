<?

    class SignOut extends SmartObject {
    	var $oUser = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SignOut::objectPreProcessor()");
    		global $myDB, $oUser;

            $oUser = new user($myDB);
            $this->oUser = $oUser;

   			$this->redirectRequest("Objects.CampaignManager.SignIn");
    		return false;
    	}
    }

?>