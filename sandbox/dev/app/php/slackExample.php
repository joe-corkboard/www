<?php
	#1st POST variable
	$fileName = $_POST["filename"];
	$fileLink = $_POST["slack"];
	#2nd POST variable
	$xmlContents = $_POST["xmlcontents"];
	#remove backslashes from xml string (skip this for plain text)
	$lastBackslashPos = strpos ($xmlContents, "\\");
	while($lastBackslashPos >0){
		$xmlContents = substr($xmlContents,0,$lastBackslashPos)
			.substr($xmlContents,$lastBackslashPos+1,strlen($xmlContents));
		$lastBackslashPos = strpos ($xmlContents, "\\");
	}
	#write xml data to file on server
	$fh = fopen($fileName, "w");
	fwrite($fh, $xmlContents);
	fclose($fh);

	#$message = "<http://www.budstv.org|Click to view registration>";

	$data = "payload=" . json_encode(array(
				"username"	=> "NEW PLAYER REGISTRATION",
                "channel"       =>  "#alerts",
                "text"          =>  $fileLink,
                "icon_url"    =>  "http://www.budstv.org/app/assets/slack/registration_new.png"
            ));
	
        $ch = curl_init("https://hooks.slack.com/services/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");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
?>