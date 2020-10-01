<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 05.03.2019
 * Time: 13:08
 */

namespace esas\cmsgate\utils\htmlbuilder;

class Elements
{
    const DIV = "div";
    const SECTION = "section";
    const INPUT = "input";
    const TEXTAREA = "textarea";
    const TABLE = "table";
    const TR = "tr";
    const TD = "td";
    const TH = "th";
    const LABEL = "label";
    const SELECT = "select";
    const VALUE = "value";
    const OPTION = "option";
    const SPAN = "span";
    const IMG = "img";
    const AREA = "area";
    const BASE = "base";
    const LINK = "link";
    const META = "meta";
    const PARAM = "param";
    const COL = "col";
    const A = "a";
    const BR = "br";
    const HR = "hr";
    const H1 = "h1";
    const H2 = "h2";
    const H3 = "h3";
    const H4 = "h4";
    const I = "i";
    const B = "b";
    const P = "p";
    const FORM = "form";
    const FIELDSET = "fieldset";
    const FONT = "font";
    const BUTTON = "button";
    const SCRIPT = "script";
    const STYLE = "style";
    const STRONG = "strong";
    const LI = "li";
    const UL = "ul";

    public static function div(...$elementAndAttributes)
    {
        return new Element(self::DIV, $elementAndAttributes);
    }

    public static function section(...$elementAndAttributes)
    {
        return new Element(self::SECTION, $elementAndAttributes);
    }

    public static function input(...$attributes)
    {
        return new ElementVoid(self::INPUT, $attributes);
    }

    public static function select(...$elementAndAttributes)
    {
        return new Element(self::SELECT, $elementAndAttributes);
    }

    public static function textarea(...$elementAndAttributes)
    {
        return new Element(self::TEXTAREA, $elementAndAttributes);
    }

    public static function table(...$elementAndAttributes)
    {
        return new Element(self::TABLE, $elementAndAttributes);
    }

    public static function tr(...$elementAndAttributes)
    {
        return new Element(self::TR, $elementAndAttributes);
    }

    public static function td(...$elementAndAttributes)
    {
        return new Element(self::TD, $elementAndAttributes);
    }

    public static function th(...$elementAndAttributes)
    {
        return new Element(self::TH, $elementAndAttributes);
    }

    public static function label(...$elementAndAttributes)
    {
        return new Element(self::LABEL, $elementAndAttributes);
    }

    public static function styleFile($fileLocation)
    {
        return new Element(self::STYLE, [new ReadContentFile($fileLocation)]);
    }

    public static function strong(...$elementAndAttributes)
    {
        return new Element(self::STRONG, $elementAndAttributes);
    }

    public static function option(...$elementAndAttributes)
    {
        return new Element(self::OPTION, $elementAndAttributes);
    }

    public static function span(...$elementAndAttributes)
    {
        return new Element(self::SPAN, $elementAndAttributes);
    }

    public static function img(...$attributes)
    {
        return new ElementVoid(self::IMG, $attributes);
    }

    public static function link(...$attributes)
    {
        return new ElementVoid(self::LINK, $attributes);
    }

    public static function meta(...$attributes)
    {
        return new ElementVoid(self::META, $attributes);
    }

    public static function param(...$attributes)
    {
        return new ElementVoid(self::PARAM, $attributes);
    }

    public static function area(...$attributes)
    {
        return new ElementVoid(self::AREA, $attributes);
    }

    public static function base(...$attributes)
    {
        return new ElementVoid(self::BASE, $attributes);
    }

    public static function col(...$attributes)
    {
        return new ElementVoid(self::COL, $attributes);
    }

    public static function a(...$elementAndAttributes)
    {
        return new Element(self::A, $elementAndAttributes);
    }

    public static function li(...$elementAndAttributes)
    {
        return new Element(self::LI, $elementAndAttributes);
    }

    public static function ul(...$elementAndAttributes)
    {
        return new Element(self::UL, $elementAndAttributes);
    }

    public static function br()
    {
        return new ElementVoid(self::BR, null);
    }

    public static function hr()
    {
        return new ElementVoid(self::HR, null);
    }

    public static function h1(...$elementAndAttributes)
    {
        return new Element(self::H1, $elementAndAttributes);
    }

    public static function h2(...$elementAndAttributes)
    {
        return new Element(self::H2, $elementAndAttributes);
    }

    public static function h3(...$elementAndAttributes)
    {
        return new Element(self::H3, $elementAndAttributes);
    }

    public static function h4(...$elementAndAttributes)
    {
        return new Element(self::H4, $elementAndAttributes);
    }

    public static function i(...$elementAndAttributes)
    {
        return new Element(self::I, $elementAndAttributes);
    }

    public static function b(...$elementAndAttributes)
    {
        return new Element(self::B, $elementAndAttributes);
    }

    public static function p(...$elementAndAttributes)
    {
        return new Element(self::P, $elementAndAttributes);
    }

    public static function form(...$elementAndAttributes)
    {
        return new Element(self::FORM, $elementAndAttributes);
    }

    public static function fieldset(...$elementAndAttributes)
    {
        return new Element(self::FIELDSET, $elementAndAttributes);
    }

    public static function font(...$elementAndAttributes)
    {
        return new Element(self::FONT, $elementAndAttributes);
    }

    public static function button(...$elementAndAttributes)
    {
        return new Element(self::BUTTON, $elementAndAttributes);
    }

    public static function content(...$elementsAndContent)
    {
        return new Content($elementsAndContent);
    }

    public static function includeFile($scriptFileLocation, $scriptData)
    {
        return new IncludeFile($scriptFileLocation, $scriptData);
    }

    public static function includeFileWithCurrentScope($includeFileLocation, $context)
    {
        return new IncludeFile($includeFileLocation, $context);
    }

    public static function includeFileNoData($includeFileLocation)
    {
        return new IncludeFile($includeFileLocation, null);
    }
}