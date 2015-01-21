<?

    class SmartObjectBrain {

    	var $aObjectStack = null;
    	var $aTraceStack = null;
       var $aContentStack = null;
    	var $oCurrentObject = null;
    	var $bDebug = false;

    	function printDebug($strMsg) {
    	    print "<!-- $strMsg  -->\n";
    	}

    	function SmartObjectBrain($strStartObject = "", $bDebug = false,$strReturnObject="") {
    		if ($bDebug)
                $this->printDebug("Called:  SmartObjectBrain::SmartObjectBrain()");
    		$this->bDebug = $bDebug;
    		$this->aObjectStack = array();
    		$this->aTraceStack = array();
              $this->aContentStack = array();
            // Everythings ready to go...
            // Check to see if we should run without a brain :)
            if ($strStartObject == "")
                return;
    		$this->newSmartObject($strStartObject,$strReturnObject);
    	}

    	function newSmartObject($strObjectName,$strReturnObject="") {
    		if ($this->bDebug)
                $this->printDebug("Called:  SmartObjectBrain::newSmartObject()");
	        array_push($this->aObjectStack, $this->oCurrentObject);
            $this->loadObjectClass($strObjectName);
	        $strShortName = array_pop(split('\.', $strObjectName));
            $this->oCurrentObject = new $strShortName($this,$strObjectName,$strReturnObject);
            array_pop($this->aObjectStack);
    	}

    	function loadObjectClass($strObjectName) {
            array_push($this->aTraceStack,$strObjectName);
    		$aClassPath = split('\.', $strObjectName);
    		$strBuffer = join($aClassPath,"/");
	        $strShortName = array_pop(split('\.', $strObjectName));
	        if (! class_exists($strShortName))
    		    include_once(SMART_OBJECT_LIBRARY_PATH . $strBuffer . ".class.php");
    	}

    	function getCurrentObjectName() {
    	    return $this->aTraceStack[sizeof($this->aTraceStack) - 1];
    	}

    	function loadContent($strContentName) {
            array_push($this->aContentStack, $strContentName);
    		$aClassPath = split('\.', $strContentName);
    		$strBuffer = join($aClassPath,"/");
    		include(SMART_OBJECT_LIBRARY_PATH . $strBuffer . '.php');
    		return;
    	}
    	
    }

    function SmartObjectCreateOrphan($strObjectName,$bDebug=false) {
    	$oSmartObjectBrain = new SmartObjectBrain($strObjectName,$bDebug);
    }

?>
