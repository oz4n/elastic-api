<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');

require '../../vendor/autoload.php';

use Curl\Curl;


$urlget = 'https://192.168.56.101/config.php';


$username = 'admin';
$password = '123456';



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



$url_login = 'https://192.168.56.101/index.php';
$login = [
    'input_user' => urldecode($username),
    'input_pass' => urldecode($password),
    'submit_login' => 'Submit'
];

///form login
$post = $curl->post($url_login, $login);
//$get = $curl->get($urlget, ['type' => 'setup', 'display' => 'extensions']);


$url_add_extension = 'https://192.168.56.101/config.php?display=extensions&type=setup';
$form2 = [
    'display' => 'extensions',
    'type' => 'setup',
    'tech_hardware' => 'sip_generic',
    'Submit' => 'Submit'
];

$post2 = $curl->post($url_add_extension, $form2);
//$get = $curl->get($urlget, ['type' => 'setup', 'display' => 'extensions']);
//$get2 = $curl->get($url_add_extension);

$form3 = [
    //Hidden
    'display' => 'extensions',
    'type' => 'setup',
    'tech_hardware' => 'sip_generic',
    'action' => 'add',
    'extdisplay' => '',
    'tech_hardware' => 'sip_generic',
    //Add Extension
    'extension' => '2015',
    'name' => 'Curl',
    'cid_masquerade' => '',
    'sipname' => '2015',
    //Extension Options
    'outboundcid' => '',
    'ringtimer' => '0',
    'callwaiting' => 'enabled',
    'call_screen' => '0',
    'pinless' => 'disabled',
    'emergency_cid' => '',
    'tech'=>'sip',
    'hardware'=>'generic',
    //Assign DID\CID
    'newdid_name' => '',
    'newdid' => '',
    'newdidcid' => '',
    //Device Options
    'devinfo_secret_origional' => '',
    'devinfo_secret' => '2015curl',
    'devinfo_dtmfmode' => 'rfc2833',
    'devinfo_canreinvite' => 'no',
    'devinfo_context' => 'from-internal',
    'devinfo_host' => 'dynamic',
    'devinfo_type' => 'friend',
    'devinfo_nat' => 'yes',
    'devinfo_port' => '5060',
    'devinfo_qualify' => 'yes',
    'devinfo_callgroup' => '',
    'devinfo_pickupgroup' => '',
    'devinfo_disallow' => '',
    'devinfo_allow' => '',
    'devinfo_dial' => '',
    'devinfo_accountcode' => '',
    'devinfo_mailbox' => '',
    'devinfo_vmexten' => '',
    'devinfo_deny' => '0.0.0.0/0.0.0.0',
    'devinfo_permit' => '0.0.0.0/0.0.0.0',
    //Dictation Services
//    'dictenabled' => 'disabled',
//    'dictformat' => 'ogg',
//    'dictemail' => '',
    //Language
//    'langcode' => '',
    //Recording Options
    'record_in' => 'Never',
    'record_out' => 'Never',
    //Voicemail & Directory
    'vm' => 'disabled',
//    'vmpwd' => '',
//    'email' => '',
//    'pager' => '',
//    'attach' => 'attach=no',
//    'saycid' => 'saycid=no',
//    'envelope' => 'envelope=no',
//    'delete' => 'delete=no',
//    'imapuser' => '',
//    'imappassword' => '',
//    'options' => '',
//    'vmcontext' => 'default',
    //VmX Locater
    'vmx_state' => '',
//    'vmx_unavail_enabled' => '',
//    'vmx_busy_enabled' => '',
//    'vmx_option_0_system_default' => 'checked',
//    'vmx_option_0_number' => '',
//    'vmx_option_1_number' => '',
//    'vmx_option_2_number' => '',
//    'vmx_play_instructions' => 'checked',
    //Submit
    'Submit' => 'Submit',
];




$post3 = $curl->post($url_add_extension, $form3);
//$get3 = $curl->get($url_add_extension);
//$curl->close();
//ob_start();


echo "<pre>";
//echo getcwd();
//var_dump($curl->error);
var_dump($curl);
//if (!eregi('<body onload=set_focus()', $curl->response)){
//    die("[+] Exploitation Failed\n");
//}
//var_dump($curl->request_headers);
//var_dump($curl->response_headers);
//if ($curl->error) {
//    echo "Error with Curl Code : " . $curl->error_code . "<br>";
//    ;
//} else {
//    echo $curl->response . "<br>";
//}
echo "</pre>";
