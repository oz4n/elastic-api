<?php
namespace Elastic\FreePBX\Parser;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Sunra\PhpSimple\HtmlDomParser;
use ArrayObject;
/**
 * Description of ParserSIPTrunk
 *
 * @author fauzan
 */
class ParserSIPTrunk
{

    public static function getListObject($html)
    {
        $ao = new ArrayObject();
        return HtmlDomParser::str_get_html($html);        
       
    }

    public static function getSIPTrunk($html)
    {
        
    }

}
