<?php

require_once __DIR__ . '/Parser.php';

$url_auth = 'http://wordpress/wp-login.php';
$url = 'http://wordpress/zakrytaya-statya/';
$auth_data = [
  'log' => 'admin',
  'pwd' => '123',
  'rememberme' => 'on',
];

$parser = new Parser();
$parser->set(CURLOPT_POST, true)
->set(CURLOPT_POSTFIELDS, http_build_query($auth_data))
->set(CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt')
->set(CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');

// $data = $parser->exec($url_auth);
$data = $parser->exec($url);
var_dump($data);
