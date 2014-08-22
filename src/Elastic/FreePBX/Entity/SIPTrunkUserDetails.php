<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of SIPTrunkUserDetails
 *
 * @author nunenuh
 */
class SIPTrunkUserDetails {

    var $secret = "***password***";
    var $type = "user";
    var $context = "from-trunk";

    public function getString() {
        $str = "secret=" . $this->secret
                . "type=" . $this->type
                . "context=" . $this->context;

        return $str;
    }

}
