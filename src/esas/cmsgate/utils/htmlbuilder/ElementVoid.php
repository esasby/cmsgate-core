<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 05.03.2019
 * Time: 14:42
 */

namespace esas\cmsgate\utils\htmlbuilder;

use esas\cmsgate\utils\ArrayUtils;
use esas\cmsgate\utils\Logger;
use esas\cmsgate\utils\StringUtils;

class ElementVoid
{
    private $name;

    /**
     * @return Attribute[]
     */
    private $attibutes;

    /**
     * ElementVoid constructor.
     * @param $name
     */
    public function __construct($name, array $attibutes = null)
    {
        $this->name = $name;
        if ($attibutes == null)
            return;
        $attibutes = ArrayUtils::flatten($attibutes);
        foreach ($attibutes as $obj) {
            if ($obj instanceof Attribute)
                $this->attibutes[] = $obj;
            elseif ($obj == null || $obj == "")
                continue; //skip empty attributes
            else {
                Logger::getLogger(get_class($this))->error("Element[" . $name ."]: unknown arg[" . $obj . "]", debug_backtrace());
            }
        }
    }


    public function __toString()
    {
        return StringUtils::format('<%elementName %attributes/>', [
            "%elementName" => $this->name,
            "%attributes" => ArrayUtils::safeImplode(" ", $this->attibutes)
        ]);
    }
}