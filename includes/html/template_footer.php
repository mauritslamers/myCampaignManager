<!-- End Content -->
<? if (!$_GET['bPopup']) { ?>
<br />
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="sideBar" valign="top">
            <table border="0" cellpadding="10">
              <tr><td><img src="/images/spacer.gif" height="1" width="130" /></td></tr>
              <tr>
                <td>
<? if ($oUser->user_id > 0 && !$_GET['bInstall']) { ?>
            <span class="textPageSubTitle">Actions</span><br /><br />
            <a class="menuLink" href="<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.ListCampaigns">Campaigns</a><br /><br />
            <a class="menuLink" href="<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.ListTemplates">Templates</a><br /><br />
            <a class="menuLink" href="<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.ImageUpload">Images</a><br /><br />
            <br />
<? global $oUser; if ($oUser->user_admin) { ?>
            <a class="menuLink" href="<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.UserManager">Manage Users</a><br /><br />
<? } // end if user_admin ?>
            <a class="menuLink" href="<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.EditUser&user_id=<? print $oUser->user_id; ?>">Account Settings</a><br /><br />
            <a class="menuLink" href="<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.ChangePassword">Change Password</a><br /><br />
            <a class="menuLink" href="<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.SignOut">Sign Out</a><br /><br />
<? } // end if signed in and not bInstall ?>

                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
	<td class="tdFooterBar" height="35" width="100%" valign="top">
	   <table border="0" cellpadding="10" width="100%">
	     <tr>
	       <td>
	         <div align="left">
	           <b>Copyright &copy; 2005 Steven L. Brendtro</b><br />
	         </div>
	       </td>
	       <td>
	         <div align="right">
	           <i>Website:</i> <a href="http://mycampaign.sourceforge.net" target="_blank">http://mycampaign.sourceforge.net</a><br />
	           <i>Email:</i> admin at imaginerc dot com<br />
	         </div>
	       </td>
	     </tr>
	   </table>
	</td>
  </tr>
</table>
<? } // end if bPopup ?>
</body>
</html>