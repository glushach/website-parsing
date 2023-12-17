<?php
header('Content-type: text/html; charset=utf-8');
require 'phpQuery.php';

function print_arr($arr)
{
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

function get_content($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $res = curl_exec($ch);
  curl_close($ch);
  return $res;
}

function parser($url, $start, $end) {
  if ($start < $end) {
    // $file = file_get_contents($url);
    $file = get_content($url);
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

$url = 'https://www.kolesa.ru/news/';
$start = 0;
$end = 3;

parser($url, $start, $end);

/* $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_exec($ch);
curl_close($ch); */

/* $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
curl_close($ch);  */

/* $fp = fopen("file.txt", "w");
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_FILE, $fp);
$res = curl_exec($ch);
curl_close($ch);
var_dump($res); */


/* $ch = curl_init($url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch); */
