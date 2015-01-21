  <span class="textPageTitle">Campaign List</span>&nbsp;&nbsp;&nbsp;<a href="<? print $SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.AddCampaign">[Add New]</a><br /><br />
  Below is a list of all available email campaigns:<br /><br />
   <table width="500">
<?

  if (sizeof($this->aCampaigns) <= 0) {
  	  print "<tr><td colspan=\"2\">There are currently no campaigns.</td></tr>\n";
  }
  else {
?>
      <tr>
        <td class="tdListingHeader"><b>Campaign Name</b></td>
        <td class="tdListingHeader"><b>Created</b></td>
        <td class="tdListingHeader">&nbsp;</td>
        <td class="tdListingHeader">&nbsp;</td>
      </tr>
<?
    foreach ($this->aCampaigns as $oCampaign) {
  	    print "      <tr>\n";
  	    print "        <td>" . $oCampaign->campaign_name . "</td>\n";
  	    print "        <td>" . $this->convertDate($oCampaign->campaign_create_date) . "</td>\n";
  	    print "        <td><a href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.EditCampaign&campaign_id=" . $oCampaign->campaign_id . "\">[Edit]</a></td>\n";
  	    print "        <td><a onClick=\"return confirm('Are you sure you want to delete this entire campaign?\\nNote: All articles in this campaign will be deleted!');\" href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.DeleteCampaign&campaign_id=" . $oCampaign->campaign_id . "\">[Delete]</a></td>\n";
  	    print "      </tr>\n";
    }
  }

?>
   </table>