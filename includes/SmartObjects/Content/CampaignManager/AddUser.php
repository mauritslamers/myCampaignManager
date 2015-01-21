<span class="textPageTitle">Add New User</span><br />
  Fill out the following information:
    <form method="POST" name="oUserForm" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Email Address *&nbsp;&nbsp;</font></td>
        <td><input TYPE="text" autocomplete="off" class="inputText" NAME="user_email" SIZE="21" value="<? print $this->oUserTmp->user_email; ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Password *&nbsp;&nbsp;</font></td>
        <td><input TYPE="password" autocomplete="off" class="inputText" NAME="user_passwd" SIZE="21" value=""></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Again *&nbsp;&nbsp;</font></td>
        <td><input TYPE="password" autocomplete="off" class="inputText" NAME="user_passwd2" SIZE="21" value=""></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Mailing List Email *&nbsp;&nbsp;</font></td>
        <td><input TYPE="text" autocomplete="off" class="inputText" NAME="user_mailing_list" SIZE="21" value="<? print $this->oUserTmp->user_mailing_list; ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Postal Code *&nbsp;&nbsp;</font></td>
        <td><input TYPE="text" autocomplete="off" class="inputText" NAME="user_zip" SIZE="10" value="<? print $this->oUserTmp->user_zip; ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Administrator? *&nbsp;&nbsp;</font></td>
        <td><input TYPE="checkbox" autocomplete="off" class="inputText" NAME="user_admin" <? if ($this->oUserTmp->user_admin) print "checked"; ?>></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel"> &nbsp;&nbsp;</font></td>
        <td><input type="image" src="/images/button_save.gif" value="Save" class="searchInput">  <a href="#" onClick="location = '<? print $_SERVER["PHP_SELF"]; ?>?RequestObject=Objects.CampaignManager.UserManager'"><img border="0" src="/images/button_cancel.gif"></a></td>
      </tr>
    </table>
  <input type="hidden" name="RequestObject" value="Objects.CampaignManager.AddUser">
  <input type="hidden" name="bSubmitted" value="1">
  </form>