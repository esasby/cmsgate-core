<?php


namespace esas\cmsgate\hro;


use esas\cmsgate\Registry;
use esas\cmsgate\service\Service;

class HROManager extends Service
{
    /**
     * @var array
     */
    protected $implementations = array();

    /**
     * @var array
     */
    protected $tuners = array();

    /**
     * Для удобства работы в IDE и подсветки синтаксиса.
     * @return $this
     */
    public static function fromRegistry()
    {
        return Registry::getRegistry()->getService(HROManager::class, new HROManager());
    }

    public function addImplementation($hroParentClass, $hroChildClass) {
        $this->implementations[$hroParentClass] = $hroChildClass;
    }

    public function addTuner($hroParentClass, $hroTunerClass) {
        $this->tuners[$hroParentClass] = $hroTunerClass;
    }

    /**
     * @param $hroParentClass
     * @param $defaultImplementationClass
     * @return HRO
     */
    public function getImplementation($hroParentClass, $defaultImplementationClass) {
        $implementationClass = $defaultImplementationClass;
        if (array_key_exists($hroParentClass, $this->implementations))
            $implementationClass = $this->implementations[$hroParentClass];
        /** @var HRO $builder */
        $builder = $implementationClass::builder();
        if (array_key_exists($hroParentClass, $this->tuners)) {
            $tunerClass = $this->tuners[$hroParentClass];
            /** @var HROTuner $tuner */
            $tuner = new $tunerClass();
            $builder = $tuner->tune($builder);
        }
        return $builder;
    }
}