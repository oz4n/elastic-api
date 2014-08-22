<?php

require '../../vendor/autoload.php';

use Elastic\FreePBX\Core\CurlCore;
use Elastic\FreePBX\Form\LoginForm;
use Elastic\FreePBX\Entity\Login;
use Elastic\FreePBX\Entity\SIPExtension;
use Elastic\FreePBX\Form\SIPExtensionForm;
use Elastic\FreePBX\Entity\DevInfo;
use Elastic\FreePBX\Entity\AssignDIDAndCID;

$doc = new DOMDocument();