<?php

namespace Elastic\FreePBX\Entity;

use Elastic\FreePBX\Entity\Login;
use Elastic\FreePBX\Entity\AssignDIDAndCID;
use Elastic\FreePBX\Entity\DevInfo;
use Elastic\FreePBX\Entity\DictationServices;

/**
 * Description of Ext
 *
 * @author nunenuh
 */
class SIPExtension {

    var $action = '';
    var $display = 'extensions';
    var $type = 'setup';
    var $tech_hardware = 'sip_generic';
    var $tech = 'sip';
    var $hardware = 'generic';
    var $name = '';
    var $extension = '';
    var $SIPName = '';
    var $extDisplay = '';
    var $CIDMasquerade = '';
    var $outboundCID = '';
    var $ringTimer = '0';
    var $callWaiting = 'disabled';
    var $callScreen = '0';
    var $pinless = 'disabled';
    var $emergencyCID = '';
    var $langCode = '';
    var $recordIn = 'Never';
    var $recordOut = 'Never';

    /**
     *
     * @var Login
     */
    var $login;

    /**
     *
     * @var DevInfo
     */
    var $devInfo = NULL;

    /**
     *
     * @var AssignDIDAndCID
     */
    var $assignDidAndCid = NULL;

    /**
     *
     * @var DictationServices
     */
    var $dictationService = NULL;

    public function getArrayPostSIPSelect() {
        $arrayPost = [
            'display' => $this->display,
            'type' => $this->type,
            'tech_hardware' => $this->tech_hardware,
            'submit' => 'submit',
        ];

        return $arrayPost;
    }

    public function getArrayPost() {
        $ext = [
            'action' => $this->action,
            'display' => $this->display,
            'type' => $this->type,
            'tech_hardware' => $this->tech_hardware,
            'extdisplay' => $this->extDisplay,
            'tech' => $this->tech,
            'hardware' => $this->hardware,
            //add extension
            'extension' => $this->extension,
            'name' => $this->name,
            'cid_masquerade' => $this->CIDMasquerade,
            'sipname' => $this->SIPName,
            //Extension Option
            'outboundcid' => $this->outboundCID,
            'ringtimer' => $this->ringTimer,
            'callwaiting' => $this->callWaiting,
            'call_screen' => $this->callScreen,
            'pinless' => $this->pinless,
            'emergency_cid' => $this->emergencyCID,
            'langcode' => $this->langCode,
            //Recording Option
            'record_in' => $this->recordIn,
            'record_out' => $this->recordOut,
            'submit' => 'submit',
        ];


        if ($this->assignDidAndCid != NULL) {
            $ext = array_merge($ext, $this->assignDidAndCid->getArrayPost());
        }

        if ($this->devInfo != NULL) {
            $ext = array_merge($ext, $this->devInfo->getArrayPost());
        }

        if ($this->dictationService != NULL) {
            $ext = array_merge($ext, $this->dictationService->getArrayPost());
        }

        return $ext;
    }

    /**
     * 
     * @return Login
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * 
     * @param \Elastic\FreePBX\Entity\Login $login
     */
    public function setLogin(Login $login) {
        $this->login = $login;
    }

    /**
     * 
     * @return AssignDIDAndCID
     */
    public function getAssignDidAndCid() {
        return $this->assignDidAndCid;
    }

    /**
     * 
     * @return DictationServices
     */
    public function getDictationService() {
        return $this->dictationService;
    }

    /**
     * 
     * @return DevInfo
     */
    public function getDevInfo() {
        return $this->devInfo;
    }

    /**
     * 
     * @param \Elastic\FreePBX\Entity\AssignDIDAndCID $assignDidAndCid
     */
    public function setAssignDidAndCid(AssignDIDAndCID $assignDidAndCid) {
        $this->assignDidAndCid = $assignDidAndCid;
    }

    /**
     * 
     * @param \Elastic\FreePBX\Entity\DictationServices $dictationService
     */
    public function setDictationService(DictationServices $dictationService) {
        $this->dictationService = $dictationService;
    }

    /**
     * 
     * @param \Elastic\FreePBX\Entity\DevInfo $devInfo
     */
    public function setDevInfo(DevInfo $devInfo) {
        $this->devInfo = $devInfo;
    }

}
