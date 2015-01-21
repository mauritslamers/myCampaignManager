<? global $campaign_id, $campaign_article_id; ?>
<span class="textPageTitle">Copying <? print $this->oArticle->campaign_article_title; ?></span><br />
  <br />Please select the campaign into which you want this article copied:<br /><br />
    <form method="POST" name="SelectCampaign" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Copy to Campaign</font></td>
        <td>
<?

  print "<select name=\"campaign_id\">\n";
  foreach ($this->aCampaigns as $oCampaign) {
  	print "<option value=\"". $oCampaign->campaign_id . "\">" . $oCampaign->campaign_name . "</option>\n";
  }
  print "</select>\n";

?>
        </td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel"> &nbsp;&nbsp;</font></td>
        <td><input type="image" src="/images/button_save.gif" value="Save" class="searchInput">  <a href="#" onClick="location = '<? print $_SERVER["PHP_SELF"]; ?>?RequestObject=Objects.CampaignManager.EditCampaign&campaign_id=<? print $this->oArticle->campaign_id; ?>'">onClick="window.close();"><img border="0" src="/images/button_cancel.gif"></a></td>
      </tr>
    </table>
  <input type="hidden" name="RequestObject" value="Objects.CampaignManager.CopyArticle">
  <input type="hidden" name="campaign_article_id" value="<? print $this->oArticle->campaign_article_id; ?>">
  <input type="hidden" name="bSubmitted" value="1">
  </form>
