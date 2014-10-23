<?php

namespace Elastic\FreePBX\Parser;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Sunra\PhpSimple\HtmlDomParser;
use ArrayObject;
use Elastic\FreePBX\Manager\Entity\Trunk;
use Elastic\FreePBX\Form\SIPTrunkForm;
use Elastic\FreePBX\Entity\SIPTrunk;
use Elastic\FreePBX\Form\LoginForm;
use Curl\Curl;
use Elastic\FreePBX\Core\CurlCore;

/**
 * Description of ParserSIPTrunk
 *
 * @author fauzan
 */
class ParserSIPTrunk
{

    /**
     *
     * @var \Curl\Curl 
     */
    private $curl;

    function __construct()
    {
        $curlCore = new CurlCore();
        $this->curl = $curlCore->getCurl();
    }

    private function initLogin($login)
    {
        if ($login != null) {
            $lf = new LoginForm();
            $lf->setEntity($login);
            $data = $lf->getPostData();
            $url = $lf->getURL();
            $this->curl->get($url);
            $this->curl->post($url, $data);
        } else {
            throw new Exception('Login cannot be null!');
        }
    }

    public static function getListObject($html, $login)
    {
        $ao = new ArrayObject();

        $dom = HtmlDomParser::str_get_html($html);
        $e = $dom->find('div[class=rnav] ul'); //find list sip
        foreach ($e as $ul) { //loop ul to extract li
            foreach ($ul->find('li') as $v2) { //loop li to extract plain text
                $val1 = $v2->innertext; //get plain text
                $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
                if (preg_match_all("/$regexp/siU", $val1, $matches, PREG_SET_ORDER)) {
                    if ($matches[0][3] != "Add Trunk") {
                        $id1 = str_replace('config.php?display=trunks&', '', $matches[0][2]);
                        $id2 = str_replace('amp;extdisplay=', '', $id1);
                        $trunk = new Trunk(); //create new object sip
                        $self = new ParserSIPTrunk();
                        $trunk->extdisplay = $id2;
                        $trunk->trunkName = $self->getTrunkName($login, $id2);
                        $trunk->outCID = $self->getOutCID($login, $id2);
                        $trunk->peerHost = $self->getPeerHost($login, $id2);
                        $trunk->peerPassword = $self->getPeerPassword($login, $id2);
                        $trunk->peerUsername = $self->getPeerUsername($login, $id2);
                        $ao->append($trunk); //append sip object to arrayObject
                    }
                }
            }
        }
        return $ao;
    }

    public static function getSIPTrunk($html)
    {
        
    }

    private function getOutCID($login, $id)
    {
        $st = new SIPTrunk();
        $st->extDisplay = $id;
        $stf = new SIPTrunkForm();
        $stf->setEntity($st);
        $stf->setLogin($login);

        $this->initLogin($login);

        $this->curl->get($stf->getListURL());
        $dom = HtmlDomParser::str_get_html($this->curl->response);
        $nm = $dom->find('input[name=outcid]');
        if (isset($nm[0]->attr['value'])) {
            return $nm[0]->attr['value'];
        }
    }

    private function getTrunkName($login, $id)
    {
        $st = new SIPTrunk();
        $st->extDisplay = $id;
        $stf = new SIPTrunkForm();
        $stf->setEntity($st);
        $stf->setLogin($login);

        $this->initLogin($login);

        $this->curl->get($stf->getListURL());
        $dom = HtmlDomParser::str_get_html($this->curl->response);
        $nm = $dom->find('input[name=trunk_name]');
        if (isset($nm[0]->attr['value'])) {
            return $nm[0]->attr['value'];
        }
    }

    private function getPeerUsername($login, $id)
    {
        $str = $this->getPeerDetails($login, $id);
        return $str['username'];
    }

    private function getPeerPassword($login, $id)
    {
        $str = $this->getPeerDetails($login, $id);
        return $str['secret'];
    }

    public function getPeerHost($login, $id)
    {
        $str = $this->getPeerDetails($login, $id);
        return $str['host'];
    }

    private function getPeerDetails($login, $id)
    {
        $st = new SIPTrunk();
        $st->extDisplay = $id;
        $stf = new SIPTrunkForm();
        $stf->setEntity($st);
        $stf->setLogin($login);

        $this->initLogin($login);

        $this->curl->get($stf->getListURL());
        $dom = HtmlDomParser::str_get_html($this->curl->response);
        $text = "";
        foreach ($dom->find('textarea[name=peerdetails]') as $value) {
            $text .= $value->innertext;
        }
        preg_match_all('/(?P<name>\w+)=(?P<value>[\w\.*\,*]+)/', $text, $matches);

        $ds = [];
        foreach ($matches['value'] as $k => $v) {
            $ds["value" . $k] = $v;
        }
        $d = array_combine(array(
            'fromuser',
            'username',
            'authuser',
            'secret',
            'host',
            'fromdomain',
            'context',
            'type',
            'nat',
            'canreinvite',
            'insecure',
            'qualify',
                ), $ds);
        return $d;
    }

}
