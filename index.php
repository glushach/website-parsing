<?php
header('Content-type: text/html; charset=utf-8');
require 'phpQuery.php';

$url = 'https://privatbank.ua/';
$file = file_get_contents($url);

/* $pattern = '#<div class="wr_inner course_type_container.+?</div>#s';
preg_match($pattern, $file, $matches);

print_r($matches); */

$doc = phpQuery::newDocument($file);
var_dump($doc);
