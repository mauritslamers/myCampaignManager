<?

include_once("includes/utility/phpmailer/class.phpmailer.php");

    class PublishCampaign extends SmartObject {
    	var $aCampaignsArticles = null;
    	var $oCampaign = null;
    	var $oTemplate = null;
    	var $strEmail = "";
    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  PublishCampaign::objectPreProcessor()");

    		global $myDB, $bSubmitted, $campaign_id, $oUser;

	      	$oCampaign = new campaign($myDB);
	      	$aFields = array("campaign_id" => $campaign_id, "user_id" => $oUser->user_id);
    		$oCampaign->loadObjectEx($aFields,false);
    		$this->oCampaign = $oCampaign;

    		$oTemplate = new template($myDB);
    		$oTemplate->loadObject("template_id",$this->oCampaign->template_id,false);
    		$this->oTemplate = $oTemplate;

    		$oCollection = new ADODBDataCollection($myDB,"campaign_article");
    		$oCollection->addConditional("campaign_id = " . $campaign_id);
    		$oCollection->setOrderBy("campaign_article_sort_order ASC");
    		$oCollection->loadObjects();
    		$this->aCampaignArticles = $oCollection->getCollectionAsArray();

    		if (sizeof($this->aCampaignArticles) <= 0 || $this->oCampaign->campaign_id == 0)
    			return false;
    		else
	    		return true;
    	}
    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  PublishCampaign::objectProcessor()");
    		$this->loadContent("Content.CampaignManager.PublishCampaign");
    		return true;
    	}

    	function getRenderedArticles() {
    		$strBuffer = "";
    		if (sizeof($this->aCampaignArticles) > 0) {
    			foreach ($this->aCampaignArticles as $oArticle) {
    				$strBuffer .= $oArticle->render();
    			}
    		}
    		return $strBuffer;
    	}

    	function getCompiledEmail() {
			$strBuffer = "";
			$strBuffer = $this->oTemplate->getRenderedTemplate($this->aCampaignArticles);
//			$strTemplate = $this->oTemplate->template_text;
//			$strBuffer = str_replace("<!--campaignContent-->", $this->getRenderedArticles(), $strTemplate);
    		$this->strEmail = $strBuffer;
    		return $strBuffer;
    	}

    	function sendEmail() {

    		global $oUser;
    		$strFromEmail = $oUser->user_email;
    		$strToEmail = $oUser->user_mailing_list;

    		$mail = new PHPMailer();

    		$mail->From     = $strFromEmail;
    		$mail->FromName = "";
    		$mail->Mailer   = "mail";

    		$body = $this->getCompiledEmail();

    		// Plain text body (for mail clients that cannot read HTML)
    		$text_body = "An HTML-mail compatible email program is required to view this message.";

	   		$mail->Body    = $body;
    		$mail->Subject = $this->oCampaign->campaign_name;
    		$mail->AltBody = $text_body;
    		$mail->AddAddress($strToEmail);
    		//$mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");

    		if(!$mail->Send())
    			$strReturn = "There has been a mail error sending to $strToEmail<br>";
    		else
    			$strReturn = "The email was successfully sent.<br>";

    		return $strReturn;

    	}

    }
?>