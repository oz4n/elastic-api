<?php

namespace Elastic\FreePBX\Form;

use Elastic\FreePBX\Entity\SIPExtension;
use Elastic\FreePBX\Entity\Login;

/**
 * Description of ExtensionForm
 *
 * @author nunenuh
 */
class SIPExtensionForm {

    /**
     *
     * @var SIPExtension
     */
    private $entity;

    /**
     *
     * @var Login
     */
    private $login;

    public function getEntity() {
        return $this->entity;
    }

    public function setEntity(SIPExtension $entity) {
        $this->entity = $entity;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin(Login $login) {
        $this->login = $login;
    }

    public function getSelectData() {
        return $this->entity->getArrayPostSIPSelect();
    }

    public function getSelectURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php";
        return $URL;
    }

    public function getSIPData() {
        return $this->entity->getArrayPost();
    }

    public function getAddURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php"
                . "?type=setup&display=extensions";
        return $URL;
    }

    public function getUpdateURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php"
                . "?type=setup"
                . "&display=extensions"
                . "&extdisplay=" . $this->entity->extDisplay;
        return $URL;
    }

    public function getDeleteURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php";
        return $URL;
    }

}
