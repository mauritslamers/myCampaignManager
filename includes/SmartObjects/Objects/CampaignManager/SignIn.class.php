<?

    class SignIn extends SmartObject {
    	var $oUser = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SignIn::objectPreProcessor()");
    		global $myDB, $bSubmitted, $oUser;

            // If already signed in, forward the request
            if ($oUser->user_id > 0) {
    			$this->redirectRequest("Objects.CampaignManager.ListCampaigns");
            	return false;
            }

            $oUser = new user($myDB);
            $this->oUser = $oUser;

            // Is this a submitted form?
            if ($bSubmitted) {
            	global $EmailAddress, $Passwd;

            	$oUserTmp = new user($myDB);
            	$aFields = array( "user_email" => $EmailAddress, "user_passwd" => md5($Passwd));
            	$oUserTmp->loadObjectEx($aFields,false);
            	if ($oUserTmp->user_id > 0) {
            		$oUser = $oUserTmp;
            		$this->redirectRequest("Objects.CampaignManager.ListCampaigns");
            		return false;
            	}
                else {
                    onError("Unable to sign in.\\n\\nPlease check your email address\\nand password and try again.");
                    $bSubmitted = 0;
                    $this->redirectRequest("Objects.CampaignManager.SignIn");
                    return false;
                }

            }
            // Check if we are signed in...
    		if ($oUser->user_id > 0) {
    			$this->redirectRequest("Objects.CampaignManager.ListCampaigns");
    			return false;
    		}
    		return true;
    	}

    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SignIn::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.SignIn");
    		return true;
    	}
    }

?>