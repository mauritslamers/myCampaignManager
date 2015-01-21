<?

    class ResetPassword extends SmartObject {
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ResetPassword::objectPreProcessor()");

            // Make sure they aren't signed in
    		global $oUser, $myDB;
    		$oUser = new user($myDB);

    		global $bSubmitted;
    		// Process form
    		if ($bSubmitted) {
    		    global $EmailAddress, $id, $Passwd, $Passwd2;
    		    
            	$oUserTmp = new user($myDB);
            	$oUserTmp->loadObject("user_email",$EmailAddress,false);
            	if ($oUserTmp->cm_user_id > 0) {

        	            if ($id != md5($oUserTmp->user_passwd)) {
    		                $bSubmitted = null;
    		                onError("We were unable to reset your password\\nPlease try again.");
    		                $this->redirectRequest("Object.CampaignManager.EmailPassword");
    		                return false;
    		            }
    		            elseif($Passwd != $Passwd2) {
    		                $bSubmitted = null;
    		                onError("The passwords you entered did\\ndid not match.  Please try again.");
    		            }
    		            elseif(strlen($Passwd) < 6 ) {
    		                $bSubmitted = null;
    		                onError("Please enter a password that\\nis six characters or longer.");
    		            }
    		            elseif($EmailAddress != $oUserTmp->user_email) {
    		                $bSubmitted = null;
    		                onError("We were unable to reset your password\\nPlease try again.");
    		                $this->redirectRequest("Objects.CampaignManager.EmailPassword");
    		            }
    		            else {
    		                $bSubmitted = null;
    		                $oUser = new user($myDB);
    		                $oUser->importADODBObject($oUserTmp);
    		                $oUser->user_passwd = md5($Passwd);
    		                if (!$oUser->updateObject()) {
                                $bSubmitted = null;
                                onError("We were unable to change\\nyour password.  Please try\\nagain later.");
    		                }
                            $this->redirectRequest("Objects.CampaignManager.MainMenu");
                            return false;
    		            }

                }
                else {
                    onError("We were unable to reset your password.\\nPlease try again later.");
                        $bSubmitted = 0;
                        $this->redirectRequest("Objects.CampaignManager.SignIn");
                        return false;
                }
            }

    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  ResetPassword::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.ResetPassword");
    		return true;
    	}
    }

?>