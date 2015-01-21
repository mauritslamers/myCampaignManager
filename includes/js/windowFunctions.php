<?

if ($_SERVER["HTTPS"] == "on")
    $strProtocol = "https://";
else
    $strProtocol = "http://";

?>
    function loadPopupWindow(strUrl) {
    	oWindow = window.open("","popup_window","toolbar=no, location=no, directories=no, status=yes, menubar=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=400, height=400");
    	oWindow.location = "<? print $strProtocol . $_SERVER['HTTP_HOST']; ?>/" + strUrl;
    	return oWindow;
    }
    function loadAddImageFileWindow(strUrl) {
    	oWindow = window.open("","popup_window","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=400, height=400");
    	oWindow.location = strUrl;
    	return oWindow;
    }
