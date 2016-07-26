<?php
// ini_set('xdebug.max_nesting_level', 3000);

require 'vendor/autoload.php';

$file = $argv[1];
$code = file_get_contents($file);

$transpiler = new Glena\PhpJs\Transpiler();
$jsCode = $transpiler->transpile($code);

echo $jsCode;