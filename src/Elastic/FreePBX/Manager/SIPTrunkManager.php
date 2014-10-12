<?php

namespace Elastic\FreePBX\Manager;

use Elastic\FreePBX\Manager\Entity\Trunk;
use Elastic\FreePBX\Core\CurlCore;
use Curl\Curl;
use Elastic\FreePBX\Entity\RegisterString;
use Elastic\FreePBX\Entity\SIPTrunk;
use Elastic\FreePBX\Entity\SIPTrunkPeerDetails;
use Elastic\FreePBX\Entity\SIPTrunkUserDetails;
use Elastic\FreePBX\Form\SIPTrunkForm;
use Elastic\FreePBX\Entity\Login;
use Elastic\FreePBX\Form\LoginForm;

/**
 * Description of TrunkManager
 *
 * @author nunenuh
 */
class SIPTrunkManager
{

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

    function __construct()
    {
        $this->curlCore = new CurlCore();
        $this->curl = $this->curlCore->getCurl();
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    private function initLogin()
    {
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

    public function listAll()
    {
        
    }

    public function find($id)
    {
        
    }

    public function save(Trunk $trunk)
    {
        $t = $trunk;

        $st = new SIPTrunk();
        $st->action = "addtrunk";
        $st->trunkName = $t->trunkName;
        $st->outCID = $t->outCID;
        $st->maxChans = $t->maxChans;
        $st->channelId = $t->trunkName;
        $st->userContext = $t->outCID;

        $pd = new SIPTrunkPeerDetails();
        $pd->fromUser = $t->peerUsername;
        $pd->username = $t->peerUsername;
        $pd->authUser = $t->peerUsername;
        $pd->secret = $t->peerPassword;
        $pd->host = $t->peerHost;
        $pd->fromDomain = $t->peerHost;
        $st->setPeerDetails($pd);

        $rs = new RegisterString();
        $rs->username = $t->peerUsername;
        $rs->password = $t->peerPassword;
        $rs->host = $t->trunkName;
        $st->setRegisterString($rs);

        $stf = new SIPTrunkForm();
        $stf->setLogin($this->login);
        $stf->setEntity($st);

        //do login to elastic
        $this->initLogin();

        //first execution for choose sip trunk
        $uget = $stf->getSelectURL();
        $this->curl->get($uget);

        //first execution for choose sip trunk
        $dadd = $stf->getData();
        $uadd = $stf->getAddURL();
        $this->curl->post($uadd, $dadd);

        return $this->curl;
    }

    public function update(Trunk $trunk)
    {
        $t = $trunk;

        $st = new SIPTrunk();
        $st->action = "edittrunk";
        $st->extDisplay = $t->extdisplay;
        $st->trunkName = $t->trunkName;
        $st->outCID = $t->outCID;
        $st->maxChans = $t->maxChans;
        $st->channelId = $t->trunkName;
        $st->userContext = $t->outCID;

        $pd = new SIPTrunkPeerDetails();
        $pd->fromUser = $t->peerUsername;
        $pd->username = $t->peerUsername;
        $pd->authUser = $t->peerUsername;
        $pd->secret = $t->peerPassword;
        $pd->host = $t->peerHost;
        $pd->fromDomain = $t->peerHost;
        $st->setPeerDetails($pd);

        $rs = new RegisterString();
        $rs->username = $t->peerUsername;
        $rs->password = $t->peerPassword;
        $rs->host = $t->trunkName;
        $st->setRegisterString($rs);

        $stf = new SIPTrunkForm();
        $stf->setLogin($this->login);
        $stf->setEntity($st);

        //do login to elastic
        $this->initLogin();

        //first execution for choose sip trunk
        $uget = $stf->getSelectURL();
        $this->curl->get($uget);

        //first execution for choose sip trunk
        $dadd = $stf->getData();
        $uadd = $stf->getUpdateURL();
        $this->curl->post($uadd, $dadd);
        return $this->curl;
    }

    public function delete($id)
    {
        $st = new SIPTrunk();
        $st->display = 'extensions';
        $st->action = "deltrunk";       
        $st->extDisplay = $id;
        
        $pd = new SIPTrunkPeerDetails();     
        $st->setPeerDetails($pd);

        $rs = new RegisterString();       
        $st->setRegisterString($rs);

        $stf = new SIPTrunkForm();        
        $stf->setEntity($st);
        $stf->setLogin($this->login);
        
        $this->initLogin();
        
        $dadd = $stf->getData();
        $uadd = $stf->getDelURL();
        $this->curl->get($uadd, $dadd);
    }

}
