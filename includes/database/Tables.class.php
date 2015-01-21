<?

   // Class campaign
   //     Supports DB access of the cm_campaigns table
   class campaign extends ADODBDataObject {
       var $campaign_id = 0;
       var $user_id = 0;
       var $campaign_name = "";
       var $template_id = 0;
       var $campaign_create_date = '0000-00-00';

       var $strTableName = "cm_campaigns";
       var $strPrimaryKey = "campaign_id";
       var $aFieldList = array(
       		"campaign_id",
       		"user_id",
       		"campaign_name",
       		"template_id",
       		"campaign_create_date"
		);

   }

   // Class user
   //     Supports DB access of the cm_users table
   class user extends ADODBDataObject {
       var $user_id = 0;
       var $user_email = '';
       var $user_passwd = 0;
       var $user_mailing_list = '';
       var $user_zip = '';
       var $user_admin = 0;

       var $strTableName = "cm_users";
       var $strPrimaryKey = "user_id";
       var $aFieldList = array(
       		"user_id",
       		"user_email",
       		"user_passwd",
       		"user_mailing_list",
       		"user_zip",
       		"user_admin"
		);

   }

   // Class template
   //     Supports DB access of the cm_templates table
   class template extends ADODBDataObject {
       var $template_id = 0;
       var $user_id = 0;
       var $template_title = '';
       var $template_text = '';

       var $strTableName = "cm_templates";
       var $strPrimaryKey = "template_id";
       var $aFieldList = array(
       		"template_id",
       		"user_id",
       		"template_title",
       		"template_text"
		);

		function getRenderedTemplate($aArticles) {
			$strBuffer = $this->template_text;
			$strBuffer = str_replace("<!--campaignContent-->", $this->getRenderedArticles($aArticles), $strBuffer);
			$strBuffer = str_replace("<!--tableOfContents-->", $this->getTableOfContents($aArticles), $strBuffer);
			return $strBuffer;
		}

    	function getRenderedArticles($aArticles) {
    		$strBuffer = "<a name=\"top\"></a>\n";
    		if (sizeof($aArticles) > 0) {
    			foreach ($aArticles as $oArticle) {
    				$strBuffer .= $oArticle->render();
    				$strBuffer .= "<br /><br />\n";

    			}
    		}
    		return $strBuffer;
    	}

    	function getTableOfContents($aArticles) {
    		$strBuffer = "";
    		if (sizeof($aArticles) > 0) {
    			foreach ($aArticles as $oArticle) {
    			    if ($oArticle->campaign_article_toc)
    				    $strBuffer .= "\n<a href=\"#" . $oArticle->campaign_article_id . "\">" . $oArticle->campaign_article_title . "</a><br />\n";
    			}
    		}
    		return $strBuffer;
    	}


   }

   // Class campaign_article
   //     Supports DB access of the cm_campaign_articles table
   class campaign_article extends ADODBDataObject {
       var $campaign_article_id = '';
       var $campaign_id = '';
       var $campaign_article_title = '';
       var $campaign_article_text = '';
       var $campaign_article_sort_order = "";
       var $campaign_article_type = '';
       var $campaign_article_image = "";
       var $campaign_article_toc = 1;

       var $strTableName = "cm_campaign_articles";
       var $strPrimaryKey = "campaign_article_id";
       var $aFieldList = array(
       		"campaign_article_id",
       		"campaign_id",
       		"campaign_article_title",
       		"campaign_article_text",
       		"campaign_article_sort_order",
       		"campaign_article_type",
       		"campaign_article_toc"
		);

		function render() {
			if ($this->campaign_article_type == 'Header')
			    return $this->renderHeader();
			elseif ($this->campaign_article_type == 'Footer')
			    return $this->renderFooter();
			else
			    return $this->renderArticle();
		}

		function translateImages($strBuffer) {
			while (strpos($strBuffer,"<articleImage ") !== false) {
				$nPos = strpos($strBuffer,"<articleImage ");
				// Take out the articleImage and split the string
				$strFirst = substr($strBuffer,0,$nPos);
				$strLast = substr($strBuffer,$nPos+14,strlen($strBuffer)-1);
				// extract the image filename
				$strImage = substr($strLast,0,strpos($strLast,'>'));
				$aImage = split(" ", $strImage);
				$strImageTag = "<img src=\"" . "/images/cm_thumbnails/" . $aImage[0] . "\"" . substr($strImage,strpos($strImage," "),strlen($strImage)) . " />";
				$strLast = substr($strLast,strpos($strLast,'>')+1,strlen($strLast)-1);
				$strBuffer = $strFirst . $strImageTag . $strLast;
			}

		    return $strBuffer;
		}

		function getArticleText() {
			return $this->translateImages($this->campaign_article_text);
		}

		function renderHeader() {
			$strText = $this->getArticleText();
			$strText = str_replace("\n","<br />\n",$strText);

			$strBuffer = "";
			$strBuffer .= "            <table class=\"tableSubTable\" width=\"100%\">\n";
			$strBuffer .= "              <tr>\n";
			$strBuffer .= "                <td class=\"tdEmailTitle\">" . $this->campaign_article_title . "</td>\n";
			$strBuffer .= "              </tr>\n";
			$strBuffer .= "              <tr>\n";
			$strBuffer .= "                <td class=\"tdDateText\">" . date("l, F j, Y") . "</td>\n";
			$strBuffer .= "              </tr>\n";
			$strBuffer .= "              <tr>\n";
			$strBuffer .= "                <td class=\"tdHeaderText\">\n";
			$strBuffer .= "                  " . $strText . "\n<br />";
  			if ($this->campaign_article_toc)
  				$strBuffer .= "              <a href=\"#top\">Back to Top</a><br />\n";
			$strBuffer .= "                </td>\n";
			$strBuffer .= "              </tr>\n";
			$strBuffer .= "            </table>\n";
			return $strBuffer;
		}

		function renderFooter() {
			$strText = $this->getArticleText();
			$strText = str_replace("\n","<br />\n",$strText);

			$strBuffer = "";
			$strBuffer .= "            <table class=\"tableSubTable\" width=\"100%\">\n";
			$strBuffer .= "              <tr>\n";
			$strBuffer .= "                <td class=\"tdArticleTitle\">" . $this->campaign_article_title . "</td>\n";
			$strBuffer .= "              </tr>\n";
			$strBuffer .= "              <tr>\n";
			$strBuffer .= "                <td class=\"tdBodyText\">\n";
			$strBuffer .= "                  " . $strText . "\n<br />";
  			if ($this->campaign_article_toc)
  				$strBuffer .= "              <a href=\"#top\">Back to Top</a><br />\n";
			$strBuffer .= "                </td>\n";
			$strBuffer .= "              </tr>\n";
			$strBuffer .= "            </table>\n";
			return $strBuffer;
		}

		function renderArticle() {
			$strText = $this->getArticleText();
			$strText = str_replace("\n","<br />\n",$strText);

			$strBuffer = "";
			$strBuffer .= "            <a name=\"" . $this->campaign_article_id . "\"></a>\n";
			$strBuffer .= "            <table class=\"tableSubTable\" width=\"100%\">\n";
			$strBuffer .= "              <tr>\n";
			$strBuffer .= "                <td class=\"tdArticleTitle\">" . $this->campaign_article_title . "</td>\n";
			$strBuffer .= "              </tr>\n";
			$strBuffer .= "              <tr>\n";
			$strBuffer .= "                <td class=\"tdBodyText\">\n";
			$strBuffer .= "                  " . $strText . "\n<br />";
  			if ($this->campaign_article_toc)
  				$strBuffer .= "              <a href=\"#top\">Back to Top</a><br />\n";
			$strBuffer .= "                </td>\n";
			$strBuffer .= "              </tr>\n";
			$strBuffer .= "            </table>\n";
			return $strBuffer;
		}

   }

?>
