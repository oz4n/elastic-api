<?php

namespace Elastic\FreePBX\Manager;

use Elastic\FreePBX\Core\CurlCore;
use Elastic\FreePBX\Form\LoginForm;
use Elastic\FreePBX\Manager\Entity\Inbound;
use Elastic\FreePBX\Entity\InboundRoute;
use Elastic\FreePBX\Form\InboundForm;
use Elastic\FreePBX\Parser\ParserInbound;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InboundManager
 *
 * @author fauzan
 */
class InboundManager
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

    public function save(Inbound $route)
    {
        $r = new InboundRoute();
        $r->action = 'addIncoming';
        $r->description = $route->description;
        $r->didnumber = $route->didnumber;
        $r->destination = $route->destination;

        $f = new InboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);

        $this->initLogin();

        $d = $f->getData();
        $u = $f->getAddUrl();
        return $this->curl->post($u, $d);
    }

    public function update(Inbound $route)
    {
        $r = new InboundRoute();
        $r->action = 'edtIncoming';
        $r->description = $route->description;
        $r->didnumber = $route->didnumber;
        $r->destination = $route->destination;
        $r->extdisplay = $route->extdisplay;

        $f = new InboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);

        $this->initLogin();

        $d = $f->getData();
        $u = $f->getUpdateUrl();
        return $this->curl->post($u, $d);
    }

    public function delete($id)
    {
        $r = new InboundRoute();
        $r->extdisplay = $id;
        $r->action = "delIncoming";
        $f = new InboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();
        $d = $f->getData();
        $u = $f->getDelUrl();
        return $this->curl->get($u, $d);
    }

    public function find($id)
    {
        $r = new InboundRoute();
        $r->action = 'edtIncoming';
        $r->extdisplay = $id;
        
        $f = new InboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);

        $this->initLogin();
        
        $u = $f->getListUrl();
        $this->curl->get($u);
        return ParserInbound::getInbound($this->curl->response);
    }

    public function listAll()
    {
        $r = new InboundRoute();
        $f = new InboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();

        $u = $f->getListAllUrl();
        $this->curl->get($u);
        return ParserInbound::getListObject($this->curl->response);
    }

    public function findAllExtension()
    {
        $r = new InboundRoute();
        $f = new InboundForm();
        $f->setEntity($r);
        $f->setLogin($this->login);
        $this->initLogin();

        $u = $f->getListAllUrl();
        $this->curl->get($u);
        return ParserInbound::getExtension($this->curl->response);
    }

}
