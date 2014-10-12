<?php

require '../../vendor/autoload.php';

use Elastic\FreePBX\Manager\Entity\Trunk;
use Elastic\FreePBX\Entity\SIPTrunk;
use Elastic\FreePBX\Manager\SIPTrunkManager;
use Elastic\FreePBX\Form\SIPTrunkForm;
use Elastic\FreePBX\Entity\SIPTrunkPeerDetails;
use Elastic\FreePBX\Entity\SIPTrunkUserDetails;
use Elastic\FreePBX\Entity\RegisterString;
use Elastic\FreePBX\Utils\PrintPre;
use Elastic\FreePBX\Entity\Login;

$login = new Login();
$login->username = "admin";
$login->password = "123456";
$login->ipaddr = "172.18.1.101";


$t = new Trunk();
$t->trunkName = "voiplink";
$t->outCID = "147163";
$t->maxChans = "1";
$t->peerUsername = "147163";
$t->peerPassword = "3S183P";
$t->peerHost = "voiprakyat.or.id";

$stm = new SIPTrunkManager();
$stm->setLogin($login);
$c = $stm->save($t);

PrintPre::out($c);


