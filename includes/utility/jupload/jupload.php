<?
print "File upload successful.";

if (sizeof($_FILES) > 0) {
	foreach ($_FILES as $aFile) {		
		// File and new size
		$picture =$aFile['tmp_name']; // picture fileNAME here. not address
		
		print "Found picture: " . $aFile['name'] . "\n";
		
		if ($_GET['nMax'] > 0)
		    $max = $_GET['nMax'];
		else
		    $max=150;    // maximum size of 1 side of the picture.
		/*
		here you can insert any specific "if-else",
		or "switch" type of detector of what type of picture this is.
		in this example i'll use standard JPG
		*/
		
		print "Attempting to resize...\t\t";

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
		
			$strNewDest = "/home/reclaiming/public_html/images/cm_thumbnails/";
			$strDestFile = date("Ymd") . "-" . $aFile['name'];

			ImageJpeg($dst_img, $strNewDest . $strDestFile);
			print "[OK]\n";
		}
		else
			print "[FAILED]\n";

	}
}


?>