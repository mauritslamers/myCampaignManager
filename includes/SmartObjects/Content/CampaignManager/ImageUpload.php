<table border="0" cellpadding="0" cellspacing="0" width="500">
  <tr>
    <td>
<span class="textPageTitle">Upload Images</span><br />
<br />
This tool allows you to upload image files from your computer to this server.  To do this, follow these simple steps:
<ol>
  <li>Click the "Browse" button below.
  <li>Locate the file(s) you wish to upload.
  <li>Click the "Open" button.
  <li>Once all the desired files are listed, click on the "Upload" button.
</ol>

<b>Note:</b>
<ul>
	<li>Only image files will be accepted by the server.
	<li>Large image files will be resized so that the length of their longest side is 200 pixels.
	<li>Image files smaller than 200 pixels will not be resized.
	<li>Images will be automatically removed from the server after three months without warning.
	<li>Maximum upload size is 25 MB.
</ul><br />
    </td>
  </tr>
</table>

<OBJECT classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93"
    width="500" height="300"
    codebase="http://java.sun.com/products/plugin/autodl/jinstall-1_4_2-windows-i586.cab#Version=1,4,2,0">
    <PARAM name="code" value="wjhk.jupload.JUploadApplet">
    <PARAM name="codebase" value="<? print CM_WEBSITE_URL; ?>includes/utility/jupload/">
    <PARAM name="java_archive" value="wjhk.jupload.jar">
    <PARAM name="type" value="application/x-java-applet;jpi-version=1.4.2">
    <PARAM name="postURL" value="<? print CM_WEBSITE_URL; ?>includes/utility/jupload/jImageUpload.php?nMaxWidth=<? print JUPLOAD_MAX_LENGTH; ?>&nUserID=<? global $oUser; print $oUser->user_id; ?>">
    <COMMENT>
        <applet
             codebase = "<? print CM_WEBSITE_URL; ?>includes/utility/jupload/"
             code     = "wjhk.jupload.JUploadApplet"
             archive  = "wjhk.jupload.jar"
             name     = "JUploadApplet"
             width    = "500"
             height   = "300"
             hspace   = "0"
             vspace   = "0"
             align    = "top"
           >
           <PARAM name="postURL" value="<? print CM_WEBSITE_URL; ?>includes/utility/jupload/jImageUpload.php?nMaxWidth=<? print JUPLOAD_MAX_LENGTH; ?>&nUserID=<? global $oUser; print $oUser->user_id; ?>">
        </applet>
  </COMMENT>
</OBJECT>
<?

if ($handle = opendir(JUPLOAD_UPLOAD_DIRECTORY)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
 			$dExpiration = mktime(0, 0, 0, date("m")-3, date("d"),  date("Y"));
 			$dFileDate = filectime(JUPLOAD_UPLOAD_DIRECTORY.$file);
 			if ($dFileDate < $dExpiration)
 				unlink(JUPLOAD_UPLOAD_DIRECTORY.$file);
       }
    }
    closedir($handle);
}
?>