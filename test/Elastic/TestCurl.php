<?php

require '../../vendor/autoload.php';

use Curl\Curl;

$cookiefile = tempnam("/tmp", "cookies");
$user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1';

$curl = new Curl();
$curl->setUserAgent($user_agent);
$curl->setOpt(CURLOPT_HEADER, 0);
$curl->setopt(CURLOPT_RETURNTRANSFER, TRUE);
$curl->setopt(CURLOPT_FOLLOWLOCATION, TRUE);
$curl->setopt(CURLOPT_SSL_VERIFYPEER, FALSE);
$curl->setopt(CURLOPT_SSL_VERIFYHOST, FALSE);
$curl->setopt(CURLOPT_COOKIEFILE, $cookiefile);
$curl->setopt(CURLOPT_COOKIEJAR, $cookiefile);

$get = $curl->get('google.com');

var_dump($curl);

