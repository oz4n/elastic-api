<?php

namespace Elastic\FreePBX\Manager\Entity;

/**
 * Description of Trunk
 *
 * @author nunenuh
 */
class Trunk {

    var $trunkName;
    var $outCID;
    var $maxChans = '1';
    var $peerUsername;
    var $peerPassword;
    var $peerHost;
    var $extdisplay;
    
    public function getTrunkName() {
        return $this->trunkName;
    }

    public function getOutCID() {
        return $this->outCID;
    }

    public function getMaxChans() {
        return $this->maxChans;
    }

    public function getPeerUsername() {
        return $this->peerUsername;
    }

    public function getPeerPassword() {
        return $this->peerPassword;
    }

    public function getPeerHost() {
        return $this->peerHost;
    }

    public function setTrunkName($trunkName) {
        $this->trunkName = $trunkName;
    }

    public function setOutCID($outCID) {
        $this->outCID = $outCID;
    }

    public function setMaxChans($maxChans) {
        $this->maxChans = $maxChans;
    }

    public function setPeerUsername($peerUsername) {
        $this->peerUsername = $peerUsername;
    }

    public function setPeerPassword($peerPassword) {
        $this->peerPassword = $peerPassword;
    }

    public function setPeerHost($peerHost) {
        $this->peerHost = $peerHost;
    }

}
