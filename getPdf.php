<?php

header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename='stub.pdf'");

$echo = file_get_contents('./' . $_REQUEST["filename"]);
writeLog("DOWNLOAD: " . "./" . $_REQUEST["filename"] . " / " . $echo ? "SUCCEDED" : "FAILED");

echo $echo;
