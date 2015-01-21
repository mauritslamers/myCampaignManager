<?
    class AddUser extends SmartObject {
    	var $oUserTmp = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddUser::objectPreProcessor()");

    		global $myDB, $bSubmitted;

    		$this->aImages = array();

   			$this->oUserTmp = new user($myDB);
   			$this->oUserTmp->importFromGlobalVars();

    		if ($bSubmitted == 1) {
    			if ($this->insertUser()) {
	   			    $this->redirectRequest("Objects.CampaignManager.UserManager");
    				return false;
    			}
    			else {
    				$bSubmitted = 0;
	   			    $this->redirectRequest("Objects.CampaignManager.AddUser");
    				return false;
    			}
    		}
    		else
    			return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  AddUser::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.AddUser");
    		return true;
    	}
    	function checkForDuplicates($strEmail) {
    		global $myDB;
    		$oTmp = new user($myDB);
    		$oTmp->loadObject("user_email",$strEmail,false);
    		if ($oTmp->user_id > 0)
    			return true;
    		else
    			return false;
    	}
    	function insertUser() {
    		$this->oUserTmp->importFromGlobalVars();

    		global $oUser,$user_passwd2;

    		if (!$oUser->user_admin) {
    			onError("You are not an administrator.");
    			return false;
    		}
    		if ($this->oUserTmp->user_email == "") {
    			onError("Please provide an email address.");
    			return false;
    		}
    		if ($this->oUserTmp->user_passwd == "") {
    			onError("Please provide a password.");
    			return false;
    		}
    		if ($this->oUserTmp->user_passwd != $user_passwd2) {
    			onError("The passwords you entered did not match.");
    			return false;
    		}
    		if ($this->oUserTmp->user_zip == "") {
    			onError("Please provide a zip code.");
    			return false;
    		}
    		if ($this->checkForDuplicates($this->oUserTmp->user_email)) {
    			onError("An account with that email already exists.");
    			return false;
    		}

    		global $user_admin;
   			if ($user_admin)
   				$this->oUserTmp->user_admin = 1;
   			else
   				$this->oUserTmp->user_admin = 0;

    		$this->oUserTmp->user_passwd = md5($this->oUserTmp->user_passwd);
    		$this->oUserTmp->user_email = strtolower($this->oUserTmp->user_email);

    		return $this->oUserTmp->insertObject();
    	}

    }
?>