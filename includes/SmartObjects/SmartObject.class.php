<?
    class SmartObject {
    	var $oObjectBrain = null;
    	var $strObjectPath = null;
    	var $strReturnPath = null;

    	function printDebug($strMsg) {
    	    print "<!-- $strMsg  -->\n";
    	}

    	function SmartObject(&$oObjectBrain,$strObjectPath="",$strReturnPath="") {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SmartObject::SmartObject()");
            $this->strObjectPath = $strObjectPath;
            if ($strReturnPath != "")
                $this->strReturnPath = $strReturnPath;
    		$this->oObjectBrain = &$oObjectBrain;
    		if ($this->objectPreProcessor()) {
    		    if ($this->objectProcessor())
    		        $this->objectPostProcessor();
    		}
    	}

    	function redirectRequest($strObjectName) {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SmartObject::redirectRequest($strObjectName)");
    		$this->oObjectBrain->newSmartObject($strObjectName);
    	}

    	function getObjectName() {
    	    return $this->oObjectBrain->getCurrentObjectName();
    	}

    	function setObjectDominance() {
    	    global $RequestObject;
    	    $RequestObject = $this->getObjectName();
    	}

    	function loadContent($strContentName) {
    		if ($this->oObjectBrain->bDebug)
    		    $this->printDebug("Called:  SmartObject::loadContent($strContentName)");
    		// $this->oObjectBrain->loadContent($strContentName);
            array_push($this->oObjectBrain->aContentStack, $strContentName);
    		$aClassPath = split('\.', $strContentName);
    		$strBuffer = join($aClassPath,"/");
    		include(SMART_OBJECT_LIBRARY_PATH . $strBuffer . '.php');
    		return;

    	}

    	function objectPreProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SmartObject::objectPreProcessor()");
    		return true;
    	}

    	function objectProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SmartObject::objectProcessor()");
    		return true;
    	}

    	function objectPostProcessor() {
    		if ($this->oObjectBrain->bDebug)
                $this->printDebug("Called:  SmartObject::objectPostProcessor()");
    		return true;
    	}

    }

?>
