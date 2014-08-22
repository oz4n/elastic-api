<?php

namespace Elastic\FreePBX\Entity;

/**
 * Description of AssignDIDAndCID
 *
 * @author nunenuh
 */
class AssignDIDAndCID {

    var $DID = '';
    var $DIDName = '';
    var $DIDCID = '';

    public function getArrayPost() {
        $arrayPost = [
            'newdid_name' => $this->DIDName,
            'newdid' => $this->DID,
            'newdidcid' => $this->DIDCID,
        ];

        return $arrayPost;
    }

}
