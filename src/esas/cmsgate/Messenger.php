<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 15.01.2020
 * Time: 12:40
 */

namespace esas\cmsgate;


use esas\cmsgate\lang\Translator;

class Messenger
{
    /**
     * @var Translator
     */
    protected $translator;

    private $infoMessages = '';
    private $warnMessages = '';
    private $errorMessages = '';

    /**
     * Messenger constructor.
     * @param $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    public function addInfoMessage($msg) {
        $this->infoMessages = $this->infoMessages . ($this->infoMessages != '' ? "\n" : "") . $this->translator->translate($msg);
    }

    public function addWarnMessage($msg) {
        $this->warnMessages = $this->warnMessages . ($this->warnMessages != '' ? "\n" : "") . $this->translator->translate($msg);
    }

    public function addErrorMessage($msg) {
        $this->errorMessages = $this->errorMessages . ($this->errorMessages != '' ? "\n" : "") . $this->translator->translate($msg);
    }

    /**
     * @return string
     */
    public function getInfoMessages()
    {
        return $this->infoMessages;
    }

    /**
     * @return string
     */
    public function getWarnMessages()
    {
        return $this->warnMessages;
    }

    /**
     * @return string
     */
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }



}