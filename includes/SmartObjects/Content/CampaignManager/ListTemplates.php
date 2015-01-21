  <span class="textPageTitle">Template List</span>&nbsp;&nbsp;&nbsp;<a href="<? print $SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.AddTemplate">[Add New]</a><br /><br />
  Below is a list of all available email templates:<br /><br />
   <table width="500">
<?

  if (sizeof($this->aTemplates) <= 0) {
  	  print "<tr><td colspan=\"2\">There are currently no templates.</td></tr>\n";
  }
  else {
?>
      <tr>
        <td class="tdListingHeader"><b>Template Title</b></td>
        <td class="tdListingHeader">&nbsp;</td>
        <td class="tdListingHeader">&nbsp;</td>
      </tr>
<?
    foreach ($this->aTemplates as $oTemplate) {
  	    print "      <tr>\n";
  	    print "        <td>" . $oTemplate->template_title . "</td>\n";
  	    print "        <td><a href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.EditTemplate&template_id=" . $oTemplate->template_id . "\">[Edit]</a></td>\n";
  	    print "        <td><a onClick=\"return confirm('Are you sure you want to delete this template?');\" href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.DeleteTemplate&template_id=" . $oTemplate->template_id . "\">[Delete]</a></td>\n";
  	    print "      </tr>\n";
    }
  }

?>
   </table>