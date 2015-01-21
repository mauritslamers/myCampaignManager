<? global $EmailAddress; ?>
  <span class="textPageTitle">Campaign Management</span><br />
  <b>Please Sign In</span></b><br />Enter your email address and your password below.<br /><br />
  <form method="POST" name="SignIn" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">E-mail *&nbsp;&nbsp;</font></td>
        <td><input type="text" class="inputText" autocomplete="off" NAME="EmailAddress" SIZE="25" value="<? if (isset($EmailAddress)) { print $EmailAddress; } ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Password *&nbsp;&nbsp;</font></td>
        <td><input type="password" class="inputText" NAME="Passwd" SIZE="25"></td>
      </tr>
      <tr>
        <td ALIGN="right">&nbsp;</td>
        <td><input type="image" src="/images/button_sign_in.gif" value="Sign In" class="searchInput">&nbsp;&nbsp; <a href="?RequestObject=Objects.CampaignManager.EmailPassword" >Forgot your password?</a></td>
      </tr>
    </table>
   <input type="hidden" name="RequestObject" value="Objects.CampaignManager.SignIn">
   <input type="hidden" name="bSubmitted" value="1">
   </form>
