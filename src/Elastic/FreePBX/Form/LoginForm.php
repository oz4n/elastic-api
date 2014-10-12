<?php

namespace Elastic\FreePBX\Form;

use Elastic\FreePBX\Entity\Login;

/**
 * Description of LoginForm
 *
 * @author nunenuh
 */
class LoginForm {

    /**
     *
     * @var Login
     */
    private $entity;

    /**
     * 
     * @return LoginEntity
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * 
     * @param LoginEntity $entity
     */
    public function setEntity($entity) {
        $this->entity = $entity;
    }

    public function getPostData() {
        $login = [
            'input_user' => urldecode($this->entity->username),
            'input_pass' => urldecode($this->entity->password),
            'submit_login' => $this->entity->submit,
        ];

        return $login;
    }

    public function getURL() {
        $URL = "https://" . $this->entity->ipaddr . "/index.php";
        return $URL;
    }

}
