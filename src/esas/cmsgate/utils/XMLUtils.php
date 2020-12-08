<?php


namespace esas\cmsgate\utils;


use DOMXPath;
use SimpleXMLElement;

class XMLUtils
{
    static function append(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

    /**
     * @param SimpleXMLElement $to
     * @param SimpleXMLElement[] $from
     * @param $path
     */
    static function inject(SimpleXMLElement $to, $from, $path) {
        $pathElements = explode("/", $path);
        $cursor = $to;
        foreach ($pathElements as $elemant) {
            if (!isset($cursor->$elemant)) {
                $cursor->addChild($elemant);
            }
            $cursor = $cursor->$elemant;
        }
        $toDom = dom_import_simplexml($to);
        $xp = new DOMXPath($toDom); //todo not working
        $dstNode = $xp->query($path)->item(0);
        foreach ($from as $element) {
            $fromDom = dom_import_simplexml($element);
            $node = $toDom->ownerDocument->importNode($fromDom, true);
            $dstNode->appendChild($node);
        }
    }
}