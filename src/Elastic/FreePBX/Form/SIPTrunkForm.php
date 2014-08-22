<?php

namespace Elastic\FreePBX\Form;

use Elastic\FreePBX\Entity\SIPTrunk;
use Elastic\FreePBX\Entity\Login;

/**
 * Description of SIPTrunkForm
 *
 * @author nunenuh
 */
class SIPTrunkForm {

    /**
     *
     * @var SIPTrunk
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

    public function getLogin() {
        return $this->login;
    }

    public function setEntity(SIPTrunk $entity) {
        $this->entity = $entity;
    }

    public function setLogin(Login $login) {
        $this->login = $login;
    }

    public function getData() {
        return $this->entity->getArrayPost();
    }

    public function getSelectURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php"
                . "?type=setup&display=trunks";
        return $URL;
    }

    public function getSIPSelectURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php"
                . "?display=trunks&tech=SIP";
        return $URL;
    }

    public function getAddOrUpdateURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php";
        return $URL;
    }

    public function getDelURL() {
        $URL = "https://" . $this->login->ipaddr . "/config.php"
                . "?display=trunks"
                . "&extdisplay=" . $this->entity->extDisplay
                . "&action=deltrunk";
        return $URL;
    }

}
