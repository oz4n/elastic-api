<?php

require '../../vendor/autoload.php';

use Elastic\FreePBX\Manager\SIPManager;
use Elastic\FreePBX\Manager\Entity\SIP;
use Elastic\FreePBX\Entity\Login;
use \Elastic\FreePBX\Utils\PrintPre;

$le = new Login();
$le->ipaddr = "192.168.56.101";
$le->username = "admin";
$le->password = "123456";

$sm = new SIPManager();
$sm->setLogin($le);
$list = $sm->listAll();
foreach ($list as $val) {
    echo $val->id . " ";
    echo $val->name . " ";
    echo $val->extension . "<br>";
}

//Find by extension id
PrintPre::out($sm->find(200982), true);

//Add SIP
$sip = new SIP();
$sip->name = 'Awan';
$sip->extension = "20201";
$sip->secret = 'rty009';
$sm->add($sip);

//Edit SIP
$sip = new SIP();
$sip->id = "20201";
$sip->name = 'Fandi';
$sip->extension = "200982";
$sip->secret = 'ty278uy';
$sm->add($sip);

//delete SIP
$sm->delete(20054);







