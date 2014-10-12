<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of PeerDetails
 *
 * @author nunenuh
 */
class SIPTrunkPeerDetails {

    var $host;
    var $fromDomain;
    var $fromUser;
    var $username;
    var $authUser;
    var $secret;
    var $context = 'from-trunk';
    var $type = 'peer';
    var $nat = 'yes';
    var $canReInvite = 'no';
    var $insecure = 'port,invite';
    var $qualify = 'yes';

    public function getString() {
        $str = ""
                . "fromuser=" . $this->fromUser . "\n"
                . "username=" . $this->username . "\n"
                . "authuser=" . $this->authUser . "\n"
                . "secret=" . $this->secret . "\n"
                . "host=" . $this->host . "\n"
                . "fromdomain=" . $this->fromDomain . "\n"
                . "context=" . $this->context . "\n"
                . "type=" . $this->type . "\n"
                . "nat=" . $this->nat . "\n"
                . "canreinvite=" . $this->canReInvite . "\n"
                . "insecure=" . $this->insecure . "\n"
                . "qualify=" . $this->qualify . "\n";

        return $str;
    }

    public function getObject($str) {
        $spl = preg_split("/[\n]+/", $str);
        foreach ($spl as $val) {
            $sl = preg_split("/=|[\s]/", $val);
            switch ($sl[0]) {
                case "fromuser":
                    isset($sl[1]) ? $this->fromUser = $sl[1] :
                                    $this->fromUser = '';
                    break;
                case "username":
                    isset($sl[1]) ? $this->username = $sl[1] :
                                    $this->username = '';
                    break;
                case "authuser":
                    isset($sl[1]) ? $this->authUser = $sl[1] :
                                    $this->authUser = '';
                    break;
                case "secret":
                    isset($sl[1]) ? $this->secret = $sl[1] :
                                    $this->secret = '';
                    break;
                case "host":
                    isset($sl[1]) ? $this->host = $sl[1] :
                                    $this->host = '';
                    break;
                case "fromdomain":
                    isset($sl[1]) ? $this->fromDomain = $sl[1] :
                                    $this->fromDomain = '';
                    break;
                case "context":
                    isset($sl[1]) ? $this->context = $sl[1] :
                                    $this->context = 'from-trunk';
                    break;
                case "type":
                    isset($sl[1]) ? $this->type = $sl[1] :
                                    $this->type = 'peer';
                    break;
                case "nat":
                    isset($sl[1]) ? $this->nat = $sl[1] :
                                    $this->nat = 'yes';
                    break;
                case "canreinvite":
                    isset($sl[1]) ? $this->canReInvite = $sl[1] :
                                    $this->canReInvite = 'no';
                    break;
                case "insecure":
                    isset($sl[1]) ? $this->insecure = $sl[1] :
                                    $this->insecure = 'port, invite';
                    break;
                case "qualify":
                    isset($sl[1]) ? $this->qualify = $sl[1] :
                                    $this->qualify = 'yes';
                    break;

                default:
                    break;
            }
        }
        return $this;
    }

}
