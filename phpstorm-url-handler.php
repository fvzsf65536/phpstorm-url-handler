#!/usr/bin/env php
<?php

chdir('/home/fed/projects/phpstorm-url-handler');

$logFile = fopen('main.log', 'a+');

$input = $argv[1];

if (preg_match('/.*file=(.*)&line=(.*)/', $input, $match)) {
    $file = $match[1];
    $line = $match[2];
} elseif (preg_match('/.*file=(.*)/', $input, $match)) {
    $file = $match[1];
    $line = 0;
}

$map = include 'map.php';

$fileR = str_replace(array_keys($map), array_values($map), $file);

fwrite($logFile, '--------------------------' . "\n");
fwrite($logFile, $input . "\n");
fwrite($logFile, $file . "\n");
fwrite($logFile, $fileR . "\n");
fwrite($logFile, "\n");

if (isset($file)) {
    exec('/usr/bin/env phpstorm --line "' . $line . '" "' . $fileR . '"');
}

fclose($input);
