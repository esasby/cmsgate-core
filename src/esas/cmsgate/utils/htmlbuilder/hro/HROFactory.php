<?php


namespace esas\cmsgate\utils\htmlbuilder\hro;


use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\hro\accordions\AccordionHRO;
use esas\cmsgate\utils\htmlbuilder\hro\accordions\AccordionHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\accordions\AccordionTabHRO;
use esas\cmsgate\utils\htmlbuilder\hro\accordions\AccordionTabHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardFooterHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardFooterHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHeaderHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHeaderHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHRO;
use esas\cmsgate\utils\htmlbuilder\hro\cards\CardHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormButtonHRO;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormButtonHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormFieldTextHRO;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormFieldTextHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormGroupHRO;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormGroupHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormHRO;
use esas\cmsgate\utils\htmlbuilder\hro\forms\FormHRO_v2;
use esas\cmsgate\utils\htmlbuilder\hro\layouts\ColHRO;
use esas\cmsgate\utils\htmlbuilder\hro\layouts\ColHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\layouts\RowHRO;
use esas\cmsgate\utils\htmlbuilder\hro\layouts\RowHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\sections\FooterSectionCompanyInfoHRO;
use esas\cmsgate\utils\htmlbuilder\hro\sections\FooterSectionCompanyInfoHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\panels\CopyToClipboardPanelHRO;
use esas\cmsgate\utils\htmlbuilder\hro\panels\CopyToClipboardPanelHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\sections\HeaderSection3ColHRO;
use esas\cmsgate\utils\htmlbuilder\hro\sections\HeaderSection3ColHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\sections\HeaderSectionLogoContactsHRO;
use esas\cmsgate\utils\htmlbuilder\hro\sections\HeaderSectionLogoContactsHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\shop\BasketItemHRO;
use esas\cmsgate\utils\htmlbuilder\hro\shop\BasketItemHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\shop\BasketItemListHRO;
use esas\cmsgate\utils\htmlbuilder\hro\shop\BasketItemListHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\tables\DataListHRO;
use esas\cmsgate\utils\htmlbuilder\hro\tables\DataListHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\tables\TableHRO;
use esas\cmsgate\utils\htmlbuilder\hro\tables\TableHRO_v1;
use esas\cmsgate\utils\htmlbuilder\hro\typography\DescriptionListHRO;
use esas\cmsgate\utils\htmlbuilder\hro\typography\DescriptionListHRO_v1;
use esas\cmsgate\view\client\ClientOrderCompletionPageHRO;
use esas\cmsgate\view\client\ClientOrderCompletionPageHRO_v1;

class HROFactory
{
    /**
     * @return HROFactory
     */
    public static function fromRegistry() {
        return Registry::getRegistry()->getHROFactory();
    }

    /**
     * @return FormHRO
     */
    public function createFormBuilder() {
        return FormHRO_v2::builder();
    }

    /**
     * @return FormGroupHRO
     */
    public function createFormGroupBuilder() {
        return FormGroupHRO_v1::builder();
    }

    /**
     * @return FormFieldTextHRO
     */
    public function createFormFieldTextBuilder() {
        return FormFieldTextHRO_v1::builder();
    }

    /**
     * @return FormButtonHRO
     */
    public function createFormButtonBuilder() {
        return FormButtonHRO_v1::builder();
    }

    /**
     * @return CardHRO
     */
    public function createCardBuilder() {
        return CardHRO_v1::builder();
    }

    /**
     * @return CardHeaderHRO
     */
    public function createCardHeaderBuilder() {
        return CardHeaderHRO_v1::builder();
    }

    /**
     * @return CardFooterHRO
     */
    public function createCardFooterBuilder() {
        return CardFooterHRO_v1::builder();
    }

    /**
     * @return TableHRO
     */
    public function createTableBuilder() {
        return TableHRO_v1::builder();
    }

    /**
     * @return DataListHRO
     */
    public function createDataListBuilder() {
        return DataListHRO_v1::builder();
    }

    /**
     * @return FooterSectionCompanyInfoHRO
     */
    public function createFooterSectionComponyInfoBuilder() {
        return FooterSectionCompanyInfoHRO_v1::builder();
    }

    /**
     * @return HeaderSection3ColHRO
     */
    public function createHeaderSection3ColBuilder() {
        return HeaderSection3ColHRO_v1::builder();
    }

    /**
     * @return HeaderSectionLogoContactsHRO
     */
    public function createHeaderSectionLogoContactsBuilder() {
        return HeaderSectionLogoContactsHRO_v1::builder();
    }

    /**
     * @return AccordionHRO
     */
    public function createAccordionBuilder() {
        return AccordionHRO_v1::builder();
    }

    /**
     * @return AccordionTabHRO
     */
    public function createAccordionTabBuilder() {
        return AccordionTabHRO_v1::builder();
    }

    /**
     * @return BasketItemHRO
     */
    public function createBasketItemBuilder() {
        return BasketItemHRO_v1::builder();
    }

    /**
     * @return BasketItemListHRO
     */
    public function createBasketItemListBuilder() {
        return BasketItemListHRO_v1::builder();
    }

    /**
     * @return RowHRO
     */
    public function createRowBuilder() {
        return RowHRO_v1::builder();
    }

    /**
     * @return ColHRO
     */
    public function createColBuilder() {
        return ColHRO_v1::builder();
    }

    /**
     * @return DescriptionListHRO
     */
    public function createDescriptionListBuilder() {
        return DescriptionListHRO_v1::builder();
    }

    /**
     * @return ClientOrderCompletionPageHRO
     */
    public function createClientOrderCompletionPage() {
        return ClientOrderCompletionPageHRO_v1::builder();
    }

    /**
     * @return CopyToClipboardPanelHRO
     */
    public function createCopyToClipboardPanel() {
        return CopyToClipboardPanelHRO_v1::builder();
    }
}