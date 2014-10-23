<?php

namespace Elastic\FreePBX\Manager\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inbound
 *
 * @author fauzan
 */
class Inbound
{

    var $extdisplay;
    var $didnumber;
    var $destination;
    var $display = 'did';
    var $description;

    /**
     * value is addIncoming or edtIncoming
     * @var type 
     */
    var $action;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function getExtdisplay()
    {
        return $this->extdisplay;
    }

    public function getDidnumber()
    {
        return $this->didnumber;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function setExtdisplay($extdisplay)
    {
        $this->extdisplay = $extdisplay;
        return $this;
    }

    public function setDidnumber($didnumber)
    {
        $this->didnumber = $didnumber;
        return $this;
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }

}
