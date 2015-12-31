<?php
namespace Distantia\CanadaPostWs\Type\NcShipment;

class DomesticAddressDetailsType
{
    /**
     * @var string
     * name="address-line-1"
     */
    protected $addressLine1;

    /**
     * @var string
     * name="address-line-2"  minOccurs="0"
     */
    protected $addressLine2;

    /**
     * @var string
     * name="city"
     */
    protected $city;

    /**
     * @var string
     * name="prov-state" type="ProvinceType"
     */
    protected $provState;

    /**
     * @var string
     * name="postal-zip-code" type="PostalCodeType"
     */
    protected $postalZipCode;

    /**
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * @param string $addressLine1
     * @return DomesticAddressDetailsType
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * @param string $addressLine2
     * @return DomesticAddressDetailsType
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return DomesticAddressDetailsType
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvState()
    {
        return $this->provState;
    }

    /**
     * @param string $provState
     * @return DomesticAddressDetailsType
     */
    public function setProvState($provState)
    {
        $this->provState = $provState;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalZipCode()
    {
        return $this->postalZipCode;
    }

    /**
     * @param string $postalZipCode
     * @return DomesticAddressDetailsType
     */
    public function setPostalZipCode($postalZipCode)
    {
        $this->postalZipCode = $postalZipCode;

        return $this;
    }


}