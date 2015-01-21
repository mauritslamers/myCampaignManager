<span class="textPageTitle">Edit Article</span><br />
<? if ($this->oArticle->campaign_article_type == "") $oArticle->campaign_article_type = "Article"; global $campaign_id; ?>
  Fill out the following information as needed:
    <form method="POST" name="oArticleForm" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Title *&nbsp;&nbsp;</font></td>
        <td><input TYPE="text" autocomplete="off" class="inputText" NAME="campaign_article_title" SIZE="71" value="<? print $this->oArticle->campaign_article_title; ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Text *&nbsp;&nbsp;</font></td>
        <td><textarea NAME="campaign_article_text" rows="10" cols="70"><? print $this->oArticle->campaign_article_text; ?></textarea></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Type *&nbsp;&nbsp;</font></td>
        <td>
            <select class="inputText" name="campaign_article_type">
                <option value="Header" <? if ($this->oArticle->campaign_article_type == 'Header') print "selected"; ?>>Header</option>
                <option value="Normal" <? if ($this->oArticle->campaign_article_type == 'Normal') print "selected"; ?>>Normal</option>
                <option value="Footer" <? if ($this->oArticle->campaign_article_type == 'Footer') print "selected"; ?>>Footer</option>
            </select>
        </td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Sort Order *&nbsp;&nbsp;</font></td>
        <td><input TYPE="text" autocomplete="off" class="inputText" NAME="campaign_article_sort_order" SIZE="5" value="<? print $this->oArticle->campaign_article_sort_order; ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Include in TOC? *&nbsp;&nbsp;</font></td>
        <td><input TYPE="checkbox" autocomplete="off" class="inputText" NAME="campaign_article_toc" <? if ($this->oArticle->campaign_article_toc) print "checked"; ?>></td>
      </tr>
      <tr>
        <td> </td>
        <td><input type="button" value="Insert an Image" onClick="return onAddImageLink();"><br /><br /></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel"> &nbsp;&nbsp;</font></td>
        <td><input type="image" src="/images/button_save.gif" value="Save" class="searchInput">  <a href="#" onClick="location = '<? print $_SERVER["PHP_SELF"]; ?>?RequestObject=Objects.CampaignManager.EditCampaign&campaign_id=<? print $campaign_id; ?>'"><img border="0" src="/images/button_cancel.gif"></a></td>
      </tr>
    </table>
  <input type="hidden" name="RequestObject" value="Objects.CampaignManager.EditArticle">
  <input type="hidden" name="campaign_article_id" value="<? print $this->oArticle->campaign_article_id; ?>">
  <input type="hidden" name="campaign_id" value="<? print $campaign_id; ?>">
  <input type="hidden" name="bSubmitted" value="1">
  </form>

<script language="JavaScript" src="/includes/js/windowFunctions.php"></script>
<script language="JavaScript">
var oWindow;
function onAddImageLink() {
	document.oWindow = loadAddImageFileWindow("<? print $_SERVER['PHP_SELF']; ?>?RequestObject=Objects.CampaignManager.AddArticleImage&bPopup=1");
}
</script>
