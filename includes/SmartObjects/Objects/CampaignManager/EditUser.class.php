<?
    class EditUser extends SmartObject {
    	var $oUserTmp = null;
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditUser::objectPreProcessor()");

    		global $myDB, $bSubmitted, $oUser, $user_id;

    		if ($oUser->user_admin != 1 && $oUser->user_id != $user_id) {
    			onError("Access Denied. You are not an administrator.");
    			$this->redirectRequest("Objects.CampaignManager.UserManager");
    			return false;
    		}

    		$this->oUserTmp = new user($myDB);
    		$this->oUserTmp->loadObject("user_id",$user_id,false);
    		if ($this->oUserTmp->user_id <= 0) {
    			onError("Unable to load the specified user.");
    			$this->redirectRequest("Objects.CampaignManager.UserManager");
    			return false;
    		}

    		if ($bSubmitted == 1) {
    			if ($this->updateUser()) {
	   			    $this->redirectRequest("Objects.CampaignManager.UserManager");
    				return false;
    			}
    			else {
    				$bSubmitted = 0;
	   			    $this->redirectRequest("Objects.CampaignManager.EditUser");
    				return false;
    			}
    		}
    		else
    			return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EditUser::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.EditUser");
    		return true;
    	}
    	function checkForDuplicates($strEmail,$nID) {
    		global $myDB;
    		$oCollection = new ADODBDataCollection($myDB,"user");
    		$oCollection->addConditional("user_email = '" . $strEmail . "'");
    		$oCollection->addConditional("user_id != " . $nID);
   			$oCollection->loadObjects();
   			$aUsers = $oCollection->getCollectionAsArray();

   			if (sizeof($aUsers) <= 0)
   				return false;
   			else
   				return true;
    	}
    	function updateUser() {
    		$this->oUserTmp->importFromGlobalVars();

    		global $oUser, $user_id;

    		if ($oUser->user_admin != 1 && $oUser->user_id != $user_id) {
    			onError("ERROR: You are not an administrator.");
    			return false;
    		}
    		if ($this->oUserTmp->user_email == "") {
    			onError("Please provide an email address.");
    			return false;
    		}
    		if ($this->oUserTmp->user_zip == "") {
    			onError("Please provide a zip code.");
    			return false;
    		}
    		if ($this->checkForDuplicates($this->oUserTmp->user_email,$this->oUserTmp->user_id)) {
    			onError("An account with that email already exists.");
    			return false;
    		}

    		if ($oUser->user_admin) {
	    		global $user_admin;
    			if ($user_admin)
    				$this->oUserTmp->user_admin = 1;
    			else
    				$this->oUserTmp->user_admin = 0;
    		}
    		else
    			$this->oUserTmp->user_admin = $oUser->user_admin;

    		$this->oUserTmp->user_email = strtolower($this->oUserTmp->user_email);

    		return $this->oUserTmp->updateObject();
    	}

    }
?>