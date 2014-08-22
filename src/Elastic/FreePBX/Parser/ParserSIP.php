<?php

namespace Elastic\FreePBX\Parser;

use Sunra\PhpSimple\HtmlDomParser;
use ArrayObject;
use Elastic\FreePBX\Manager\Entity\SIP;

/**
 * Description of ParserSIP
 *
 * @author nunenuh
 */
class ParserSIP {

    public static function getListObject($html) {
        $ao = new ArrayObject();

        $dom = HtmlDomParser::str_get_html($html);
        $e = $dom->find('div[class=rnav] ul'); //find list sip
        foreach ($e as $ul) { //loop ul to extract li
            foreach ($ul->find('li') as $v2) { //loop li to extract plain text
                $val = $v2->plaintext; //get plain text
                if ($val != "Add Extension") { //exclude Add Extension
                    $s1 = preg_replace("/&gt;|&lt;/", "", $val); //replace < or >
                    $s2 = preg_split("/[\s]+/", $s1); //replace white space

                    $sip = new SIP(); //create new object sip
                    $sip->name = $s2[0];
                    $sip->extension = $s2[1];
                    $sip->secret = NULL;
                    $sip->id = $s2[1];
                    $ao->append($sip); //append sip object to arrayObject
                }
            }
        }

        return $ao;
    }

    public static function getSIP($html) {
        $dom = HtmlDomParser::str_get_html($html);

        $nm = $dom->find('input[name=name]');
        $spname = $dom->find('input[name=sipname]');
        $sec = $dom->find('input[name=devinfo_secret]');

        $sip = new SIP();

        if (isset($nm[0]->attr['value'])) {
            $sip->name = $nm[0]->attr['value'];
        }
        if (isset($spname[0]->attr['value'])) {
            $sip->id = $spname[0]->attr['value'];
            $sip->extension = $spname[0]->attr['value'];
        }
        if (isset($sec[0]->attr['value'])) {
            $sip->secret = $sec[0]->attr['value'];
        }


        return $sip;
    }

}
