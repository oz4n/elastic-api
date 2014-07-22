<?php

namespace Elastic\FreePBX\Core;

use Elastic\FreePBX\Utils\UserAgents;

/**
 * Description of CurlInit
 *
 * @author nunenuh
 */
class Core {

    private $curl;

    function __construct() {
        $curl = new Curl();
        $this->curl = $this->initConfig($curl);
    }

    private function initConfig($curl) {
        $cookiefile = tempnam("/tmp", "cookies");
        $curl->setUserAgent(UserAgents::Mozilla);
        $curl->setOpt(CURLOPT_HEADER, 0);
        $curl->setopt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setopt(CURLOPT_FOLLOWLOCATION, TRUE);
        $curl->setopt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->setopt(CURLOPT_SSL_VERIFYHOST, FALSE);
        $curl->setopt(CURLOPT_COOKIEFILE, $cookiefile);
        $curl->setopt(CURLOPT_COOKIEJAR, $cookiefile);
        return $curl;
    }

}
