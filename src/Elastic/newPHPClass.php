<?php

require '../../vendor/autoload.php';

use Elastic\FreePBX\Core\CurlCore;
use Elastic\FreePBX\Form\LoginForm;
use Elastic\FreePBX\Entity\Login;
use Elastic\FreePBX\Entity\SIPExtension;
use Elastic\FreePBX\Form\SIPExtensionForm;
use Elastic\FreePBX\Entity\DevInfo;
use Elastic\FreePBX\Entity\AssignDIDAndCID;
use Sunra\PhpSimple\HtmlDomParser;
use Elastic\FreePBX\Manager\Entity\SIP;
use Elastic\FreePBX\Utils\PrintPre;

$c = new CurlCore();
$curl = $c->getCurl();

$lf = new LoginForm();
$le = new Login();
$le->ipaddr = "192.168.56.101";
$le->username = "admin";
$le->password = "123456";
$lf->setEntity($le);


$sf = new SIPExtensionForm();
$se = new SIPExtension();
$se->action = 'edit';
$se->extDisplay = 2016;
$sf->setEntity($se);
$sf->setLogin($le);


//login curl
$data = $lf->getPostData();
$url = $lf->getURL();
$curl->get($url);
$curl->post($url, $data);
//second execution for adding new sip extension
$d2 = $sf->getSIPData();
$u2 = $sf->getUpdateURL();
$curl->get($u2, $d2);


$dom = HtmlDomParser::str_get_html($curl->response);

$nm = $dom->find('input[name=name]');
$name = $nm[0]->attr['value'];

$spname = $dom->find('input[name=sipname]');
$extension = $spname[0]->attr['value'];

$sec = $dom->find('input[name=devinfo_secret]');
$secret = $sec[0]->attr['value'];


PrintPre::out();


//echo count();



