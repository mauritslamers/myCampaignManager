<?
   // siteConfig.php
   //     Config File for DB Access

   define('CM_WEBSITE_URL','http://your.server.com/');
   define('CM_INSTALL_DIR','/path/to/myCampaignManager/');

   //////////////////////////////////////////
   // Debug Configuration
   // Disable DEBUG MODE if running in production!!!
   $bDebug = 0;

   //////////////////////////////////////////
   // Database Configuration

   $GLOBAL_DB_NAME = '';	// Name of Database
   $GLOBAL_DB_HOST = '';	// Database host
   $GLOBAL_DB_USER = '';		// Database Username
   $GLOBAL_DB_PASS = '';	// Database Password

   //////////////////////////////////////////
   // SmartObject Configuration
   define('SMART_OBJECT_LIBRARY_PATH', CM_INSTALL_DIR . 'includes/SmartObjects/');

   //////////////////////////////////////////
   // Image Upload Configuration
   define('JUPLOAD_UPLOAD_DIRECTORY', CM_INSTALL_DIR . 'images/cm_thumbnails/');
   define('JUPLOAD_MAX_LENGTH','200');


?>
