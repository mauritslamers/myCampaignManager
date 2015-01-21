<?
   //////////////////////////////////////////
   // Database Classes

   class ADODBDataObject {
       var $DB = null;
       var $strTableName = null;
       var $strPrimaryKey = null;
       var $aFieldList = null;

       function ADODBDataObject($oDB = null) {
           $this->DB = $oDB;
       }

       function setDBConnection(&$oDB) {
           $this->DB = $oDB;
       }
       function storeObject() {
    	    if ($this->{$this->strPrimaryKey} == 0)
    	        return $this->insertObject();
    	    else
    	        return $this->updateObject();
       }
       function insertObject() {
           if ($this->aFieldList == null || sizeof($this->aFieldList) == 0)
               return false;

       	   $strQuery = "INSERT INTO " . $this->strTableName;
       	   $strQuery .= " (";
       	   $nCount = 0;
           foreach ($this->aFieldList as $strField) {
           	   if (($nCount+1) == sizeof($this->aFieldList))
                   $strQuery .= $strField;
               else
                   $strQuery .= $strField . ",";
               $nCount++;
           }
           $strQuery .= ") VALUES(";
       	   $nCount = 0;
           foreach ($this->aFieldList as $strField) {
           	   if (($nCount+1) == sizeof($this->aFieldList))
                   $strQuery .= "\"" . str_replace("\"","\\\"",$this->{$strField}) . "\"";
               else
                   $strQuery .= "\"" . str_replace("\"","\\\"",$this->{$strField}) . "\", ";
               $nCount++;
           }
           $strQuery .= ")";

           $myResult = $this->DB->Execute($strQuery);
           return $myResult;
       }
       function updateObject() {
           if ($this->aFieldList == null || sizeof($this->aFieldList) == 0)
               return false;

       	   $strQuery = "UPDATE " . $this->strTableName . " SET ";
       	   $nCount = 0;
           foreach ($this->aFieldList as $strField) {
           	   if ($strField != $this->strPrimaryKey) {
           	       if (($nCount+1) == sizeof($this->aFieldList)) {
                       $strQuery .= $strField . "=\"" . str_replace("\"","\\\"",$this->{$strField}) . "\"";
           	       }
                   else
                       $strQuery .= $strField . "=\"" . str_replace("\"","\\\"",$this->{$strField}) . "\", ";
           	   }
               $nCount++;
           }

           $strQuery .= " WHERE " . $this->strPrimaryKey . " = " . $this->{$this->strPrimaryKey};
           //print $strQuery;
           $myResult = $this->DB->Execute($strQuery);
           return $myResult;
       }
       function loadObject($strFieldName,$strValue,$bReturnObject=true) {
           $strQuery = "SELECT * FROM " . $this->strTableName . " WHERE " . $strFieldName . " = \"" . str_replace("\"","\\\"",$strValue) . "\"";
           $myResult = $this->DB->Execute($strQuery);
           if ($myResult === false)
               return $myResult;
           else {
               $strClassName = get_class($this);
               $oReturn = new $strClassName;
               $oTmp = $myResult->FetchNextObject(false);
               if ($oTmp) {
                   foreach ($this->aFieldList as $strField) {
                       $oReturn->{$strField} = $oTmp->{$strField};
                   }
               }
               $oReturn->DB = &$this->DB;
               if ($bReturnObject)
                   return $oReturn;
               else {
                   $this->importADODBObject($oReturn);
                   return true;
               }
           }

       }
       function loadObjectEx($aFields,$bReturnObject=true) {
           $strQuery = "SELECT * FROM " . $this->strTableName . " ";
           $nCount = 0;
           $strWhere = "WHERE ";
           foreach ($aFields as $strField => $strValue) {
               $strWhere .= "$strField = \"" . str_replace("\"","\\\"",$strValue) . "\" ";
               $nCount++;
               if ($nCount != sizeof($aFields))
                   $strWhere .= "AND ";
           }
           if ($nCount > 0)
               $strQuery .= $strWhere;

           $myResult = $this->DB->Execute($strQuery);
           if ($myResult === false)
               return $myResult;
           else {
               $strClassName = get_class($this);
               $oReturn = new $strClassName;
               $oTmp = $myResult->FetchNextObject(false);
               if ($oTmp) {
                   foreach ($this->aFieldList as $strField) {
                       $oReturn->{$strField} = $oTmp->{$strField};
                   }
               }
               $oReturn->DB = &$this->DB;
               if ($bReturnObject)
                   return $oReturn;
               else {
                   $this->importADODBObject($oReturn);
                   return true;
               }
           }

       }
       function loadObjectArray($aFields) {
           $strQuery = "SELECT * FROM " . $this->strTableName . " ";
           $nCount = 0;
           $strWhere = "WHERE ";
           foreach ($aFields as $strField => $strValue) {
               $strWhere .= "$strField = \"" . str_replace("\"","\\\"",$strValue) . "\" ";
               $nCount++;
               if ($nCount != sizeof($aFields))
                   $strWhere .= "AND ";
           }
           if ($nCount > 0)
               $strQuery .= $strWhere;

           $myResult = $this->DB->Execute($strQuery);
           if ($myResult === false)
               return array();
           else {
               $strClassName = get_class($this);
               $aReturn = array();
               while ($oTmp = $myResult->FetchNextObject(false)) {
                   $oReturn = new $strClassName;
                   foreach ($this->aFieldList as $strField) {
                       $oReturn->{$strField} = $oTmp->{$strField};
                   }
                   $oReturn->DB = &$this->DB;
                   $aReturn[] = $oReturn;
               }
               return $aReturn;
           }

       }

       function importADODBObject($oTmp) {
           foreach ($this->aFieldList as $strField) {
               $this->{$strField} = $oTmp->{$strField};
           }
       }

       function importFromGlobalVars() {
           foreach ($this->aFieldList as $strField) {
               global $$strField;
               $this->{$strField} = $$strField;
           }
       }
   }

?>
