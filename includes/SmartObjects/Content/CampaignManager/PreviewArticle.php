<? 
$strBuffer = $this->oArticle->render();

$strTemplate = $this->oTemplate->template_text;

$strOutput = str_replace("<!--campaignContent-->",$strBuffer,$strTemplate);

print $strOutput;

?>