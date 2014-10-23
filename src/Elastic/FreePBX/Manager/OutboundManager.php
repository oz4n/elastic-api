<?php

namespace Elastic\FreePBX\Manager;

use Elastic\FreePBX\Core\CurlCore;
use Elastic\FreePBX\Form\LoginForm;
use Elastic\FreePBX\Manager\Entity\Outbound;
use Elastic\FreePBX\Entity\OutboundRoute;
use Elastic\FreePBX\Form\OutboundForm;
use Elastic\FreePBX\Parser\ParserOutbound;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OutboundManager
 *
 * @author fauzan
 */
class OutboundManager
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

    public function save(Outbound $route)
    {
        $r = new OutboundRoute();
        $r->routename = $route->routename;
        $r->action = "addroute";
        $r->outcid = $route->outcid;
        $r->trunkpriority = $route->trunkpriority;

        $f = new OutboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();
        $d = $f->getData();
        $u = $f->getAddUrl();
        return $this->curl->post($u, $d);
    }

    public function update(Outbound $route)
    {
        $r = new OutboundRoute();
        $r->routename = $route->routename;
        $r->extdisplay = $route->extdisplay;
        $r->action = "editroute";
        $r->outcid = $route->outcid;
        $r->trunkpriority = $route->trunkpriority;

        $f = new OutboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();
        $d = $f->getData();
        $u = $f->getUpdateUrl();
        return $this->curl->post($u, $d);
    }

    public function delete($id)
    {
        $r = new OutboundRoute();
        $r->extdisplay = $id;
        $r->action = "delroute";
        $f = new OutboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();
        $d = $f->getData();
        $u = $f->getDelUrl();
        return $this->curl->get($u, $d);
    }

    public function find($id)
    {
        $r = new OutboundRoute();
        $r->extdisplay = $id;
        $r->action = "editroute";
        $f = new OutboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();

        $u = $f->getListUrl();

        $this->curl->get($u);
        return ParserOutbound::getOutbound($this->curl->response);
    }

    public function findAllTrunkPriority()
    {
        $r = new OutboundRoute();
        $f = new OutboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();

        $u = $f->getListAllUrl();

        $this->curl->get($u);
        return ParserOutbound::getTrunkPriority($this->curl->response);
    }

    public function listAll()
    {
        $r = new OutboundRoute();
        $f = new OutboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();

        $u = $f->getListAllUrl();
        $this->curl->get($u);

        return ParserOutbound::getListObject($this->curl->response);
    }

}
