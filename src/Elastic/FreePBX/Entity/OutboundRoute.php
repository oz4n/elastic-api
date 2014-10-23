<?php

namespace Elastic\FreePBX\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OutboundRoute
 *
 * @author fauzan
 */
class OutboundRoute
{

    var $extdisplay;
    var $routename;
    var $outcid;
    var $trunkpriority;
    var $display = 'routing';
    var $action;

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

    
    public function getArrayPost()
    {
        $data = [
            
            
            'display' => $this->display,
            'extdisplay' => $this->extdisplay,
            'action' => $this->action,
            'repotrunkdirection' => '',
            'repotrunkkey' => '',
            'reporoutedirection' => '',
            'reporoutekey' => '',
            'routename' => $this->routename,
            'outcid'=>  $this->outcid,
            'routepass' => '',
            'mohsilence' => 'default',
            'time_group_id' => '',
            'route_seq'=>'bottom',
            'pinsets' =>'',
            
            'npanxx' => '',
            
            'trunkpriority[0]' => $this->trunkpriority,
            
            

            'prepend_digit[1]' => '',
            'pattern_prefix[1]' => '',
            'pattern_pass[1]' => '0848XXXX.',
            'match_cid[1]' => '',
            'prepend_digit[2]' => '',
            'pattern_prefix[2]' => '',
            'pattern_pass[2]' => '62848XXXX.',
            'match_cid[2]' => '',
            'prepend_digit[3]' => '',
            'pattern_prefix[3]' => '',
            'pattern_pass[3]' => '901',
            'match_cid[3]' => '',
            'prepend_digit[4]' => '',
            'pattern_prefix[4]' => '',
            'pattern_pass[4]' => '902',
            'match_cid[4]' => '',
            'prepend_digit[5]' => '',
            'pattern_prefix[5]' => '',
            'pattern_pass[5]' => '903',
            'match_cid[5]' => '',
            'prepend_digit[6]' => '',
            'pattern_prefix[6]' => '',
            'pattern_pass[6]' => 'NXXXX',
            'match_cid[6]' => '',
            'prepend_digit[7]' => '',
            'pattern_prefix[7]' => '',
            'pattern_pass[7]' => 'ZXXXXX',
            'match_cid[7]' => '',
            
            'Submit' => 'Submit Changes'
        ];
        return $data;
    }

}
