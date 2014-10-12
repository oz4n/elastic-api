<?php

namespace Elastic\FreePBX\Manager;

use Elastic\FreePBX\Manager\Entity\SIP;
use Elastic\FreePBX\Core\CurlCore;
use Elastic\FreePBX\Entity\SIPExtension;
use Elastic\FreePBX\Form\SIPExtensionForm;
use Elastic\FreePBX\Form\LoginForm;
use Elastic\FreePBX\Entity\DevInfo;
use Elastic\FreePBX\Entity\AssignDIDAndCID;
use Elastic\FreePBX\Parser\ParserSIP;

/**
 * Description of SIPManager
 *
 * @author nunenuh
 */
class SIPManager {

    /**
     *
     * @var CurlCore 
     */
    private $curlCore;

    /**
     *
     * @var \Curl\Curl 
     */
    private $curl;

    /**
     *
     * @var \Elastic\FreePBX\Entity\Login
     */
    private $login;

    function __construct() {
        $this->curlCore = new CurlCore();
        $this->curl = $this->curlCore->getCurl();
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    private function initLogin() {
        if ($this->login != null) {
            $lf = new LoginForm();
            $lf->setEntity($this->login);
            $data = $lf->getPostData();
            $url = $lf->getURL();
            $this->curl->get($url);
            $this->curl->post($url, $data);
        } else {
            throw new Exception('Login cannot be null!');
        }
    }

    public function listAll() {
        $sf = new SIPExtensionForm();
        $se = new SIPExtension();
        $sf->setEntity($se);
        $sf->setLogin($this->login);

        //do login to elastic
        $this->initLogin();
        //execute get for getting list extension
        $u2 = $sf->getAddURL();
        $this->curl->get($u2);

        $ao = ParserSIP::getListObject($this->curl->response);
        return $ao;
    }

    public function find($id) {
        //initialize sip extension core
        $se = new SIPExtension();
        $se->action = 'edit';
        $se->extDisplay = $id;

        //initialize sip extension form executor
        $sf = new SIPExtensionForm();
        $sf->setEntity($se);
        $sf->setLogin($this->login);

        //do login to elastic
        $this->initLogin();

        //execution for update sip extension
        $d1 = $sf->getSIPData();
        $u1 = $sf->getUpdateURL();
        $this->curl->get($u1, $d1);

        $sip = ParserSIP::getSIP($this->curl->response);
        return $sip;
    }

    public function save(SIP $sip) {

        //initialize sip extension core
        $se = new SIPExtension();
        $se->action = 'add';
        $se->extension = $sip->extension;
        $se->SIPName = $sip->extension;
        $se->name = $sip->name;

        $dv = new DevInfo();
        $dv->secret = $sip->secret;
        $se->setDevInfo($dv);

        $ad = new AssignDIDAndCID();
        $se->setAssignDidAndCid($ad);

        //initialize sip extension form executor
        $sf = new SIPExtensionForm();
        $sf->setEntity($se);
        $sf->setLogin($this->login);


        //do login to elastic
        $this->initLogin();

        //first execution for choose sip extension
        $d1 = $sf->getSelectData();
        $u1 = $sf->getSelectURL();
        $this->curl->post($u1, $d1);

        //second execution for adding new sip extension
        $d2 = $sf->getSIPData();
        $u2 = $sf->getAddURL();
        $this->curl->post($u2, $d2);
    }

    public function update(SIP $sip) {
        //initialize sip extension core
        $se = new SIPExtension();
        $se->action = 'edit';
        $se->extDisplay = $sip->id;
        $se->extension = $sip->extension;
        $se->SIPName = $sip->extension;
        $se->name = $sip->name;

        $dv = new DevInfo();
        $dv->secret = $sip->secret;
        $se->setDevInfo($dv);

        $ad = new AssignDIDAndCID();
        $se->setAssignDidAndCid($ad);

        //initialize sip extension form executor
        $sf = new SIPExtensionForm();
        $sf->setEntity($se);
        $sf->setLogin($this->login);


        //do login to elastic
        $this->initLogin();

        //execution for update sip extension
        $d1 = $sf->getSIPData();
        $u1 = $sf->getUpdateURL();
        $this->curl->post($u1, $d1);
    }

    public function delete($id) {
        $se = new SIPExtension();
        $se->type = 'setup';
        $se->action = 'del';
        $se->display = 'extensions';
        $se->extDisplay = $id;

        //initialize sip extension form executor
        $sf = new SIPExtensionForm();
        $sf->setEntity($se);
        $sf->setLogin($this->login);

        //do login to elastic
        $this->initLogin();

        //execution for update sip extension
        $d1 = $sf->getSIPData();
        $u1 = $sf->getDeleteURL();
        $this->curl->get($u1, $d1);
    }

}
