<?php

namespace Elastic\FreePBX\Parser;

use Elastic\FreePBX\Manager\Entity\Outbound;
use Sunra\PhpSimple\HtmlDomParser;
use ArrayObject;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserOutbound
 *
 * @author fauzan
 */
class ParserOutbound
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
                    if ($matches[0][3] != "Add Route") {
                        $o = new Outbound();
                        $o->extdisplay = str_replace('amp;extdisplay=', '', str_replace('config.php?display=routing&', '', $matches[0][2]));
                        $o->routename = $v2->plaintext;
                        $ao->append($o);
                    }
                }
            }
        }
        return $ao;
    }

    public static function getOutbound($html)
    {
        $dom = HtmlDomParser::str_get_html($html);
        $name = $dom->find('input[name=routename]');
        $ext = $dom->find('input[name=extdisplay]');
        $ocid = $dom->find('input[name=outcid]');
        $trunk = $dom->find('select[id=trunkpri0]');
        $o = new Outbound();
        $o->routename = $name[0]->attr['value'];
        $o->extdisplay = $ext[0]->attr['value'];
        $o->outcid = $ocid[0]->attr['value'];
        foreach ($trunk as $value) {
            $o->trunkpriority = $value->find('option[selected]', 0)->value;
        }

        return $o;
    }

    public static function getTrunkPriority($html)
    {
        $dom = HtmlDomParser::str_get_html($html);

        $trunk = $dom->find('select[id=trunkpri0]');
        $o = new Outbound();
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
        $o->trunkpriority = $data;
        return $o;
    }

}
