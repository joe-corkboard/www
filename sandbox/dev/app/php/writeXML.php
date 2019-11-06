<?php
	#Retrieve variables from POST
	$fileName = $_POST["filename"];
	$filePath = $_POST["filepath"];
	$xmlContents = $_POST["xmlcontents"];
	
	#Create player directory if does not exist
	if (!file_exists($filePath)) {
    	mkdir($filePath, 0777, true);
	}
	#Remove backslashes from xml string (skip this for plain text)
	$lastBackslashPos = strpos ($xmlContents, "\\");
	while($lastBackslashPos >0){
		$xmlContents = substr($xmlContents,0,$lastBackslashPos)
			.substr($xmlContents,$lastBackslashPos+1,strlen($xmlContents));
		$lastBackslashPos = strpos ($xmlContents, "\\");
	}
	#Write xml data to file on server
	$fh = fopen($fileName, "w");
	fwrite($fh, $xmlContents);
	fclose($fh);
?>