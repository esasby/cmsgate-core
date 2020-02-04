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

    private $messeges = '';

    /**
     * Messenger constructor.
     * @param $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    public function addMessage($msg) {
        $this->messeges = $this->messeges . ($this->messeges != '' ? "\n" : "") . $this->translator->translate($msg);
    }

    /**
     * @return string
     */
    public function getMesseges()
    {
        return $this->messeges;
    }

}