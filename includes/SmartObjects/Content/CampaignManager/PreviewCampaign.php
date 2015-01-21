<?

//$strBuffer = "";
//foreach ($this->aCampaignArticles as $oArticle) {
//	$strBuffer .= $oArticle->render();
//}

//$strTemplate = $this->oTemplate->template_text;

//$strOutput = str_replace("<!--campaignContent-->",$strBuffer,$strTemplate);

print $this->getCompiledCampaign();

?>