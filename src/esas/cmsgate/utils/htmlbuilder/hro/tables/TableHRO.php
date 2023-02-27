<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\tables;

use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\hro\HRO;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class TableHRO implements HRO
{
    protected $tableHeader;
    protected $tableBody;
    protected $tableFooter;

    /**
     * @param mixed $tableHeader
     * @return TableHRO
     */
    public function setTableHeader($tableHeader) {
        $this->tableHeader = $tableHeader;
        return $this;
    }

    public function setTableHeaderColumns($labelsArray, $translate = false) {
        $this->tableHeader = bootstrap::elementTableHead($labelsArray, $translate);
        return $this;
    }

    public function setTableHeaderColumnsI18n($labelsArray) {
        return $this->setTableHeaderColumns($labelsArray, true);
    }

    /**
     * @param mixed $tableBody
     * @return TableHRO
     */
    public function setTableBody($tableBody) {
        $this->tableBody = $tableBody;
        return $this;
    }

    public static function builder() {
        return new TableHRO();
    }

    public function build() {
        return element::table(
            attribute::clazz('table table-striped table-bordered'),
            $this->elementTableHead(),
            $this->elementTableBody(),
            $this->elementTableFooter());
    }

    public function elementTableHead() {
        return $this->tableHeader;
    }

    public function elementTableBody() {
        return $this->tableBody;
    }

    public function elementTableFooter() {
        return $this->tableFooter;
    }

}