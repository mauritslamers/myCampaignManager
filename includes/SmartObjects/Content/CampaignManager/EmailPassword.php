<? global $EmailAddress, $PostalCode; ?>
<span class="textPageTitle">Reset Password</span><br />
  <br /><b>Lost Passwords:</b><br />Enter your email address and postal code below.  You will be emailed instructions to reset your password.<br /><br />
  <form method="POST" name="EmailPassword" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">E-mail Address *&nbsp;&nbsp;</font></td>
        <td><input type="text" autocomplete="off" class="inputText" NAME="EmailAddress" SIZE="25" value="<? if (isset($EmailAddress)) { print $EmailAddress; } ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Postal Code *&nbsp;&nbsp;</font></td>
        <td><input type="text" autocomplete="off" class="inputText" NAME="PostalCode" SIZE="25" value="<? if (isset($PostalCode)) { print $PostalCode; } ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right">&nbsp;</td>
        <td><input type="image" src="/images/button_send_email.gif" value="Send Email" class="searchInput"> <a href="#" alt="Cancel" onClick="location = '<? print $_SERVER["PHP_SELF"]; ?>'"><img src="/images/button_cancel.gif" width="50" height="19" border="0" /></a></td>
      </tr>
    </table>
   <input type="hidden" name="RequestObject" value="Objects.CampaignManager.EmailPassword">
   <input type="hidden" name="bSubmitted" value="1">
  </form>
