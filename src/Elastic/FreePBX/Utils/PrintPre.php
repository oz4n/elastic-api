<?php

namespace Elastic\FreePBX\Utils;

/**
 * Description of PrintPre
 *
 * @author nunenuh
 */
class PrintPre {

    public static function out($var, $detail = false) {
        if (!$detail) {
            echo "<pre>";
            print_r($var);
            echo "</pre>";
        } else {
            echo "<pre>";
            var_dump($var);
            echo "</pre>";
        }
    }

}
