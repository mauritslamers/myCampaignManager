<?
    class EmailPassword extends SmartObject {
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EmailPassword::objectPreProcessor()");

    		global $myDB;

            // Is this a submitted form?
            global $bSubmitted;
            if ($bSubmitted) {
            	global $EmailAddress, $PostalCode;
            	
            	$oUserTmp = new user($myDB);
            	$aFields = array( "user_email" => $EmailAddress, "user_zip" => $PostalCode);
            	$oUserTmp->loadObjectEx($aFields,false);
            	if ($oUserTmp->user_id > 0) {
    	            $this->emailUserPassword($oUserTmp);
    	            onError("Instructions to reset your password have been\\nemailed to $EmailAddress.");
                    $bSubmitted = 0;
                    $this->redirectRequest("Objects.CampaignManager.SignIn");
                    return false;
  	            }
                else {
                    onError("There is no user with the email address\\n$EmailAddress\\nand the postal code $PostalCode.");
                    $bSubmitted = 0;
                    return true;
                }

            }

    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  EmailPassword::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.EmailPassword");
    		return true;
    	}
    	function emailUserPassword($oUser) {
    	    $strEmail = $oUser->user_email;
    	    $strPasswd = md5($oUser->user_passwd);
    	    $strResetObject = "Objects.CampaignManager.ResetPassword";

            global $HTTP_HOST, $REQUEST_URI;
            $strEmailFrom = 'admin@' . $HTTP_HOST;
            $strHeaders = "From: $strEmailFrom\n";
            $strHeaders .= "X-Sender: $strEmailFrom\n";
            $strHeaders .= "Content-Type: text/html; charset=iso-8859-1\n";

            $aURI = split("\?",$REQUEST_URI);
            $strURI = $aURI[0];

            $strMessage = "<b>Hello";
            $strMessage .= ",</b><br /><br />\n";
            $strMessage .= "You indicated on $HTTP_HOST that you have lost your\n";
            $strMessage .= "account password. Since we store all passwords encrypted\n";
            $strMessage .= "we have no way to recover its current value. To change\n";
            $strMessage .= "your password to a new value, visit the following link:<br /><br />\n";
            $strMessage .= "<a href=\"https://$HTTP_HOST" . $strURI . "?RequestObject=$strResetObject&EmailAddress=" . urlencode($strEmail) . "&id=$strPasswd\" target=\"_blank\">Reset Your Password Here</a><br /><br />\n";
            $strMessage .= "Your username is <b>$strEmail</b><br /><br />\n";
            $strMessage .= "Thanks,<br />\n";
            $strMessage .= "$HTTP_HOST<br /><br />\n";
            $strMessage .= "<hr size=\"1\">-- This is an automated message -- <br />\n";

            $myBuffer = $this->loadEmailTemplate();
	        $myBuffer = str_replace('<!--emailCopy-->',$strMessage,$myBuffer);

            return mail($strEmail,"$HTTP_HOST Account Password Reset",stripslashes($myBuffer),stripslashes($strHeaders));
    	}
    	function loadEmailTemplate() {
    		return loadGlobalTemplate("standardEmail.html");
    	}

    }
?>
