<span class="textPageTitle">Password Reset</span><br />
<? global  $id, $EmailAddress; ?>
  Enter a new password below.  Passwords must be 6 or more characters, and are case sensitive.<br /><br />
  <form method="POST" name="ResetPassword" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Email Address *&nbsp;&nbsp;</font></td>
        <td><input TYPE="HIDDEN" NAME="EmailAddress" value="<? print urldecode($EmailAddress); ?>"><? print urldecode($EmailAddress); ?></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">New Password *&nbsp;&nbsp;</font></td>
        <td><input type="password" class="inputText" autocomplete="off" NAME="Passwd" SIZE="25"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Retype Password *&nbsp;&nbsp;</font></td>
        <td><input type="password" class="inputText" autocomplete="off" NAME="Passwd2" SIZE="25"></td>
      </tr>
      <tr>
        <td ALIGN="right">&nbsp;</td>
        <td><input type="image" src="/images/button_next.gif" value="Next" class="searchInput"> <a href="#" alt="Cancel" onClick="location = '<? print $_SERVER["PHP_SELF"]; ?>'"><img src="/images/button_cancel.gif" width="50" height="19" border="0" /></a></td>
      </tr>
    </table>
  <input type="hidden" name="id" value="<? print $id; ?>">
  <input type="hidden" name="RequestObject" value="Objects.CampaignManager.ResetPassword">
  <input type="hidden" name="bSubmitted" value="1">
  </form>