<?php

namespace Elastic\FreePBX\Manager\Entity;

/**
 * Description of SIP
 *
 * @author nunenuh
 */
class SIP {

    var $id;
    var $extension;
    var $name;
    var $secret;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getName() {
        return $this->name;
    }

    public function getSecret() {
        return $this->secret;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSecret($secret) {
        $this->secret = $secret;
    }

}
