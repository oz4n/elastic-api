<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of DictationServices
 *
 * @author nunenuh
 */
class DictationServices {

    var $enabled = 'disabled';
    var $format = 'ogg';
    var $email = '';

    public function getArrayPost() {
        $arrayPost = [
            'dictenabled' => $this->enabled,
            'dictformat' => $this->format,
            'dictemail' => $this->email,
        ];

        return $arrayPost;
    }

}
