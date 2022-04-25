# magento-ISO3166

This module is for Magento 2 website, it helps to get country ISO3166 data by country code 2 as well as 3 digits code and more. Following is the details you can get using this module.

## This module helps to get following details.
* Get country numeric code using 2 digit country code.
* Get Country numeric code using 3 digit country code.
* Get Country 2 digit code using country numeric code.
* Get Country 3 digit code using country numeric code.
* Get Country Name using country numeric code.

**NOTE:** This is offline data, no service used to fetch online data for this module.
Data prepared from this link https://www.iso.org/obp/ui/#search

Last data updated on 19 April 2022.

## How to Use:


    
    public function __construct(
        \Dhairvi\ISO3166\Model\Collection $cntCollection
    )
    {
        $this->iso3166Collection = $cntCollection;
    }

    /**
     * Get country numeric code by 2 digit country code.
     */
    public function getCountryNumericCodeByCountryTwoDigitCode($countryCode)
    {
        $country3DigitNumericCode = $this->iso3166Collection->getNumericCodeByCountryCode(strtoupper($countryCode));
        return $country3DigitNumericCode;
        
        //If $countryCode = 'US' then  output = 840
    }

    /**
     * Get Country numeric code by 3 digit country code.
     */
    public function getCountryNumericCodeByCountryThreeDigitCode($countryCode)
    {
        $country3DigitNumericCode = $this->iso3166Collection->getNumericCodeByCountryCode3(strtoupper($countryCode));
        return $country3DigitNumericCode;

        //If $countryCode = 'USA' then  output = 840
    }

    /**
     * Get Country 2 digits code by country numeric code.
     */
    public function getCountryTwoDigitCodeByNumericCode($numericCode)
    {
        $country3DigitNumericCode = $this->iso3166Collection->getTwoDigitCountryCodeByNumericCode($numericCode);
        return $country3DigitNumericCode;

        //If $countryCode = '840' then  output = US
    }

    /**
     * Get Country 3 digits code by country numeric code.
     */
    public function getCountryThreeDigitCodeByNumericCode($numericCode)
    {
        $country3DigitNumericCode = $this->iso3166Collection->getThreeDigitCountryCodeByNumericCode($numericCode);
        return $country3DigitNumericCode;

        //If $countryCode = '840' then  output = USA
    }

     /**
     * Get Country Name by numeric code.
     */
    public function getCountryNameByNumericCode($numericCode)
    {
        $country3DigitNumericCode = $this->iso3166Collection->getCountryNamebyNumericCode($numericCode);
        return $country3DigitNumericCode;

        //If $countryCode = '840' then  output = United States Of America
    }


