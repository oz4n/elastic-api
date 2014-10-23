<?php

namespace Elastic\FreePBX\Form;

use Elastic\FreePBX\Entity\OutboundRoute;
use Elastic\FreePBX\Entity\Login;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OutboundForm
 *
 * @author fauzan
 */
class OutboundForm
{

    /**
     *
     * @var OutboundRoute
     */
    private $entity;

    /**
     *
     * @var Login
     */
    private $login;

    public function getEntity()
    {
        return $this->entity;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setEntity(OutboundRoute $entity)
    {
        $this->entity = $entity;
        return $this;
    }

    public function setLogin(Login $login)
    {
        $this->login = $login;
        return $this;
    }

    public function getData()
    {
        return $this->entity->getArrayPost();
    }

    public function getAddUrl()
    {
        $url = "https://" . $this->login->ipaddr . "/config.php";
        return $url;
    }

    public function getUpdateUrl()
    {
        $url = "https://" . $this->login->ipaddr . "/config.php";
        return $url;
    }

    public function getDelUrl()
    {
        $url = "https://" . $this->login->ipaddr . "/config.php?display=routing&extdisplay=" . $this->entity->extdisplay . "&action=delroute";
        return $url;
    }

    public function getListUrl()
    {
        $url = "https://" . $this->login->ipaddr . "/config.php?display=routing&extdisplay=" . $this->entity->extdisplay;
        return $url;
    }

    public function getListAllUrl()
    {
        $url = "https://" . $this->login->ipaddr . "/config.php?display=routing";
        return $url;
    }

}
