<?php
/**
 * Created by PhpStorm.
 * User: nikit
 * Date: 06.11.2018
 * Time: 17:08
 */

namespace esas\cmsgate\protocol;


use esas\cmsgate\utils\Logger;
use esas\cmsgate\utils\StringUtils;

class Amount
{
    private $value;
    private $currency;

    const validCurrencies = array('BYN', 'USD', 'EUR', 'RUB');

    /**
     * Amount constructor.
     * @param $value
     * @param $currency
     */
    public function __construct($value, $currency = null)
    {
        $this->value = $value;
        $this->setCurrency($currency);
    }


    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $currency = trim($currency);
        if (!in_array($currency, self::validCurrencies)) {
            $currency = 'BYN';
        }
        $this->currency = $currency;
    }

    public function isEqual(Amount $compTo)
    {
        if (!StringUtils::compare($this->getCurrency(), $compTo->getCurrency()))
            return false;
        else
            return $this->getValue() == $compTo->getValue();
    }

    public function __toString()
    {
        return $this->getValue() . " " . $this->getCurrency();
    }

    const currencyNumcodes = array(
        'BYN' => '933',
        'UAH' => '980',
        'USD' => '840',
        'EUR' => '978',
        'GBP' => '826',
        'JPY' => '392',
        'CHF' => '756',
        'CNY' => '156',
        'RUB' => '643',
        'AED' => '784',
        'AFN' => '971',
        'ALL' => '008',
        'AMD' => '051',
        'AOA' => '973',
        'ARS' => '032',
        'AUD' => '036',
        'AZN' => '944',
        'BDT' => '050',
        'BGN' => '975',
        'BHD' => '048',
        'BIF' => '108',
        'BND' => '096',
        'BOB' => '068',
        'BRL' => '986',
        'BWP' => '072',
        'CAD' => '124',
        'CDF' => '976',
        'CLP' => '152',
        'COP' => '170',
        'CRC' => '188',
        'CUP' => '192',
        'CZK' => '203',
        'DJF' => '262',
        'DKK' => '208',
        'DZD' => '012',
        'EGP' => '818',
        'ETB' => '230',
        'GEL' => '981',
        'GHS' => '936',
        'GMD' => '270',
        'GNF' => '324',
        'HKD' => '344',
        'HRK' => '191',
        'HUF' => '348',
        'IDR' => '360',
        'ILS' => '376',
        'INR' => '356',
        'IQD' => '368',
        'IRR' => '364',
        'ISK' => '352',
        'JOD' => '400',
        'KES' => '404',
        'KGS' => '417',
        'KHR' => '116',
        'KPW' => '408',
        'KRW' => '410',
        'KWD' => '414',
        'KZT' => '398',
        'LAK' => '418',
        'LBP' => '422',
        'LKR' => '144',
        'LYD' => '434',
        'MAD' => '504',
        'MDL' => '498',
        'MGA' => '969',
        'MKD' => '807',
        'MNT' => '496',
        'MRO' => '478',
        'MUR' => '480',
        'MWK' => '454',
        'MXN' => '484',
        'MYR' => '458',
        'MZN' => '943',
        'NAD' => '516',
        'NGN' => '566',
        'NIO' => '558',
        'NOK' => '578',
        'NPR' => '524',
        'NZD' => '554',
        'OMR' => '512',
        'PEN' => '604',
        'PHP' => '608',
        'PKR' => '586',
        'PLN' => '985',
        'PYG' => '600',
        'QAR' => '634',
        'RON' => '946',
        'RSD' => '941',
        'SAR' => '682',
        'SCR' => '690',
        'SDG' => '938',
        'SEK' => '752',
        'SGD' => '702',
        'SLL' => '694',
        'SOS' => '706',
        'SRD' => '968',
        'SYP' => '760',
        'SZL' => '748',
        'THB' => '764',
        'TJS' => '972',
        'TMT' => '795',
        'TND' => '788',
        'TRY' => '949',
        'TWD' => '901',
        'TZS' => '834',
        'UGX' => '800',
        'UYU' => '858',
        'UZS' => '860',
        'VEF' => '937',
        'VND' => '704',
        'XAF' => '950',
        'XDR' => '960',
        'XOF' => '952',
        'YER' => '886',
        'ZAR' => '710'
    );

    /**
     * @param $currency
     * @return string
     */
    public function getCurrencyNumcode()
    {
        if (self::currencyNumcodes[$this->currency] == null) {
            Logger::getLogger("Currency")->error("Unknown currency [" . $this->currency . "]");
            return "";
        } else
            return self::currencyNumcodes[$this->currency];

    }
}