<?php


namespace esas\cmsgate\hro\shop;

use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\ScriptsPreset;

class BasketItemListHRO_v1 implements BasketItemListHRO
{
    protected $elementItems;

    /**
     * @inheritDoc
     */
    public function addItem($basketItem) {
        $this->elementItems .=
            element::li(
                attribute::clazz('list-group-item'),
                $basketItem
            );
    }

    public static function builder() {
        return new BasketItemListHRO_v1();
    }

    public function build() {
        return
            element::div(
                attribute::clazz('card'),
                element::ul(
                    attribute::clazz("list-group list-group-flush"),
                    $this->elementItems
                ),
                ScriptsPreset::elementScriptMultiply() //todo неявная связь
            );
    }
}