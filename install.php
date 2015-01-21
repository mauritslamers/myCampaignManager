<?

	$RequestObject == "Objects.CampaignManager.Install";
	
	$bInstall = true;
	 	
	include_once("includes/html/template_header.php");
	if ($_POST['bSubmitted'] == 1)
		if (!processForm())
			displayFailure();
		else
			displaySuccess();
	else
		displayForm();
	
    include_once("includes/html/template_footer.php");	
    
    function processForm() {
    	$strBuffer = "<?\n" .
                     "   // config.php\n" .
                     "   //     Config File for DB Access\n" .
                     "\n" .
                     "   define('CM_WEBSITE_URL','" . $_POST['strUrl'] . "');\n" .
                     "   define('CM_INSTALL_DIR','" . $_POST['strPath'] . "');\n" .
                     "\n" .
                     "   //////////////////////////////////////////\n" .
                     "   // Debug Configuration\n" .
                     "   // Disable DEBUG MODE if running in production!!!\n" .
                     "   \$bDebug = 0;\n" .
                     "\n" .
                     "   //////////////////////////////////////////\n" .
                     "   // Database Configuration\n" .
                     "\n" .
                     "   \$GLOBAL_DB_NAME = '" . $_POST['strDBName'] . "';	// Name of Database\n" .
                     "   \$GLOBAL_DB_HOST = '" . $_POST['strDBHost'] . "';	// Database host\n" .
                     "   \$GLOBAL_DB_USER = '" . $_POST['strDBUser'] . "';		// Database Username\n" .
                     "   \$GLOBAL_DB_PASS = '" . $_POST['strDBPass'] . "';	// Database Password\n" .
                     "\n" .
                     "   //////////////////////////////////////////\n" .
                     "   // SmartObject Configuration\n" .
                     "   define('SMART_OBJECT_LIBRARY_PATH', CM_INSTALL_DIR . 'includes/SmartObjects/');\n" .
                     "\n" .
                     "   //////////////////////////////////////////\n" .
                     "   // Image Upload Configuration\n" .
                     "   define('JUPLOAD_UPLOAD_DIRECTORY', CM_INSTALL_DIR . 'images/cm_thumbnails/');\n" .
                     "   define('JUPLOAD_MAX_LENGTH','200');\n" .
                     "\n" .
                     "\n" .
                     "?>\n";
                     
        global $aErrors;
        
    	$myFP = fopen("./includes/siteConfig.php","w");
    	if ($myFP)
        	fwrite($myFP,$strBuffer);
        else
        	$aErrors[] = "The file ./includes/siteConfig.php is not writable.  Set the permissions on the file or directory to writable by the web server and try again (e.g. \"chmod 777 ./includes/siteConfig.php\").";
        fclose($myFP);
        

        $strBuffer = "php_value include_path .:\"" . $_POST['strPath'] . "\"\n" .
        			"php_value magic_quotes_gpc \"off\"\n" .
        			"php_value track_errors \"on\"\n" .
        			"php_value display_errors \"on\"\n" .
        			"php_value allow_call_time_pass_reference \"on\"\n" .
        			"php_value register_globals \"on\"";
        
        $myFP = fopen("./.htaccess","w");
    	if ($myFP)
        	fwrite($myFP,$strBuffer);
        else
        	$aErrors[] = "The file ./.htaccess is not writable.  Set the permissions on the file or directory to writable by the web server and try again (e.g. \"chmod 777 ./.htaccess\").";
        fclose($myFP);
        
        if (sizeof($aErrors) > 0)
        	return false;
        else
        	return true;

    }
    
	function displaySuccess() {
?>
<table border="0" cellpadding="0" cellspacing="0" width="550">
  <tr>
    <td>
  <span class="textPageTitle">Installation</span><br />
  <br />
  Congratulations!  The installation of myCampaignManager has been successfully completed.
  You may now access myCampaignManager by visiting the following URL: <a href="<? print $_POST['strUrl']; ?>"><? print $_POST['strUrl']; ?></a>.  The admin username and password are:<br /><br />
<pre><b>Username:</b>  admin@localhost
<b>Password:</b> password</pre>
  
  <br /><br /><b>IMPORTANT:</b> You will need to make sure to change the file permissions on the two files "./.htaccess" and "./includes/siteConfig.php" so that they are not world readable!
  Also, it is a good idea to delete this script (install.php) once you have successfully completed this install.
    </td>
  </tr>
</table>
<?
	} // end function displaySuccess()
	function displayFailure() { 
?>
<table border="0" cellpadding="0" cellspacing="0" width="550">
  <tr>
    <td>
  <span class="textPageTitle">Installation</span><br />
  <br />
  One or more errors occurred while setting up myCampaignManager.  Please correct the following problem(s) and then try the installation again:<br />
  <ul>
  <? global $aErrors; foreach ($aErrors as $strMsg) { print "<li>" . $strMsg . "</li>\n"; } ?>  
  </ul>
    </td>
  </tr>
</table>
<?
	}
	
	function displayForm() {
		$strGuessUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];		
		$strGuessUrl = str_replace("install.php","",$strGuessUrl);		
		$strGuessDir = `pwd`;
		$strGuessDir .= "/";
   	
?>
<table border="0" cellpadding="0" cellspacing="0" width="550">
  <tr>
    <td>
  <span class="textPageTitle">Installation</span><br />
  <br />
  If you are seeing this message then you have already unzipped or untarred the
  myCampaignManager distribution into a directory on your web server.  To complete
  this installation, simply fill out the following information and click the install
  button below.
  <br /><br />
  <form method="POST" name="Install" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="left" colspan="2"><font class="textPageSubTitle">Directory Settings</font></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">URL to myCampaignManager &nbsp;&nbsp;</font></td>
        <td><input type="text" class="inputText" NAME="strUrl" SIZE="25" value="<? print $strGuessUrl; ?>"> (with trailing slash)</td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Path to myCampaignManager &nbsp;&nbsp;</font></td>
        <td><input type="text" class="inputText" NAME="strPath" SIZE="25" value="<? print $strGuessDir; ?>"> (with trailing slash)</td>
      </tr>
      <tr>
        <td ALIGN="left" colspan="2"><font class="textPageSubTitle">Database Settings</font></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Database Name &nbsp;&nbsp;</font></td>
        <td><input type="text" class="inputText" NAME="strDBName" SIZE="25" value=""></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Database Host &nbsp;&nbsp;</font></td>
        <td><input type="text" class="inputText" NAME="strDBHost" SIZE="25" value="localhost"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Database User &nbsp;&nbsp;</font></td>
        <td><input type="text" class="inputText" NAME="strDBUser" SIZE="25" value="root"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Database Password &nbsp;&nbsp;</font></td>
        <td><input type="password" class="inputText" NAME="strDBPass" SIZE="25" value=""></td>
      </tr>
      <tr>
        <td ALIGN="right">&nbsp;</td>
        <td><input type="submit" value="Install" class="searchInput"></td>
      </tr>
    </table>
   <input type="hidden" name="bSubmitted" value="1">
   </form>
    </td>
  </tr>
</table>
<?

	} // end function displayForm()

?>
