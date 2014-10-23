<?php

namespace Elastic\FreePBX\Manager\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Outbound
 *
 * @author fauzan
 */
class Outbound
{

    var $extdisplay;
    var $routename;
    var $outcid;
    var $trunkpriority;
    var $display = 'routing';
    

    public function getExtdisplay()
    {
        return $this->extdisplay;
    }

    public function getRoutename()
    {
        return $this->routename;
    }

    public function getOutcid()
    {
        return $this->outcid;
    }

    public function getTrunkpriority()
    {
        return $this->trunkpriority;
    }

  

    public function setExtdisplay($extdisplay)
    {
        $this->extdisplay = $extdisplay;
        return $this;
    }

    public function setRoutename($routename)
    {
        $this->routename = $routename;
        return $this;
    }

    public function setOutcid($outcid)
    {
        $this->outcid = $outcid;
        return $this;
    }

    public function setTrunkpriority($trunkpriority)
    {
        $this->trunkpriority = $trunkpriority;
        return $this;
    }

   
    

}
