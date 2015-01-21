<?

    include_once("includes/config.php");
	
    session_register('oUser');
    if (get_class($oUser) != "") {
        // Reconnect our serialized object to the database!!!
        $oUser->setDBConnection($myDB);
    }

    if ($_GET['bPreview'] != 1)
    	include_once("includes/html/template_header.php");

    $bDebug = true;

    if (isset($RequestObject))
        $strStartObject = $RequestObject;
    else
        $strStartObject = "Objects.CampaignManager.SignIn";

    if ($oUser->user_id <= 0) {
    	if ($RequestObject != "Objects.CampaignManager.EmailPassword" && $RequestObject != "Objects.CampaignManager.ResetPassword" )
	    	$strStartObject = "Objects.CampaignManager.SignIn";
    }

    if (isset($ReturnObject))
        $strReturnObject = $ReturnObject;
    else
        $strReturnObject = "";

    $oSmartObjectBrain = new SmartObjectBrain($strStartObject,$bDebug,$strReturnObject);

    $_SESSION['oUser'] = $oUser;

    if ($_GET['bPreview'] != 1)
	    include_once("includes/html/template_footer.php");
?>
