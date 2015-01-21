<span class="textPageTitle">Add New Campaign</span><br />
  <br />To get started, provide a name for this new campaign.
    <form method="POST" name="NewCampaign" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Name *&nbsp;&nbsp;</font></td>
        <td><input TYPE="text" autocomplete="off" class="inputText" NAME="campaign_name" SIZE="25" value="<? print $this->oCampaign->campaign_name; ?>"></td>
      </tr>
      <tr>
        <td align="right"><font class="textFieldLabel">Template *&nbsp;&nbsp;</font></td>
        <td>
  	    <select name="template_id">
<?
    foreach ($this->aTemplates as $oTemplate) {
  	    print "            <option value=\"" . $oTemplate->template_id . "\">" . $oTemplate->template_title . "</option>\n";
    }
?>
  	      </select>
        </td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel"> &nbsp;&nbsp;</font></td>
        <td><input type="image" src="/images/button_save.gif" value="Save" class="searchInput">  <a href="#" onClick="location = '<? print $_SERVER["PHP_SELF"]; ?>?RequestObject=Objects.CampaignManager.ListCampaigns'">onClick="window.close();"><img border="0" src="/images/button_cancel.gif"></a></td>
      </tr>
    </table>
  <input type="hidden" name="RequestObject" value="Objects.CampaignManager.AddCampaign">
  <input type="hidden" name="bSubmitted" value="1">
  </form>
