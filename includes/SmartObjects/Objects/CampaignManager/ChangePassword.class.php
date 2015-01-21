<?

    class ChangePassword extends SmartObject {
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ChangePassword::objectPreProcessor()");
            // Make sure they are properly signed in
    		global $oUser;
    		if ($oUser->user_id == 0) {
    			$this->redirectRequest("Objects.CampaignManager.SignIn");
    			return false;
    		}

    		global $bSubmitted;
    		// Process form
    		if ($bSubmitted) {
    		    global $user_email, $OldPasswd, $Passwd, $Passwd2;

    		    if (md5($OldPasswd) != $oUser->user_passwd) {
    		        $bSubmitted = null;
    		        onError("The password you entered is\\nincorrect.  Please try again.");
    		    }
    		    elseif($Passwd != $Passwd2) {
    		        $bSubmitted = null;
    		        onError("The passwords you entered did\\ndid not match.  Please try again.");
    		    }
    		    elseif(strlen($Passwd) < 6 ) {
    		        $bSubmitted = null;
    		        onError("Please enter a password that\\nis six characters or longer.");
    		    }
    		    elseif($user_email != $oUser->user_email) {
    		        $bSubmitted = null;
    		        $this->redirectRequest("Objects.CampaignManager.ListCampaigns");
    		    }
    		    else {
    		        $bSubmitted = null;
    		        $oUser->user_passwd = md5($Passwd);
    		        $bStatus = $oUser->updateObject();
    		        if (! $bStatus) {
                        $bSubmitted = null;
                        onError("We were unable to change\\nyour password.  Please try\\nagain later.");
    		        }

    		        $this->redirectRequest("Objects.CampaignManager.ListCampaigns");
                    return false;

    		    }
    		}

    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ChangePassword::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.ChangePassword");
    		return true;
    	}
    }

?>
