<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 05.03.2019
 * Time: 13:08
 */

namespace esas\cmsgate\utils\htmlbuilder;


class Attributes
{
    const ID = "id";
    const CLAZZ = "class";
    const DATA = "data";
    const STYLE = "style";
    const WIDTH = "width";
    const HEIGHT = "height";
    const SCOPE = "scope";
    const ALIGN = "align";
    const ACTION = "action";
    const METHOD = "method";
    const ENCTYPE = "enctype";
    const TYPE = "type";
    const NAME = "name";
    const FORR = "for";
    const MIN = "min";
    const MAX = "max";
    const PLACEHOLDER = "placeholder";
    const ROWS = "rows";
    const COLS = "cols";
    const COLSPAN = "colspan";
    const COLOR = "color";
    const ONCLICK = "onclick";
    const ONKEYUP = "onKeyUp";
    const ONINPUT = "oninput";
    const VALUE = "value";
    const ROLE = "role";
    const VALIGN = "valign";
    const CHECKED = "checked";
    const DISABLED = "disabled";
    const CHARSET = "charset";
    const CONTENT = "content";
    const SELECTED = "selected";
    const DATA_TOGLE = "data-toggle";
    const DATA_HREF = "data-href";
    const DATA_PLACEMENT = "data-placement";
    const DATA_BS_TOGGLE = "data-bs-toggle";
    const DATA_BS_TARGET = "data-bs-target";
    const DATA_BS_PARENT = "data-bs-parent";
    const DATA_BS_RIDE = "data-bs-ride";
    const DATA_BS_SLIDE = "data-bs-slide";
    const DATA_BS_SLIDE_TO = "data-bs-slide-to";
    const DATA_BS_DISMISS = "data-bs-dismiss";
    const DATA_SITEKEY = "data-sitekey";
    const DATA_ACTION = "data-action";
    const DATA_CALLBACK = "data-callback";
    const ARIA_EXPANDED = "aria-expanded";
    const ARIA_HIDDEN = "aria-hidden";
    const ARIA_CURRENT = "aria-current";
    const ARIA_LABEL = "aria-label";
    const ARIA_CONTROLS = "aria-controls";
    const ARIA_LABELLEDBY = "aria-labelledby";
    const DATA_DISMISS = "data-dismiss";
    const TITLE = "title";
    const SRC = "src";
    const ALT = "alt";
    const HREF = "href";
    const REL = "rel";
    const MAXLENGTH = "maxlength";
    const REQUIRED = "required";
    const READONLY = "readonly";

    /**
     * @param $id
     * @return Attribute
     */
    public static function id($id)
    {
        return new Attribute(self::ID, $id);
    }

    public static function clazz($class)
    {
        return new Attribute(self::CLAZZ, $class);
    }

    public static function data($extraTag, $data)
    {
        return new Attribute(self::DATA . "-" . $extraTag, $data);
    }

    public static function style($style)
    {
        return new Attribute(self::STYLE, $style);
    }

    public static function width($width)
    {
        return new Attribute(self::WIDTH, $width);
    }

    public static function height($height)
    {
        return new Attribute(self::HEIGHT, $height);
    }

    public static function scope($scope)
    {
        return new Attribute(self::SCOPE, $scope);
    }

    public static function align($align)
    {
        return new Attribute(self::ALIGN, $align);
    }

    public static function action($action)
    {
        return new Attribute(self::ACTION, $action);
    }

    public static function method($methos)
    {
        return new Attribute(self::METHOD, $methos);
    }

    public static function enctype($enctype)
    {
        return new Attribute(self::ENCTYPE, $enctype);
    }

    public static function type($type)
    {
        return new Attribute(self::TYPE, $type);
    }

    public static function name($name)
    {
        return new Attribute(self::NAME, $name);
    }

    public static function placeholder($nplaceholderme)
    {
        return new Attribute(self::PLACEHOLDER, $nplaceholderme);
    }

    public static function rows($rows)
    {
        return new Attribute(self::ROWS, $rows);
    }

    public static function cols($cols)
    {
        return new Attribute(self::COLS, $cols);
    }

    public static function min($min)
    {
        return new Attribute(self::MIN, $min);
    }

    public static function max($max)
    {
        return new Attribute(self::MAX, $max);
    }

    public static function colspan($colspan)
    {
        return new Attribute(self::COLSPAN, $colspan);
    }

    public static function color($color)
    {
        return new Attribute(self::COLOR, $color);
    }

    public static function onclick($onclick)
    {
        return new Attribute(self::ONCLICK, $onclick);
    }

    public static function onKeyUp($onKeyUp)
    {
        return new Attribute(self::ONKEYUP, $onKeyUp);
    }

    public static function onInput($onInput)
    {
        return new Attribute(self::ONINPUT, $onInput);
    }

    public static function forr($forr)
    {
        return new Attribute(self::FORR, $forr);
    }

    public static function value($value)
    {
        return new Attribute(self::VALUE, $value);
    }

    public static function role($role)
    {
        return new Attribute(self::ROLE, $role);
    }

    public static function valign($valign)
    {
        return new Attribute(self::VALIGN, $valign);
    }

    public static function checked($checked)
    {
        return new AttributeBoolean(self::CHECKED, $checked);
    }

    public static function disabled($disabled)
    {
        return new AttributeBoolean(self::DISABLED, $disabled);
    }

    public static function charset($charset)
    {
        return new Attribute(self::CHARSET, $charset);
    }

    public static function content($content)
    {
        return new Attribute(self::CONTENT, $content);
    }

    public static function selected($selected)
    {
        return new AttributeBoolean(self::SELECTED, $selected);
    }

    public static function data_toggle($dataToggle)
    {
        return new Attribute(self::DATA_TOGLE, $dataToggle);
    }

    public static function data_href($dataHref)
    {
        return new Attribute(self::DATA_HREF, $dataHref);
    }

    public static function data_placement($dataPlacement)
    {
        return new Attribute(self::DATA_PLACEMENT, $dataPlacement);
    }

    public static function data_bs_toggle($dataBSToggle)
    {
        return new Attribute(self::DATA_BS_TOGGLE, $dataBSToggle);
    }

    public static function data_bs_target($dataBSTarget)
    {
        return new Attribute(self::DATA_BS_TARGET, $dataBSTarget);
    }

    public static function data_bs_parent($dataBSParent)
    {
        return new Attribute(self::DATA_BS_PARENT, $dataBSParent);
    }

    public static function data_bs_ride($dataBSRide)
    {
        return new Attribute(self::DATA_BS_RIDE, $dataBSRide);
    }

    public static function data_bs_slide($dataBSSlide)
    {
        return new Attribute(self::DATA_BS_SLIDE, $dataBSSlide);
    }

    public static function data_bs_slide_to($dataBSSlideTo)
    {
        return new Attribute(self::DATA_BS_SLIDE_TO, $dataBSSlideTo);
    }

    public static function data_bs_dismiss($dataDismiss)
    {
        return new Attribute(self::DATA_BS_DISMISS, $dataDismiss);
    }

    public static function data_sitekey($dataSiteKey)
    {
        return new Attribute(self::DATA_SITEKEY, $dataSiteKey);
    }

    public static function data_action($dataAction)
    {
        return new Attribute(self::DATA_ACTION, $dataAction);
    }

    public static function data_callback($dataCallback)
    {
        return new Attribute(self::DATA_CALLBACK, $dataCallback);
    }

    public static function data_dismiss($dataDismiss)
    {
        return new Attribute(self::DATA_DISMISS, $dataDismiss);
    }

    public static function aria_controls($ariaControls)
    {
        return new Attribute(self::ARIA_CONTROLS, $ariaControls);
    }

    public static function aria_expanded($ariaExpanded)
    {
        return new Attribute(self::ARIA_EXPANDED, $ariaExpanded);
    }

    public static function aria_hidden($ariaHidden = true)
    {
        return $ariaHidden ? new AttributeBoolean(self::ARIA_HIDDEN, $ariaHidden) : "";
    }

    public static function aria_current($ariaCurrent = true)
    {
        return $ariaCurrent ? new AttributeBoolean(self::ARIA_CURRENT, $ariaCurrent) : "";
    }

    public static function aria_label($ariaLabel)
    {
        return new Attribute(self::ARIA_LABEL, $ariaLabel);
    }

    public static function aria_labelledby($ariaLabelledby)
    {
        return new Attribute(self::ARIA_LABELLEDBY, $ariaLabelledby);
    }

    public static function title($title)
    {
        return new Attribute(self::TITLE, $title);
    }

    public static function src($src)
    {
        return new Attribute(self::SRC, $src);
    }

    public static function alt($alt)
    {
        return new Attribute(self::ALT, $alt);
    }

    public static function href($href)
    {
        return new Attribute(self::HREF, $href);
    }

    public static function rel($rel)
    {
        return new Attribute(self::REL, $rel);
    }

    public static function maxlength($maxlength)
    {
        return new Attribute(self::MAXLENGTH, $maxlength);
    }

    public static function required()
    {
        return new Attribute(self::REQUIRED, "required");
    }

    public static function readOnly($readOnly = true)
    {
        return $readOnly ? new AttributeBoolean(self::READONLY, $readOnly) : "";
    }
}