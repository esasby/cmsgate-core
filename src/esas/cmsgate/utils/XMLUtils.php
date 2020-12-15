<?php


namespace esas\cmsgate\utils;


use DOMDocument;
use DOMXPath;
use SimpleXMLElement;

class XMLUtils
{
    /**
     * @param DOMDocument $document xml документ, в который необходимо вставить массив элементов
     * @param mixed $elements элементы для вставки (SimpleXml)
     * @param string $path путь, по которому вставить элементы
     * @param bool $truncate необходимо ли очистить путь перед вставкой (самый последний потомок)
     */
    static function inject($document, $elements, $path, $truncate = false) {
        if (!is_array($elements))
            $elements = array($elements);
        if ($truncate)
            self::truncatePath($document, $path);
        self::createPath($document, $path);
        $xp = new DOMXPath($document);
        $dstNode = $xp->query($path)->item(0);
        foreach ($elements as $element) {
            $fromDom = dom_import_simplexml($element);
            $node = $document->importNode($fromDom, true);
            $dstNode->appendChild($node);
        }
    }

    /**
     * @param DOMDocument $document
     * @param string $path
     */
    static function truncatePath($document, $path) {
        $xp = new DOMXPath($document);
        $elements = $xp->query($path);
        foreach ($elements as $item) {
            $document->removeChild($item);
        }
    }

    /**
     * @param DOMDocument $document
     * @param string $path
     */
    static function createPath($document, $path) {
        $pathElements = explode("/", $path);
        $cursorPath = "";
        $xp = new DOMXPath($document);
        $parentNode = $document;
        foreach ($pathElements as $pathElement) {
            if ($pathElement == "")
                continue;
            $cursorPath = $cursorPath . "/" . $pathElement;
            $cursorNode = $xp->query($cursorPath)->item(0);
            if (isset($cursorNode)) {
                $parentNode = $cursorNode;
                continue;
            } else {
                if (strpos($pathElement, "@") !== false) {
                    $newElement = $document->createElement(StringUtils::substrBefore($pathElement, "["));
                    $attributes = StringUtils::substrBetween($pathElement, "[", "]");
                    foreach (explode("and", $attributes) as $attribute) {
                        preg_match('~@(.*)=\s?\'(.*)\'~', $attribute, $m);
                        $newElement->setAttribute(trim($m[1]), $m[2]);
                    }
                } else {
                    $newElement = $document->createElement($pathElement);
                }
                $parentNode->appendChild($newElement);
                $parentNode = $newElement;
            }
        }
    }

    static function simpleXMLAppend(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

    /**
     * @param DOMDocument $document
     * @param string $path
     */
    static function saveFormatted($document, $filePath) {
        $strXml = $document->saveXML();
        $document->formatOutput = true;
        $document->preserveWhiteSpace = false;
        $document->loadXML($strXml);
        $document->save($filePath);
    }
}