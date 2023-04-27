<?php


namespace esas\cmsgate\hro\sections;


use esas\cmsgate\hro\HRO;

interface FooterSectionCompanyInfoHRO extends HRO
{
    /**
     * @param $aboutItem
     * @return FooterSectionCompanyInfoHRO
     */
    public function addAboutItem($aboutItem);

    /**
     * @param $addressItem
     * @return FooterSectionCompanyInfoHRO
     */
    public function addAddressItem($addressItem);

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