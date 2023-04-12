<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\panels;


use esas\cmsgate\lang\Translator;
use esas\cmsgate\utils\htmlbuilder\hro\HROFactory;
use esas\cmsgate\view\admin\AdminViewFields;
use esas\cmsgate\view\admin\fields\ConfigFieldText;

class CopyToClipboardPanelHRO_v1 implements CopyToClipboardPanelHRO
{
    protected $labelId;
    protected $value;

    /**
     * @inheritDoc
     */
    public function setLabelId($labelId) {
        $this->labelId = $labelId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public static function builder() {
        return new CopyToClipboardPanelHRO_v1();
    }

    public function build() {
        $configField = new ConfigFieldText(
            $this->labelId,
            Translator::fromRegistry()->translate($this->labelId),
            '',
            false,
            null,
            true);
        $configField->setValue($this->value);
        return
            HROFactory::fromRegistry()->createCardBuilder()
                ->setCardBody(HROFactory::fromRegistry()->createFormFieldTextBuilder()
                    ->setFieldDescriptor($configField)
                    ->addOnFieldAction(HROFactory::fromRegistry()->createFormButtonBuilder()
                        ->setType("button")
                        ->setOnClick("copyToClipboard('" . $configField->getKey() . "')")
                        ->setLabel(AdminViewFields::COPY)
                        ->build())
                    ->build())
                ->build();
    }
}