<?php


namespace esas\cmsgate\utils\htmlbuilder\hro;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardFooterHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardFooterHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHeaderHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHeaderHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormHRO;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormHRO_v2;
use esas\cmsgate\utils\htmlbuilder\hro\tables\DataListHRO;
use esas\cmsgate\utils\htmlbuilder\hro\tables\DataListHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\tables\TableHRO;
use esas\cmsgate\utils\htmlbuilder\hro\tables\TableHRO_v1;

class HROFactory
{
    /**
     * @return HROFactory
     */
    public static function fromRegistry() {
        return Registry::getRegistry()->getHROFactory();
    }

    /**
     * @return FormHRO
     */
    public function createFormBuilder() {
        return FormHRO_v2::builder();
    }

    /**
     * @return CardHRO
     */
    public function createCardBuilder() {
        return CardHRO_v1::builder();
    }

    /**
     * @return CardHeaderHRO
     */
    public function createCardHeaderBuilder() {
        return CardHeaderHRO_v1::builder();
    }

    /**
     * @return CardFooterHRO
     */
    public function createCardFooterBuilder() {
        return CardFooterHRO_v1::builder();
    }

    /**
     * @return TableHRO
     */
    public function createTableBuilder() {
        return TableHRO_v1::builder();
    }

    /**
     * @return DataListHRO
     */
    public function createDataListBuilder() {
        return DataListHRO_v1::builder();
    }
}