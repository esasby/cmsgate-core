<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 24.06.2019
 * Time: 14:11
 */

namespace esas\cmsgate\hro\pages;

use esas\cmsgate\Registry;
use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\hro\sections\FooterSectionCompanyInfoHROFactory;
use esas\cmsgate\hro\sections\HeaderSectionLogoContactsHROFactory;
use esas\cmsgate\utils\htmlbuilder\page\AdditionalCssPage;
use esas\cmsgate\utils\htmlbuilder\page\DisplayErrorPage;
use esas\cmsgate\utils\htmlbuilder\presets\CssPreset as css;
use esas\cmsgate\utils\htmlbuilder\presets\ScriptsPreset as script;

abstract class ClientPageHRO extends PageHRO implements AdditionalCssPage, DisplayErrorPage
{
    protected $elementAdditionalCss;

    public function addCssLink($additionalCss) {
        $this->elementAdditionalCss .= css::elementHeadLinkStylesheet($additionalCss);
        return $this;
    }

    public function isErrorPage() {
        return Registry::getRegistry()->getMessenger()->hasErrorMessages();
    }

    public function elementPageHead() {
        return element::head(
            element::title(
                element::content($this->getPageTitle())
            ),
            $this->elementHeadMetaCharset('utf-8'),
            element::meta(
                attribute::name('viewport'),
                attribute::content('width=device-width, initial-scale=1, shrink-to-fit=no')),
            css::elementLinkCssGoogleFonts("css?family=Merienda+One"),
            css::elementLinkCssGoogleFonts("icon?family=Material+Icons"),
            css::elementLinkCssFontAwesome4Min(),
            css::elementLinkCssBootstrapMin(),
            script::elementScriptJquery3Min(),
            script::elementScriptPopper1Min(),
            script::elementScriptBootstrapMin(),
            $this->elementAdditionalCss
        );
    }

    public function elementPageBody() {
        return element::body(
            attribute::clazz("d-flex flex-column min-vh-100"),
            $this->elementSectionHeader(),
            $this->elementSectionBody(),
            $this->elementSectionFooter()
        );
    }

    public function elementSectionHeader() {
        return HeaderSectionLogoContactsHROFactory::findBuilder()
            ->setTitle($this->getElementSectionHeaderTitle())
            ->setTitleDetails($this->getElementSectionHeaderDetails())
            ->build();
    }

//    public function elementSectionHeader() {
//        return element::div(
//            attribute::id('element-section-header'),
//            element::div(
//                attribute::clazz("container p-3 text-white text-center"),
//                element::content(
//                    bootstrap::elementRowExt("gy-3",
//                        bootstrap::elementDiv("col-6 col-md-2 text-start",
//                            attribute::id("element-header-start-block"),
//                            element::img(
//                                attribute::src("https://cmsgate-test.esas.by/cmsgate-buynow-epos/static/epos_by_white.svg"),
////                                attribute::clazz('img-thumbnail'),
//                                attribute::width('200')
//                            )),
//                        bootstrap::elementDiv("col-md-8 d-none d-md-block",
//                            element::h1($this->getElementSectionHeaderTitle()),
//                            element::p($this->getElementSectionHeaderDetails())),
//                        bootstrap::elementDiv("col-6 col-md-2 text-end",
//                            attribute::id("element-header-end-block"),
//                            element::h6(
//                                attribute::clazz("text-uppercase fw-bold mt-2"),
//                                element::content("Контакты")),
//                            element::p(
//                                attribute::clazz("mb-0"),
//                                bootstrap::elementClickableEmailExt("text-decoration-none text-white", "support@epos.by")),
//                            element::p(
//                                attribute::clazz("mb-0"),
//                                bootstrap::elementClickablePhoneExt("text-decoration-none text-white", "+375 17 3971919"))),
//                        bootstrap::elementDiv("col-md-12 d-sm-block d-md-none",
//                            element::h1($this->getElementSectionHeaderTitle()),
//                            element::p($this->getElementSectionHeaderDetails())),
//                    )
//                )
//            )
//        );
//    }

    public abstract function getElementSectionHeaderTitle();

    public abstract function getElementSectionHeaderDetails();

//    public function elementSectionBody()
//    {
//        return element::main(
//            attribute::clazz('container mt-5'),
//            $this->elementPageContent()
//        );
//    }

    public function elementSectionBody() {
        return element::main(
            attribute::clazz('container mt-5'),
            $this->elementMessageAndContent()
        );
    }

    public function elementMessageAndContent() {
        $messages = $this->elementMessages();
        return ($messages != '' ? $messages . element::br() : "")
            . ($this->isErrorPage() ? $this->elementPageErrorContent() : $this->elementPageContent());
    }

    public function elementPageErrorContent() {
        return "";
    }

    public abstract function elementPageContent();

    public function elementSectionFooter() {
        return
            FooterSectionCompanyInfoHROFactory::findBuilder()
                ->build();
    }


}