<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of VoiceMailDirectory
 *
 * @author nunenuh
 */
class VoiceMailDirectory {

    var $vm = 'disabled';
    var $vmpwd = '';
    var $email = '';
    var $pager = '';
    var $imapuser = '';

    public function getArrayPost() {
        $arrayPost = [
            'vm' => $this->vm,
            'vmpwd' => $this->vmpwd,
            'email' => $this->email,
            'pager' => $this->pager,
            'imapuser' => $this->imapuser,
        ];

        return $arrayPost;
    }

}
