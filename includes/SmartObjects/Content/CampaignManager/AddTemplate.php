<span class="textPageTitle">Edit Template</span><br />
  Set up the template using the following form.  The title can be anything helpful to you for uniquely identifying this template.<br /><br />
  <b>NOTES:</b>
  <ul>
    <li>The tempalte should be complete HTML source.</li>
    <li>The template must include ONE occurrence of the the keyword &lt;!--campaignContent--&gt;.
    <li>The &lt;!--campaignContent--&gt keyword will be automatically replaced by the campaign's content when published.</li>
  </ul><br />
  <form method="POST" name="NewTemplate" action="<? print $_SERVER["PHP_SELF"]; ?>">
    <table>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Title *&nbsp;&nbsp;</font></td>
        <td><input TYPE="text" autocomplete="off" class="inputText" NAME="template_title" SIZE="71" value="<? print $this->oTemplate->template_title; ?>"></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel">Text *&nbsp;&nbsp;</font></td>
        <td><textarea NAME="template_text" rows="10" cols="70"><? print $this->oTemplate->template_text; ?></textarea></td>
      </tr>
      <tr>
        <td ALIGN="right"><font class="textFieldLabel"> &nbsp;&nbsp;</font></td>
        <td><input type="image" src="/images/button_save.gif" value="Save" class="searchInput">  <a href="#" onClick="location = '<? print $_SERVER["PHP_SELF"]; ?>?RequestObject=Objects.CampaignManager.ListTemplates'"><img border="0" src="/images/button_cancel.gif"></a></td>
      </tr>
    </table>
  <input type="hidden" name="RequestObject" value="Objects.CampaignManager.AddTemplate">
  <input type="hidden" name="bSubmitted" value="1">
  </form>
