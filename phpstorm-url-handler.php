#!/usr/bin/env php
<?php

$input = $argv[1];

if (preg_match('/.*file=(.*)&line=(.*)/', $input, $match)) {
    $file = $match[1];
    $line = $match[2];
} elseif (preg_match('/.*file=(.*)/', $input, $match)) {
    $file = $match[1];
    $line = 0;
}

$map = [
    '/home/td/sites/td3.crm' => '/home/fed/sites/td3',
    '/home/td/sites/td3.dev' => '/home/fed/sites/td3',
];

$file = str_replace(array_keys($map), array_values($map), $file);

if (isset($file)) {
    exec('/usr/bin/env phpstorm --line "' . $line . '" "' . $file . '"');
}
