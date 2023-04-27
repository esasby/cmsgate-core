<?php


namespace esas\cmsgate\hro\tables;

use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;

class TableHRO_v1 implements TableHRO
{
    protected $tableHeader;
    protected $tableBody;
    protected $tableFooter;

    /**
     * @param mixed $tableHeader
     * @return TableHRO_v1
     */
    public function setTableHeader($tableHeader) {
        $this->tableHeader = $tableHeader;
        return $this;
    }

    public function setTableHeaderColumns($labelsArray, $translate = true) {
        $this->tableHeader = bootstrap::elementTableHead($labelsArray, $translate);
        return $this;
    }

    /**
     * @param mixed $tableBody
     * @return TableHRO_v1
     */
    public function setTableBody($tableBody) {
        $this->tableBody = $tableBody;
        return $this;
    }

    public static function builder() {
        return new TableHRO_v1();
    }

    public function build() {
        return element::table(
            attribute::clazz('table table-striped table-bordered'),
            $this->tableHeader,
            $this->tableBody,
            $this->tableFooter);
    }

}