<?php


namespace esas\cmsgate\hro\tables;


use esas\cmsgate\Registry;
use esas\cmsgate\hro\cards\CardFooterHROFactory;
use esas\cmsgate\hro\cards\CardHeaderHROFactory;
use esas\cmsgate\hro\cards\CardHROFactory;
use esas\cmsgate\view\admin\AdminViewFields;

class DataListHRO_v1 implements DataListHRO
{
    protected $cardHeader;
    protected $cardBody;
    protected $cardFooter;

    public static function builder() {
        return new DataListHRO_v1();
    }

    public function __construct() {
        $this->cardHeader = CardHeaderHROFactory::findBuilder();
        $this->cardBody = TableHROFactory::findBuilder();
        $this->cardFooter = CardFooterHROFactory::findBuilder();
    }

    public function setMainLabel($headerLabel, $translate = true) {
        $this->cardHeader->setLabel($headerLabel, $translate);
        return $this;
    }

    public function setTableHeaderColumns($tableHeaderColumns) {
        $this->cardBody->setTableHeaderColumns($tableHeaderColumns);
        return $this;
    }

    public function setTableBody($tableBody) {
        $this->cardBody->setTableBody($tableBody);
        return $this;
    }

    public function addFooterButton($label, $href, $classAppend, $translate = true) {
        $this->cardFooter->addButton($label, $href, $classAppend, $translate);
        return $this;
    }

    public function addFooterButtonAdd($href) {
        $this->cardFooter->addButton(AdminViewFields::ADD, $href, 'btn-secondary');
        return $this;
    }


    public function addHeaderButton($label, $href, $classAppend, $translate = true) {
        $this->cardHeader->addButton($label, $href, $classAppend, $translate);
        return $this;
    }

    public function build() {
        return
            CardHROFactory::findBuilder()
                ->setCardHeader($this->cardHeader->build())
                ->setCardBody($this->cardBody->build())
                ->setCardFooter($this->cardFooter->build())
                ->build();
    }
}