<?php
header('Content-type: text/html; charset=utf-8');
require 'phpQuery.php';

function print_arr($arr)
{
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

$url = 'https://www.kolesa.ru/news';
$file = file_get_contents($url);

$doc = phpQuery::newDocument($file);

foreach ($doc->find('.row.post-list .post-list-item') as $article) {
  $article = pq($article);

  // $article->find('.post-category')->remove();
  // $article->find('.post-category')->prepend('Категория: ');
  $article->find('.post-category')->wrap('<strong class="category">')->after('Датa: ' . date("Y-m-d H:i:s"));

  $img = $article->find('.post-image');

  foreach ($img as $element) {
    $element = pq($element);
    $style = $element->attr('style');

    // Используем регулярное выражение для извлечения URL из строки стиля
    preg_match('/background-image:\s?url\((.*?)\)/', $style, $matches);
    if (isset($matches[1])) {
        $url = $matches[1];
        // echo $url . '<br/>';
        echo "<img src={$url}>";
    }
  }

  $text = $article->find('.post-content')->html();
  echo $text;
  echo '<hr>';
}
