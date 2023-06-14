<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 15.01.2020
 * Time: 12:40
 */

namespace esas\cmsgate\messenger;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\Registry;
use esas\cmsgate\service\Service;

class Messenger extends Service
{
    /**
     * @var Translator
     */
    protected $translator;

    private $infoMessages = array();
    private $successMessages = array();
    private $warnMessages = array();
    private $errorMessages = array();

    /**
     * Messenger constructor.
     * @param $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     */
    public static function fromRegistry() {
        return Registry::getRegistry()->getService(Messenger::class, Registry::getRegistry()->getMessenger()); //to fix
    }

    public function addInfoMessage($msg) {
        if (!in_array($msg, $this->infoMessages))
            $this->infoMessages[] = $this->translator->translate($msg);
    }

    public function addWarnMessage($msg) {
        if (!in_array($msg, $this->warnMessages))
            $this->warnMessages[] = $this->translator->translate($msg);
    }

    public function addErrorMessage($msg) {
        if (!in_array($msg, $this->errorMessages))
            $this->errorMessages[] = $this->translator->translate($msg);
    }

    public function addSuccessMessage($msg) {
        if (!in_array($msg, $this->successMessages))
            $this->successMessages[] = $this->translator->translate($msg);
    }

    /**
     * @return string
     */
    public function getInfoMessages()
    {
        return implode("\n", $this->infoMessages);
    }

    /**
     * @return array
     */
    public function getInfoMessagesArray()
    {
        return $this->infoMessages;
    }

    /**
     * @return string
     */
    public function getSuccessMessages()
    {
        return implode("\n", $this->successMessages);
    }

    /**
     * @return array
     */
    public function getSuccessMessagesArray()
    {
        return $this->successMessages;
    }

    /**
     * @return string
     */
    public function getWarnMessages()
    {
        return implode("\n", $this->warnMessages);
    }

    /**
     * @return array
     */
    public function getWarnMessagesArray()
    {
        return $this->warnMessages;
    }

    /**
     * @return string
     */
    public function getErrorMessages()
    {
        return implode("\n", $this->errorMessages);
    }

    /**
     * @return bool
     */
    public function hasErrorMessages() {
        return sizeof($this->errorMessages) > 0;
    }

    /**
     * @return array
     */
    public function getErrorMessagesArray()
    {
        return $this->errorMessages;
    }

}