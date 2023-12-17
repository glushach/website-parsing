<?php
header('Content-type: text/html; charset=utf-8');
require 'phpQuery.php';

function print_arr($arr)
{
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

function get_content($url, $data = [])
{
  $ch = curl_init($url);
  // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
  $res = curl_exec($ch);
  curl_close($ch);
  return $res;
}

$url_auth = 'http://wordpress/wp-login.php';
$url = 'http://wordpress/zakrytaya-statya/';
$auth_data = [
  'log' => 'admin',
  'pwd' => '123',
  'rememberme' => 'on',
];

$data = get_content($url_auth, $auth_data);
$data = get_content($url);
var_dump($data);
