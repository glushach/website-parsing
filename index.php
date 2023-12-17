<?php
header('Content-type: text/html; charset=utf-8');
require 'phpQuery.php';

function print_arr($arr)
{
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

function parser($url, $start, $end) {
  if ($start < $end) {
    $file = file_get_contents($url);
    $doc = phpQuery::newDocument($file);

    foreach ($doc->find('.row.post-list .post-list-item') as $article) {
      $article = pq($article);
    
      $img = $article->find('.post-image');
    
      foreach ($img as $element) {
        $element = pq($element);
        $style = $element->attr('style');
    
        // Используем регулярное выражение для извлечения URL из строки стиля
        preg_match('/background-image:\s?url\((.*?)\)/', $style, $matches);
        if (isset($matches[1])) {
            $url = $matches[1];
            echo "<img src={$url}>";
        }
      }

      $text = $article->find('.post-content')->html();
      echo $text;
      echo '<hr>';
    }

    $next = $doc->find('.pagination .active')->next()->find('a')->attr('href');

    if (!empty($next)) {
      $start++;
      parser($next, $start, $end);
    }
  }
}

$url = 'https://www.kolesa.ru/news?page=6751';
$start = 0;
$end = 3;

parser($url, $start, $end);
