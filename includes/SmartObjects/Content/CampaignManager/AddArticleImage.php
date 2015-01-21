<span class="textPageTitle">Article Images</span><br /><br />
  Select the image to add to this article:<br /><br />
    <form method="POST" name="oAddImage" action="<? print $_SERVER["PHP_SELF"]; ?>" onSubmit="return false;">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Image Names&nbsp;&nbsp;</font></td>
        <td>
            <select class="inputText" name="imageNames" onChange="refreshPreview();">
<?
foreach ($this->aImages as $strImage) {
	print "                <option value=\"". $strImage ."\">$strImage</option>\n";
}
?>
            </select>
        </td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Align&nbsp;&nbsp;</font></td>
        <td>
            <select class="inputText" name="imageAlign">
                <option value="left">Left</option>
                <option value="right">Right</option>
            </select>
        </td>
      </tr>
      <tr>
        <td align="right"><font class="textFieldLabel">Preview &nbsp;&nbsp;</font></td>
        <td>  <img name="oPreviewImage" src="/images/spacer.gif" /></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel"> &nbsp;&nbsp;</font></td>
        <td><a href="#" onClick="addImage();"><img border="0" src="/images/button_save.gif"></a> <a href="#" onClick="window.close();"><img border="0" src="/images/button_cancel.gif"></a></td>
      </tr>
    </table>
  <input type="hidden" name="RequestObject" value="Objects.CampaignManager.AddArticle">
  <input type="hidden" name="campaign_id" value="<? print $campaign_id; ?>">
  <input type="hidden" name="bSubmitted" value="1">
  </form>

<script language="JavaScript">
function getSelectedImageName() {
	return document.oAddImage.imageNames.options[document.oAddImage.imageNames.selectedIndex].value;
}
function refreshPreview() {
	document.oPreviewImage.src = '<? print JUPLOAD_WEB_DIRECTORY; ?>' + getSelectedImageName();
}
function addImage() {
	strImageAlign = document.oAddImage.imageAlign.options[document.oAddImage.imageAlign.selectedIndex].value;
	strImageTag = "<articleImage " + getSelectedImageName() + " align=\"" + strImageAlign +"\">";
	window.opener.document.oArticleForm.campaign_article_text.value = window.opener.document.oArticleForm.campaign_article_text.value + strImageTag;
	window.close();
	return false;
}
refreshPreview();
</script>