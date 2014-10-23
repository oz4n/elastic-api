<?php

namespace Elastic\FreePBX\Parser;

use Elastic\FreePBX\Manager\Entity\Inbound;
use Sunra\PhpSimple\HtmlDomParser;
use ArrayObject;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserInbound
 *
 * @author fauzan
 */
class ParserInbound
{

    public static function getListObject($html)
    {
        $ao = new ArrayObject();
        $dom = HtmlDomParser::str_get_html($html);
        $e = $dom->find('div[class=rnav] ul');
        foreach ($e as $ul) { //loop ul to extract li
            foreach ($ul->find('li') as $v2) { //loop li to extract plain text
                $val1 = $v2->innertext;
                $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
                if (preg_match_all("/$regexp/siU", $val1, $matches, PREG_SET_ORDER)) {
                    if (($matches[0][3] !== "Add Incoming Route" && $matches[0][3] !== "All DIDs (toggle sort)") && ($matches[0][3] !== "User DIDs" && $matches[0][3] !== "General DIDs") && $matches[0][3] !== "Unused DIDs") {                       
                        $id = explode("=", $matches[0][2]);
                        $o = new Inbound();
                        $o->extdisplay = $id[4];
                        $o->description = $v2->plaintext;
                        $ao->append($o);
                    }
                }
            }
        }
        return $ao;
    }

    public static function getInbound($html)
    {
        $dom = HtmlDomParser::str_get_html($html);
        $name = $dom->find('input[name=description]');
        $ext = $dom->find('input[name=extdisplay]');
        $ocid = $dom->find('input[name=extension]');
        $trunk = $dom->find('select[name=Extensions0]');
        $o = new Inbound();
        $o->description = $name[0]->attr['value'];
        $o->extdisplay = $ext[0]->attr['value'];
        $o->didnumber = $ocid[0]->attr['value'];
        foreach ($trunk as $value) {
            $o->destination = $value->find('option[selected]', 0)->value;
        }

        return $o;
    }

    public static function getExtension($html)
    {
        $dom = HtmlDomParser::str_get_html($html);

        $trunk = $dom->find('select[name=Extensions0]');
        $o = new Inbound();
        $data = [];
        foreach ($trunk as $value) {
            foreach ($value->find('option') as $v) {
                if ($v->value !== '' && $v->plaintext !== '') {
                    $data[] = (object) [
                                'value' => $v->value,
                                'text' => $v->plaintext
                    ];
                }
            }
        }
        $o->destination = $data;
        return $o;
    }

}
