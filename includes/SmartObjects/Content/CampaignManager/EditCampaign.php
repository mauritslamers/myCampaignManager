
  <table width="500">
    <tr>
      <td colspan="6">
  <span class="textPageTitle"><? print $this->oCampaign->campaign_name; ?></span><br />
  <br />

<!--  <span class="textPageSubTitle">Campaign Settings</span>&nbsp;&nbsp;&nbsp; <a href="<? print $SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.CampaignSettings&campaign_id=<? print $this->oCampaign->campaign_id; ?>">[Edit Settings]</a><br />
  To modify the basic settings for the campaign, click on the link above. -->

  <span class="textPageSubTitle">Campaign Preview</span>&nbsp;&nbsp;&nbsp;<? print "<a target=\"_blank\" href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.PreviewCampaign&bPreview=1&campaign_id=" . $this->oCampaign->campaign_id . "\">[Preview Campaign]</a>\n"; ?><br />
  For a preview of this entire campaign as it is currently set up, click on the link above.

  <br /><br /><span class="textPageSubTitle">Publish Campaign</span>&nbsp;&nbsp;&nbsp;<? print "<a href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.PublishCampaign&campaign_id=" . $this->oCampaign->campaign_id . "\" onClick=\"return confirm('This will send an email to the entire list.\\nAre you sure you want to do this?');\">[Publish Campaign]</a>\n"; ?><br />
  Once you have completed all updates to this campaign, click on the link above to send it to the email list.
      </td>
    </tr>
    <tr>
      <td colspan="6"><br /><span class="textPageSubTitle">Campaign Articles</span>&nbsp;&nbsp;&nbsp; <a href="<? print $SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.AddArticle&campaign_id=<? print $this->oCampaign->campaign_id; ?>">[Add New Article]</a></td>
    </tr>
<?

  if (sizeof($this->aCampaignArticles) <= 0) {
  	  print "<tr><td colspan=\"5\">There are no currently no articles for this campaign.</td></tr>\n";
  }
  else {
?>
      <tr>
        <td class="tdListingHeader"><b>Title</b></td>
        <td class="tdListingHeader"><b>Type</b></td>
        <td class="tdListingHeader">&nbsp;</td>
        <td class="tdListingHeader">&nbsp;</td>
        <td class="tdListingHeader">&nbsp;</td>
        <td class="tdListingHeader">&nbsp;</td>
      </tr>
<?
    foreach ($this->aCampaignArticles as $oArticle) {
  	    print "      <tr>\n";
  	    print "        <td>" . $oArticle->campaign_article_title . "</td>\n";
  	    print "        <td>" . $oArticle->campaign_article_type . "</td>\n";
  	    print "        <td><a href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.EditArticle&campaign_article_id=" . $oArticle->campaign_article_id . "&campaign_id=" . $this->oCampaign->campaign_id . "\">[Edit]</a></td>\n";
  	    print "        <td><a href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.CopyArticle&campaign_article_id=" . $oArticle->campaign_article_id . "&campaign_id=" . $this->oCampaign->campaign_id . "\">[Copy]</a></td>\n";
  	    print "        <td><a onClick=\"return confirm('Are you sure you want to delete this item?');\" href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.DeleteArticle&campaign_article_id=" . $oArticle->campaign_article_id . "&campaign_id=" . $this->oCampaign->campaign_id . "\">[Delete]</a></td>\n";
  	    print "        <td><a target=\"_blank\" href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.PreviewArticle&campaign_article_id=" . $oArticle->campaign_article_id .  "&bPreview=1&campaign_id=" . $this->oCampaign->campaign_id . "\">[Preview]</a></td>\n";
  	    print "      </tr>\n";
    }
  }

?>
   </table>
