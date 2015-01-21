  <span class="textPageTitle">User Manager</span>&nbsp;&nbsp;&nbsp;<a href="<? print $SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.AddUser">[Add New]</a><br /><br />
  Below is a list of all the users.<br /><br />
   <table width="500">
<?

  if (sizeof($this->aUsers) <= 0) {
  	  print "<tr><td colspan=\"2\">There are currently no users.</td></tr>\n";
  }
  else {
?>
      </tr>
        <td class="tdListingHeader"><b>Email Address</b></td>
        <td class="tdListingHeader">&nbsp;</td>
        <td class="tdListingHeader">&nbsp;</td>
      </tr>
<?
    foreach ($this->aUsers as $oUser) {
  	    print "      <tr>\n";
  	    print "        <td>" . $oUser->user_email . "</td>\n";
  	    print "        <td><a href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.EditUser&user_id=" . $oUser->user_id . "\">[Edit]</a></td>\n";
  	    print "        <td><a onClick=\"return confirm('Are you sure you want to delete this user and\\nall their templates, campaigns and articles?');\" href=\"" . $SERVER['PHP_SELF'] . "?RequestObject=Objects.CampaignManager.DeleteUser&user_id=" . $oUser->user_id . "\">[Delete]</a></td>\n";
  	    print "      </tr>\n";
    }
  }

?>
   </table>