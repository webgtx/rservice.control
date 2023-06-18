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
$allowed_cmd = new FileData(".config/allowed.dat");
$ip_arr = explode("\n", $ip_list->fdata);
$allowed_arr = explode("\n", $allowed_cmd->fdata);
$stdout = null;
foreach($allowed_arr as $cmd)
  $allowed_arr[$cmd] = 1;


foreach($ip_arr as $ip) {
  if ($_SERVER['REMOTE_ADDR'] == $ip && $allowed_arr[$_POST['shell']] == 1) {
    if ($_POST['key'] != $private_key->fdata) continue;
    exec($_POST['shell'], $stdout); 
    echo implode("\n", $stdout);
    break;
  }
}

if (!$stdout) echo "Access denied >:[ \n";
