<?

define("JUPLOAD_UPLOAD_DIRECTORY","/home/reclaiming/public_html/images/cm_thumbnails/");

if (sizeof($_FILES) > 0) {
	foreach ($_FILES as $aFile) {		
		// File and new size
		$picture =$aFile['tmp_name']; // picture fileNAME here. not address
				
		if ($_GET['nMaxWidth'] > 0)
		    $max = $_GET['nMaxWidth'];
		else
		    $max=150;    // maximum size of 1 side of the picture.
		    
		if ($_GET['nUserID'] > 0)
			$nUserID = $_GET['nUserID'];
		else
			$nUserID = 0;

		/*
		here you can insert any specific "if-else",
		or "switch" type of detector of what type of picture this is.
		in this example i'll use standard JPG
		*/

		// Replace Special Chars in filename...			
		$strFilename = str_replace(' ','_',$aFile['name']);
		$strFilename = preg_replace("/[^0-9a-zA-Z\_\.]/","",$strFilename);
		$strDestFile = strtolower($strFilename);
		$strDestFile = $nUserID . "-" . $strDestFile;
		
		print "Resizing " . $strDestFile . "...\t\t";

		$src_img=ImagecreateFromJpeg($picture);

		$oh = imagesy($src_img);  // original height
		$ow = imagesx($src_img);  // original width

		$new_h = $oh;
		$new_w = $ow;

		if($oh > $max || $ow > $max){
			$r = $oh/$ow;
			$new_h = ($oh > $ow) ? $max : $max*$r;
			$new_w = $new_h/$r;
		}
		// note TrueColor does 256 and not.. 8
		$dst_img = ImageCreateTrueColor($new_w,$new_h);

		if (ImageCopyResized($dst_img, $src_img, 0,0,0,0, $new_w, $new_h, ImageSX($src_img), ImageSY($src_img))) {
		
			$strNewDest = JUPLOAD_UPLOAD_DIRECTORY;
			
			ImageJpeg($dst_img, $strNewDest . $strDestFile);
			print "[OK]\n";
		}
		else
			print "[FAILED]\n";

	}
}
else
	print "No files were uploaded.";


?>