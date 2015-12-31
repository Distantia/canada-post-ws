<?php
namespace Distantia\CanadaPostWs\Type\Shipment;

class SkuType
{
    /**
     * @var int
     * name="customs-number-of-units"
     */
    protected $customsNumberOfUnits;

    /**
     * @var string
     * name="customs-description"
     */
    protected $customsDescription;

    /**
     * @var string
     * name="sku" minOccurs="0"
     */
    protected $sku;

    /**
     * @var string
     * name="hs-tariff-code" minOccurs="0"
     */
    protected $hsTariffCode;

    /**
     * @var float
     * name="unit-weight"
     */
    protected $unitWeight;

    /**
     * @var float
     * name="customs-value-per-unit"
     */
    protected $customsValuePerUnit;

    /**
     * @var string
     * name="customs-unit-of-measure" type="CustomsUnitOfMeasure" minOccurs="0"
     */
    protected $customsUnitOfMeasure;

    /**
     * @var string
     * name="country-of-origin" type="CountryCodeType" minOccurs="0"
     */
    protected $countryOfOrigin;

    /**
     * @var string
     * name="province-of-origin" type="ProvinceType" minOccurs="0"
     */
    protected $provinceOfOrigin;

    /**
     * @return int
     */
    public function getCustomsNumberOfUnits()
    {
        return $this->customsNumberOfUnits;
    }

    /**
     * @param int $customsNumberOfUnits
     * @return SkuType
     */
    public function setCustomsNumberOfUnits($customsNumberOfUnits)
    {
        $this->customsNumberOfUnits = $customsNumberOfUnits;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomsDescription()
    {
        return $this->customsDescription;
    }

    /**
     * @param string $customsDescription
     * @return SkuType
     */
    public function setCustomsDescription($customsDescription)
    {
        $this->customsDescription = $customsDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return SkuType
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return string
     */
    public function getHsTariffCode()
    {
        return $this->hsTariffCode;
    }

    /**
     * @param string $hsTariffCode
     * @return SkuType
     */
    public function setHsTariffCode($hsTariffCode)
    {
        $this->hsTariffCode = $hsTariffCode;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitWeight()
    {
        return $this->unitWeight;
    }

    /**
     * @param float $unitWeight
     * @return SkuType
     */
    public function setUnitWeight($unitWeight)
    {
        $this->unitWeight = $unitWeight;

        return $this;
    }

    /**
     * @return float
     */
    public function getCustomsValuePerUnit()
    {
        return $this->customsValuePerUnit;
    }

    /**
     * @param float $customsValuePerUnit
     * @return SkuType
     */
    public function setCustomsValuePerUnit($customsValuePerUnit)
    {
        $this->customsValuePerUnit = $customsValuePerUnit;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomsUnitOfMeasure()
    {
        return $this->customsUnitOfMeasure;
    }

    /**
     * @param string $customsUnitOfMeasure
     * @return SkuType
     */
    public function setCustomsUnitOfMeasure($customsUnitOfMeasure)
    {
        $this->customsUnitOfMeasure = $customsUnitOfMeasure;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @param string $countryOfOrigin
     * @return SkuType
     */
    public function setCountryOfOrigin($countryOfOrigin)
    {
        $this->countryOfOrigin = $countryOfOrigin;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvinceOfOrigin()
    {
        return $this->provinceOfOrigin;
    }

    /**
     * @param string $provinceOfOrigin
     * @return SkuType
     */
    public function setProvinceOfOrigin($provinceOfOrigin)
    {
        $this->provinceOfOrigin = $provinceOfOrigin;

        return $this;
    }


}