<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of AuthEntity
 *
 * @author nunenuh
 */
class ElasticAuthEntity {

    var $host;
    var $username;
    var $password;

    public function getHost() {
        return $this->host;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

}
