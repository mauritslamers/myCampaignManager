<?
   //////////////////////////////////////////
   // Database Classes

   class ADODBDataCollection {
       var $DB = null;
       var $strObjectClass = "";
       var $aObjects = null;
       var $aConditionals = null;
       var $strOrderBy = "";
       var $nNumberOfObjects = 0;

       function ADODBDataCollection($oDB = null,$strObjectClass="ADODBDataObject") {
           $this->DB = $oDB;
           $this->strObjectClass = $strObjectClass;
           $this->aObjects = array();
           $this->aConditionals = array();
       }

       function setDBConnection(&$oDB) {
           $this->DB = $oDB;
       }

       function addConditional($strCond) {
       	   $this->aConditionals[] = $strCond;
       }

       function setOrderBy($strStatement) {
       	   $this->strOrderBy = $strStatement;
       }

       function loadObjects() {
       	   $strClassName = $this->strObjectClass;
       	   $oObject = new $strClassName;
       	   $oObject->setDBConnection($this->DB);
       	   $strQuery = "SELECT * FROM " . $oObject->strTableName;
       	   if (sizeof($this->aConditionals) > 0) {
       	   	  $strQuery .= " WHERE ";
       	   	  $bFirst = true;
       	   	  foreach ($this->aConditionals as $strCond) {
       	   	  	  if (!$bFirst)
       	   	  	  	  $strQuery .= " AND ";
       	   	  	  else
       	   	  	  	  $bFirst = false;
       	   	  	  $strQuery .= " " . $strCond . " ";
       	   	  }
       	   }
   	   	   if ($this->strOrderBy != "") {
   	   	  	   $strQuery .= " ORDER BY " . $this->strOrderBy;
   	   	   }
       	   $myRS = $this->DB->Query($strQuery);
       	   $nCount = 0;
       	   if ($myRS !== false) {
       	   	  while ($oTmp = $myRS->FetchNextObject(false)) {
       	   	  	  $oObject = new $strClassName;
       	   	  	  $oObject->importADODBObject($oTmp);
       	   	  	  $this->aObjects[$oObject->{$oObject->strPrimaryKey}] = $oObject;
         	   	  $nCount++;
       	   	  }
       	   }
       	   $this->nNumberOfObjects = $nCount;
   	   	   return $strQuery;

       }

       function getCollectionAsArray() {
           return $this->aObjects;
       }

   }

?>