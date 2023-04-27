<?php


namespace esas\cmsgate\hro\cards;

use esas\cmsgate\hro\HRO;

interface CardHRO extends HRO
{
    /**
     * @param $cardHeader
     * @param bool $translate
     * @return $this
     */
    public function setCardHeader($cardHeader, $translate = true) ;

    /**
     * @param $cardBody
     * @return $this
     */
    public function setCardBody($cardBody);

    /**
     * @param $cardFooter
     * @return $this
     */
    public function setCardFooter($cardFooter);

}