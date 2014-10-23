<?php

namespace Elastic\FreePBX\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InboundRoute
 *
 * @author fauzan
 */
class InboundRoute
{

    var $extdisplay;
    var $didnumber;
    var $destination;
    var $display = 'did';
    var $description;

    /**
     * value is addIncoming, delIncoming or edtIncoming
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

    public function getArrayPost()
    {
        $data = [
            'display' => $this->display,
            'action' => $this->action,
            'extdisplay' => $this->extdisplay,
            'didfilter' => '',
            'rnavsort' => 'description',
            'description' => $this->description,
            'extension' => $this->didnumber,
            'cidnum' => '',
            'alertinfo' => '',
            'grppre' => '',
            'mohclass' => 'default',
            'delay_answer',
            'privacyman' => 0,
            'pmmaxretries' => 3,
            'pmminlength' => 10,
            'cidlookup_id' => 0,
            'faxenabled' => 'false',
            'faxdetection' => 'dahdi',
            'faxdetectionwait' => 4,
            'gotoFAX' => '',
            'ExtensionsFAX' => 'from-did-direct,20201,1',
            'IVRFAX' => 'ivr-3,s,1',
            'Phonebook_DirectoryFAX' => 'app-pbdirectory,pbdirectory,1',
            'Terminate_CallFAX' => 'app-blackhole,hangup,1',
            'TrunksFAX' => 'ext-trunk,2,1',
            'language' => '',
            'goto0' => 'Extensions',
            'Extensions0' => $this->destination,
            'IVR0' => 'ivr-3,s,1',
            'Phonebook_Directory0' => 'app-pbdirectory,pbdirectory,1',
            'Terminate_Call0' => 'app-blackhole,hangup,1',
            'Trunks0' => 'ext-trunk,2,1',
            'Submit' => 'Submit'
        ];
        return $data;
    }

}
