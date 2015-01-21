<?
   // config.php
   //     Config File for DB Access

   // Start Output Buffering
   ob_start();

   // Load the local configuration settings
   include_once("includes/siteConfig.php");

   // Load ADODB database abstraction
   include_once("includes/adodb/adodb.inc.php");
   
   // The DB object level abstraction...
   include_once("includes/database/ADODBDataObject.class.php");
   include_once("includes/database/ADODBDataCollection.class.php");
   include_once("includes/database/Tables.class.php");

   include_once("includes/SmartObjects/SmartObjectBrain.class.php");
   include_once("includes/SmartObjects/SmartObject.class.php");

   $myDB = &ADONewConnection('mysql');
   $myDB->PConnect($GLOBAL_DB_HOST,$GLOBAL_DB_USER,$GLOBAL_DB_PASS,$GLOBAL_DB_NAME);

   function onError($strMessage) {
       print "<script language=\"JavaScript\">alert('$strMessage');</script>\n";
   }

?>
