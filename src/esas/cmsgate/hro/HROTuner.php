<?php


namespace esas\cmsgate\hro;


interface HROTuner
{
    /**
     * @param $hroBuilder HRO
     * @return HRO
     */
    public function tune($hroBuilder);
}