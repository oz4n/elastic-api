<?php

namespace Elastic\FreePBX\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DevInfo
 *
 * @author nunenuh
 */
class DevInfo {

    var $secretOriginal = '';
    var $secret= '' ;
    var $DTMFMode = 'rfc2833';
    var $canReInvite = 'no';
    var $context = 'from-internal';
    var $host = 'dynamic';
    var $type = 'friend';
    var $nat = 'yes';
    var $port = '5060';
    var $qualify = 'yes';
    var $callGroup = '';
    var $pickupGroup = '';
    var $disallow = '';
    var $allow = '';
    var $dial= '';
    var $accountCode = '';
    var $mailbox= '';
    var $vmexten= '';
    var $deny = '0.0.0.0/0.0.0.0';
    var $permit = '0.0.0.0/0.0.0.0';

    public function getArrayPost() {
        $arrayPost = [
            'devinfo_secret_original' => $this->secretOriginal,
            'devinfo_secret' => $this->secret,
            'devinfo_dtmfmode' => $this->DTMFMode,
            'devinfo_canreinvite' => $this->canReInvite,
            'devinfo_context' => $this->context,
            'devinfo_host' => $this->host,
            'devinfo_type' => $this->type,
            'devinfo_nat' => $this->nat,
            'devinfo_port' => $this->port,
            'devinfo_qualify' => $this->qualify,
            'devinfo_callgroup' => $this->callGroup,
            'devinfo_pickupgroup' => $this->pickupGroup,
            'devinfo_disallow' => $this->disallow,
            'devinfo_allow' => $this->allow,
            'devinfo_dial' => $this->dial,
            'devinfo_accountcode' => $this->accountCode,
            'devinfo_mailbox' => $this->mailbox,
            'devinfo_vmexten' => $this->vmexten,
            'devinfo_deny' => $this->deny,
            'devinfo_permit' => $this->permit,
        ];

        return $arrayPost;
    }

}
