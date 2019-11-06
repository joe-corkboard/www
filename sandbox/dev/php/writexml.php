<?php

$xmldata = $_POST["xmldata"];
$foldername = $_POST["foldername"];
$filename = $_POST["filename"];

if(! file_exists("../content/".$foldername."/")){
    mkdir("../content/".$foldername."/", 0777);
}

$handle = fopen("../content/".$foldername."/".$filename, 'w+');
fwrite($handle, $xmldata );
fclose($handle);

echo "result=success";

?>