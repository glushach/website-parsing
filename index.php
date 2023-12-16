<?php
header('Content-type: text/html; charset=utf-8');
require 'phpQuery.php';

$url = 'https://privatbank.ua/';
$file = file_get_contents($url);

/* $pattern = '#<div class="wr_inner course_type_container.+?</div>#s';
preg_match($pattern, $file, $matches);

print_r($matches); */

$doc = phpQuery::newDocument($file);
// $tbl = $doc->find('[data-cource_type="posts_course"] table');
$tr = $doc->find('[data-cource_type="posts_course"] table tbody tr:eq(2) td:eq(2)')->text();
echo $tr;
