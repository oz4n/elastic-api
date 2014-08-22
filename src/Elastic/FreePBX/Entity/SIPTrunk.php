<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of TrunkEntity
 *
 * @author nunenuh
 */
class SIPTrunk {

    var $display = 'trunks';
    var $tech = 'sip';
    var $extDisplay;
    var $action;
    var $provider = '';
    var $npanxx = '';
    //general setting
    var $trunkName;
    var $outCID = 'SIP';
    var $keepCID = 'off';
    var $maxChans = '1';
    var $disableTrunk = '';
    var $failTrunk = '';
    var $failTrunkEnable = '1';
    //Dialed Number Manipulation Rules
    var $prependDigit = array(0 => '');
    var $patternPrefix = array(0 => '');
    var $patternPass = array(0 => '');
    var $autopop = '';
    var $dialoutPrefix = '';
    //outgoing setting
    var $channelId = '';

    /**
     * @var SIPTrunkPeerDetails
     */
    var $peerDetails;
    //incoming setting
    var $userContext = '';

    /**
     *
     * @var SIPTrunkUserDetails
     */
    var $userConfig = '';
    //registration
    var $register;

    /**
     *
     * @var RegisterString
     */
    private $registerString;

    public function getRegisterString() {
        return $this->registerString;
    }

    public function setRegisterString(RegisterString $registerString) {
        $this->registerString = $registerString;
    }

    public function getPeerDetails() {
        return $this->peerDetails;
    }

    public function setPeerDetails(SIPTrunkPeerDetails $peerDetails) {
        $this->peerDetails = $peerDetails;
    }

    public function getArrayPost() {
        $global = array(
            'display' => $this->display,
            'tech' => $this->tech,
            'extdisplay' => $this->extDisplay,
            'action' => $this->action,
            'provider' => $this->provider,
            'npanxx' => $this->npanxx,
        );

        $general = array(
            'trunk_name' => $this->trunkName,
            'outcid' => $this->outCID,
            'keepcid' => $this->keepCID,
            'maxchans' => $this->maxChans,
            'disabletrunk' => $this->disableTrunk,
            'failtrunk' => $this->failTrunk,
            'failtrunk_enable' => $this->failTrunkEnable,
        );

        $dialRules = array(
            'prepend_digit[0]' => '',
            'pattern_prefix[0]' => '',
            'pattern_pass[0]' => '',
            'autopop' => $this->autopop,
            'dialoutprefix' => $this->dialoutPrefix,
        );

        $outgoing = array(
            'channelid' => $this->channelId,
            'peerdetails' => $this->peerDetails->getString(),
        );

        $incoming = array(
            'usercontext' => $this->userContext,
            'userconfig' => '',
            'register' => $this->registerString->getString(),
        );


        $merge1 = array_merge($global, $general);
        $merge2 = array_merge($merge1, $dialRules, $outgoing, $incoming);
        $merge3 = array_merge($merge2, array('Submit' => 'Submit Changes'));

        return $merge3;
    }

}
