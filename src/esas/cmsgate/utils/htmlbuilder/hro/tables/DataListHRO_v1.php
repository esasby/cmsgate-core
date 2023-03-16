<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\tables;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\hro\HROFactory;
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
        $this->cardHeader = HROFactory::fromRegistry()->createCardHeaderBuilder();
        $this->cardBody = HROFactory::fromRegistry()->createTableBuilder();
        $this->cardFooter = HROFactory::fromRegistry()->createCardFooterBuilder();
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
            Registry::getRegistry()->getHROFactory()->createCardBuilder()
                ->setCardHeader($this->cardHeader->build())
                ->setCardBody($this->cardBody->build())
                ->setCardFooter($this->cardFooter->build())
                ->build();
    }
}