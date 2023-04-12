<?php


namespace esas\cmsgate\utils\htmlbuilder\hro\sections;

use esas\cmsgate\utils\htmlbuilder\hro\HRO;

interface HeaderSectionLogoContactsHRO extends HRO
{
    /**
     * @param mixed $logoUrl
     * @return HeaderSectionLogoContactsHRO
     */
    public function setLogo($logoUrl);

    /**
     * @param mixed $smallLogoUrl
     * @return HeaderSectionLogoContactsHRO
     */
    public function setSmallLogo($smallLogoUrl);

    /**
     * @param mixed $title
     * @return HeaderSectionLogoContactsHRO
     */
    public function setTitle($title);

    /**
     * @param mixed $titleDetails
     * @return HeaderSectionLogoContactsHRO
     */
    public function setTitleDetails($titleDetails);

    /**
     * @param $contactItem
     * @return FooterSectionCompanyInfoHRO
     */
    public function addContactItem($contactItem);

    /**
     * @param $contactItemPhone
     * @return FooterSectionCompanyInfoHRO
     */
    public function addContactItemPhone($contactItemPhone);

    /**
     * @param $contactItemEmail
     * @return FooterSectionCompanyInfoHRO
     */
    public function addContactItemEmail($contactItemEmail);

}