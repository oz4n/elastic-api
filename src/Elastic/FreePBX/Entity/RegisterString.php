<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of RegisterString
 *
 * @author nunenuh
 */
class RegisterString {

    var $username;
    var $password;
    var $host;

    public function getString() {
        $str = $this->username . ":"
                . $this->password . "@"
                . $this->host;
        return $str;
    }

    public function getObject($str) {
        $spl = preg_split("/:|@/", $str);

        isset($spl[0]) ? $this->username = $spl[0] :
                        $this->username = "";
        isset($spl[1]) ? $this->password = $spl[1] :
                        $this->password = "";
        isset($spl[2]) ? $this->host = $spl[2] :
                        $this->host = "";
    }

}
